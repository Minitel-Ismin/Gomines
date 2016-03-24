<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * VpnComptes Controller
 *
 * @property \App\Model\Table\VpnComptesTable $VpnComptes
 */
class VpnController extends AppController
{
	public function beforeFilter(Event $event){
		$this->LoadModel('Users');
		$this->LoadModel('VpnComptes');
		$this->Auth->allow(['vpnStats']);
	}


	public $helpers = ['Paginator'];
	public $paginate = [];

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index(){
		$user = $this->Users->get($this->Auth->user()['id'], [
			'contain' => ['VpnComptes']
		]);
		$user->vpn_compte->bp = $this->_convertSize($user->vpn_compte->bp_used);
		$user->vpn_compte->bp_day = $this->_convertSize($user->vpn_compte->bp_used_day);

		$status = $this->_getVPNStatus();
		foreach($status as $i => $c){
			if($c['cn'] == $user->vpn_compte->common_name){
				$bp = $user->vpn_compte->bp_used_day + $c['b_rx_raw'] + $c['b_tx_raw'];
				$user->vpn_compte->bp_day = $this->_convertSize($bp);
			}
		}

		$this->set(compact('user'));
	}

	public function request(){
		$vpnCompte = $this->VpnComptes->newEntity();
		$vpnCompte['user_id'] = $this->Auth->user()['id'];
		if ($this->VpnComptes->save($vpnCompte)) {
			$this->Flash->success(__('Requête bien transmise.'));
			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->error(__('Erreur lors de la requête.'));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function dlConfig(){
		$user = $this->Users->get($this->Auth->user()['id'], [
			'contain' => ['VpnComptes']
		]);
		if(empty($user['vpn_compte']) || $user['vpn_compte']['actif'] == 0){
			$this->Flash->error(__('Votre compte VPN n\'est pas valide'));
			return $this->redirect(['action' => 'index']);
		}
		$this->viewClass = "VPNConfig";
		$this->set(compact("user"));
	}

	public function activateVPN($id = null){
		$this->isAuthorized(2);
		$user = $this->Users->get($id, [
			'contain' => ['VpnComptes']
		]);
		if(empty($user['vpn_compte'])){
			$vpnCompte = $this->VpnComptes->newEntity();
			$vpnCompte['user_id'] = $id;
			if (!$this->VpnComptes->save($vpnCompte)) {
				$this->Flash->error(__('Erreur lors de la requête.'));
				return $this->redirect($this->referer());
			}
		}
		$user = $this->Users->get($id, [
			'contain' => ['VpnComptes']
		]);
		if($user['vpn_compte']['actif'] == 0){
			$user['vpn_compte']['actif'] = 1;
			if($this->VpnComptes->save($user['vpn_compte'])){
				$this->Flash->success(__('Compte VPN activé'));
				return $this->redirect($this->referer());
			}else{
				$this->Flash->error(__('Erreur à l\'enregistrement.'));
				return $this->redirect($this->referer());
			}
		}else{
			$this->Flash->error(__('Le compte VPN est déjà actif'));
			return $this->redirect($this->referer());
		}
	}

	public function generateVPN($id = null){
		$this->isAuthorized(2);
		$user = $this->Users->get($id, [
			'contain' => ['VpnComptes']
		]);
		if(empty($user['vpn_compte'])){
			$this->Flash->error(__('Le compte VPN n\'est pas valide'));
			return $this->redirect(['controller' => 'users', 'action' => 'index']);
		}else{
			if($user['vpn_compte']['actif'] == 0){
				$this->Flash->error(__('Le compte VPN n\'est pas actif'));
				return $this->redirect(['controller' => 'users', 'action' => 'index']);
			}else{
				$config = array(
					"digest_alg" => "sha512",
					"private_key_bits" => 4096,
					"private_key_type" => OPENSSL_KEYTYPE_RSA,
				);
				$res = openssl_pkey_new($config);
				$privKey = "";
				openssl_pkey_export($res, $privKey);

				$cn = strtolower($user['prenom'].".".$user['nom']);
				$dn = array(
					"countryName" => "FR",
					"stateOrProvinceName" => "PACA",
					"localityName" => "Gardanne",
					"organizationName" => "MINITEL",
					"organizationalUnitName" => "VPN",
					"commonName" => $cn,
					"emailAddress" => $user['email']
				);
				$csr 	= openssl_csr_new($dn, $privKey);
				$cert 	= openssl_csr_sign($csr, file_get_contents(Configure::read("ssl_ca")), file_get_contents(Configure::read("ssl_cakey")), 365);
				$certout= "";
				openssl_x509_export($cert, $certout);

				$user['vpn_compte']['cert'] = $certout;
				$user['vpn_compte']['pkey'] = $privKey;
				$user['vpn_compte']['common_name'] = $cn;
				if($this->VpnComptes->save($user['vpn_compte'])){
					$this->Flash->success(__('Configuration VPN générée'));
					return $this->redirect(['controller' => 'users', 'action' => 'index']);
				}else{
					$this->Flash->error(__('Erreur à l\'enregistrement.'));
					return $this->redirect(['controller' => 'users', 'action' => 'index']);
				}
			}
		}
	}

	public function vpnStatus(){
		$this->isAuthorized(2);
		
		$listeCo = $this->_getVPNStatus();

		$this->set(compact("listeCo"));
	}

	public function vpnUsers(){
		$this->isAuthorized(2);
		$this->paginate = [
		    'sortWhitelist' => [
		        'id', 'Users.nom', 'Users.prenom', 'VpnComptes.bp_used', 'VpnComptes.bp_used_day'
		    ],
			'order' => [
				'bp_used' => 'desc'
			],
			'contain' => [
				'Users'
			]
		];
		$user = $this->paginate($this->VpnComptes)
			->map(function($row){
				$row->bp = $this->_convertSize($row->bp_used);
				$row->bp_day = $this->_convertSize($row->bp_used_day);
				$row->user->prenom = ucwords(strtolower($row->user->prenom),"- ");
				$row->user->nom = ucwords(strtolower($row->user->nom),"- ");
				return $row;
			});
		$this->set(compact("user"));
	}

	static function _convertSize($size, $precision = 2){
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($size, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		$bytes /= pow(1024, $pow);

		return round($bytes, $precision).' '.$units[$pow];
	}

	public function vpnStats(){
		$this->autoRender = false;

		$nb_user = count($this->_getVPNStatus());

		echo $nb_user;

		$dashingurl = Configure::read("DashingWidgetURL");
		$dashingtoken = Configure::read("DashingToken");
		$ch = curl_init($dashingurl);
		$data = json_encode(array(
			"auth_token" => $dashingtoken,
			"current" 	 => $nb_user
		));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_exec($ch);
	}

	public function vpnResetBW($uid = -1){
		$this->isAuthorized(2);
		if($uid < 0){
			$this->flash->error("Utilisateur invalide");
			return $this->redirect(['controller' => 'vpn', 'action' => 'vpnUsers']);
		}
		$user = $this->Users->get($uid, [
			'contain' => ['VpnComptes']
		]);
		if(empty($user['vpn_compte'])){
			$this->Flash->error(__('Le compte n\'est pas valide'));
			return $this->redirect(['controller' => 'vpn', 'action' => 'vpnUsers']);
		}else{
			if($user['vpn_compte']['actif'] == 0){
				$this->Flash->error(__('Le compte VPN n\'est pas actif'));
				return $this->redirect(['controller' => 'vpn', 'action' => 'vpnUsers']);
			}else{
				$user['vpn_compte']['bp_used'] += $user['vpn_compte']['bp_used_day'];
				$user['vpn_compte']['bp_used_day'] = 0;
				if($this->VpnComptes->save($user['vpn_compte'])){
					$this->Flash->success(__('Consommation de BP remise à zéro.'));
					return $this->redirect(['controller' => 'vpn', 'action' => 'vpnUsers']);
				}else{
					$this->Flash->error(__('Erreur à la remise à zéro de la consommation de BP'));
					return $this->redirect(['controller' => 'vpn', 'action' => 'vpnUsers']);
				}
			}
		}
	}

	/**
	 * Function _getVPNStatus
	 * 
	 * Reads the openvpn status file and extract the
	 * list of currently connected users with their
	 * metadata (rx/tx bytes, ip addresses, ...)
	 *
	 * Returns an array with all users
	 */
	static function _getVPNStatus(){
		$openvpnStatusFile = Configure::read("OpenVPNStatusFile");
		$status = file_get_contents($openvpnStatusFile);

		$re = "/OpenVPN CLIENT LIST\\nUpdated,(.*)\\n([\\w-,.: \\n]*)\\nROUTING TABLE\\n([\\w-,.: \\n]*)\\nGLOBAL STATS\\n([\\w-,.: \\/\\n]*)\\nEND/iu"; 

		preg_match($re, $status, $matches);

		list($data, $lastUpdate, $connected, $routing, $global) = $matches;
		$connected = explode("\n",$connected);
		$connectedColumns = array_shift($connected);
		$connectedColumns = explode(",",$connectedColumns);
		$listeCo = array();
		foreach($connected as $i => $c){
			$user = explode(",",$c);
			list($cn, $real_addr, $b_rx, $b_tx, $conn_since) = $user;
			$listeCo[$real_addr] = array(
				"cn" => $cn, 
				"real_addr" => $real_addr, 
				"b_rx" => VpnController::_convertSize($b_rx),
				"b_tx" => VpnController::_convertSize($b_tx),
				"b_rx_raw" => $b_rx,
				"b_tx_raw" => $b_tx,
				"conn_since" => $conn_since,
				"virt_addr" => "",
				"last_ref" => ""
			);
		}

		$routing = explode("\n",$routing);
		$routingColumns = array_shift($routing);
		$routingColumns = explode(",",$routingColumns);
		foreach($routing as $i => $c){
			$route = explode(",",$c);
			list($virt_addr, $cn, $real_addr, $last_ref) = $route;
			$listeCo[$real_addr]["error"] = ($cn != $listeCo[$real_addr]["cn"]);
			$listeCo[$real_addr]["virt_addr"] = $virt_addr;
			$listeCo[$real_addr]["last_ref"] = $last_ref;
		}
		return $listeCo;
	}
}
