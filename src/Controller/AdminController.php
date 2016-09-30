<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use App\Controller\VpnController;

/**
 * Admin Controller
 */
class AdminController extends AppController
{
	public function beforeFilter(Event $event){
		$this->LoadModel('Users');
		$this->LoadModel('VpnComptes');
	}


	public $helpers = ['Paginator'];
	public $paginate = [];

	public function dashboard()
	{
		$this->isAuthorized(2);
		// Demandes de compte VPN
		$demandeVPN = $this->VpnComptes->find('all', [
			'conditions' => ['or' =>['VpnComptes.actif' => 0, 'VpnComptes.cert is null', 'VpnComptes.pkey is null']],
			'contain' => ['Users']]);
		$demandeVPN = $demandeVPN->all();

		// Demande de compte
		$demande = $this->Users->find('all', [
			'conditions' => ['Users.droits' => 0]]);
		$demande = $demande->all();

		// Suggestions
		/**
		 * To-Do : Ajouter le support de suggestions
		 * -> Les gens peuvent envoyer des messages
		 * pour nous donner des conseils/demandes
		 */

		// Indicateurs
		$status = VpnController::_getVPNStatus();
		$indicateurs = [
			'nbVPN' => count($status),
			'nbUploads' => count($demandeVPN)
		];

		$this->set(compact('demandeVPN', 'demande', 'indicateurs'));
	}

	public function tools(){
		$this->isAuthorized(2);
		$dhcpScript = Configure::read("rogueDHCPServerScript");
		if ($this->request->is('post')) {
			$output = "";
			$h = popen($dhcpScript, "r");
			$output = fread($h, 2096);
			pclose($h);
			$re = "/(.*) ([0-9a-f:]{17}) (.*) ([0-9\\.]{9,21}) (.*)(Reply|Request)/";
			preg_match_all($re, $output, $matches);
			$reponses = [];
			foreach($matches[0] as $k => $m){
				$reponses[] = [
					"MAC" => $matches[2][$k],
					"IP" => $matches[4][$k],
					"Command" => $matches[6][$k],
				];
			}
			$this->set(["dhcp" => $reponses]);
		}
	}
}
