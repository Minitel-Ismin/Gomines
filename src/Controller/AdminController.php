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
			'nbUploads' => 16
		];

		$this->set(compact('demandeVPN', 'demande', 'indicateurs'));
	}
}
