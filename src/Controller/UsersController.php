<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\Utility\Security;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {
	public function beforeFilter(\Cake\Event\Event $event) {
		$this->Auth->allow ( [ 
				'register' 
		] );
	}
	
	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->isAuthorized ( 2 );
		$this->set ( 'users', $this->Users->find ( 'all' ) ); // , $this->paginate($this->Users));
		$this->set ( '_serialize', [ 
				'users' 
		] );
	}
	
	/**
	 * View method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null) {
		$this->isAuthorized ( 2 );
		$user = $this->Users->get ( $id, [ 
				'contain' => [ 
						'VpnComptes' 
				] 
		] );
		$this->set ( 'user', $user );
		$this->set ( '_serialize', [ 
				'user' 
		] );
	}
	
	// MON COMPTE
	public function me() {
		$user = $this->Users->get ( $this->Auth->user () ['id'] );
		$this->set ( compact ( 'user' ) );
	}
	
	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$this->isAuthorized ( 2 );
		$user = $this->Users->newEntity ();
		if ($this->request->is ( 'post' )) {
			$user = $this->Users->patchEntity ( $user, $this->request->data );
			if ($this->Users->save ( $user )) {
				$this->Flash->success ( __ ( 'The user has been saved.' ) );
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'The user could not be saved. Please, try again.' ) );
			}
		}
		$this->set ( compact ( 'user' ) );
		$this->set ( '_serialize', [ 
				'user' 
		] );
	}
	
	/**
	 * Edit method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) {
		$this->isAuthorized ( 2 );
		if ($id == null)
			return $this->redirect ( [ 
					'action' => 'index' 
			] );
		try {
			$user = $this->Users->get ( $id );
		} catch ( \Exception $e ) {
			return $this->redirect ( [ 
					'action' => 'index' 
			] );
		}
		$droits = User::$tDroits;
		if ($this->request->is ( [ 
				'patch',
				'post',
				'put' 
		] )) {
			$numDroits = 0;
			foreach ( $droits as $d => $v ) {
				if ($this->request->data [$d] >= 1)
					$numDroits += $v;
			}
			$user = $this->Users->patchEntity ( $user, $this->request->data );
			$user->droits = $numDroits;
			if ($this->Users->save ( $user )) {
				$this->Flash->success ( __ ( 'The user has been saved.' ) );
				return $this->redirect ( [ 
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'The user could not be saved. Please, try again.' ) );
			}
		}
		foreach ( $droits as $d => $v ) {
			$uDroits [$d] = (($user->droits & $v) == 0) ? 0 : 1;
		}
		$this->set ( compact ( 'user', 'droits', 'uDroits' ) );
		$this->set ( '_serialize', [ 
				'user' 
		] );
	}
	
	/**
	 * Delete method
	 *
	 * @param string|null $id
	 *        	User id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null) {
		$this->isAuthorized ( 2 );
		$this->request->allowMethod ( [ 
				'post',
				'delete' 
		] );
		$user = $this->Users->get ( $id );
		if ($this->Users->delete ( $user )) {
			$this->Flash->success ( __ ( 'The user has been deleted.' ) );
		} else {
			$this->Flash->error ( __ ( 'The user could not be deleted. Please, try again.' ) );
		}
		return $this->redirect ( $this->referer () );
	}
	public function login() {
		if ($this->request->is ( 'post' )) {
			$user = $this->Auth->identify ();
			if ($user) {
				$this->Auth->setUser ( $user );
				$this->_setCookie ();
				return $this->redirect ( $this->Auth->redirectUrl () );
			}
			$this->Flash->error ( 'Your username or password is incorrect.' );
		}
	}
	protected function _setCookie() {
		if (! $this->request->data ( 'remember_me' )) {
			return false;
		}
		$data = [ 
				'email' => $this->request->data ( 'email' ),
				'password' => $this->request->data ( 'password' ) 
		];
		$this->Cookie->write ( 'RememberMe', $data, true, '+1 week' );
		return true;
	}
	public function logout() {
		$this->Flash->success ( 'You are now logged out.' );
		return $this->redirect ( $this->Auth->logout () );
	}
	public function register() {
		$this->isAuthorized ( 0 );
		$user = $this->Users->newEntity ();
		if ($this->request->is ( 'post' )) {
			$user = $this->Users->patchEntity ( $user, $this->request->data );
			if ($this->Users->save ( $user )) {
				$this->Auth->setUser ( $user->toArray () );
				return $this->redirect ( [ 
						'controller' => 'pages',
						'action' => 'index' 
				] );
			} else {
				$this->Flash->error ( __ ( 'Erreur lors de l\'inscription.' ) );
			}
		}
	}
	public function activate($id = null) {
		$this->isAuthorized ( 2 );
		$user = $this->Users->get ( $id, [ 
				'contain' => [ ] 
		] );
		$user ['droits'] = User::$tDroits ['Utilisateur'];
		if ($this->Users->save ( $user )) {
			$this->Flash->success ( __ ( 'Compte bien activé.' ) );
			return $this->redirect ( $this->referer () );
		} else {
			$this->Flash->error ( __ ( 'Erreur à la sauvegarde des modifications.' ) );
		}
		$this->set ( compact ( 'user' ) );
		$this->set ( '_serialize', [ 
				'user' 
		] );
	}
	
	// reset password part
	/**
	 * Allow a user to request a password reset.
	 * 
	 * @return
	 *
	 */
	public function forgotPassword() {
		$this->isAuthorized ( 0 );
		if ($this->request->is ( 'post' )) {
			$user = $this->Users->findByEmail ( $this->request->data ( 'email' ) )->first ();
			if ($user == Null) {
				$this->Flash->error ( 'Il n\'y a pas de compte lié à cette adresse mail' );
				$this->redirect ( '/users/forgot_password' );
			} else {
				$user = $this->__generatePasswordToken ( $user );
				if ($this->Users->save ( $user ) && $this->__sendForgotPasswordEmail ( $user->id )) {
					$this->Flash->success ( 'Un email vous a été envoyé' );
					$this->redirect('/users/login');
				}
			}
		}
	}
	/**
	 * Allow user to reset password if $token is valid.
	 * 
	 * @return
	 *
	 */
	public function resetPasswordToken($reset_password_token = null) {
		$this->isAuthorized(0);
		if (empty($this->request->data)) {
			$user = $this->Users->findByResetPasswordToken ( $reset_password_token )->first();
			if (! empty ( $user-> reset_password_token ) && ! empty ( $user->token_created_at ) && $this->__validToken ( $user->token_created_at)) {
				$user->id = null;
				$_SESSION ['token'] = $reset_password_token;
				$this->set(compact('reset_password_token'));
			} else {
				$this->Flash->error ( 'La demande de réinitialisation a expirée' );
				$this->redirect ( '/users/login' );
			}
		} else {
			if ($this->request->data ['reset_password_token'] != $_SESSION ['token']) {
				$this->Flash->error ( 'La demande de réinitialisation a expirée ou est invalide' );
				$this->redirect ( '/users/login' );
			}
			$user = $this->Users->findByResetPasswordToken ( $this->request->data ['reset_password_token'] )->first();
			$user->password = $this->request->data['password'];
			$user->token_created_at = null;
			$user->reset_password_token = null;
			if ($this->Users->save ( $user )) {
				if ($this->__sendPasswordChangedEmail ( $user  )) {
					unset ( $_SESSION ['token'] );
					$this->Flash->success ( 'Votre mot de passe a été changé, merci de vous reconnecter' );
					$this->redirect ( '/users/login' );
				}
			}
		}
	}
	/**
	 * Generate a unique hash / token.
	 * 
	 * @param
	 *        	Object User
	 * @return Object User
	 */
	private function __generatePasswordToken($user) {
		if (empty ( $user )) {
			return null;
		}
		// Generate a random string 100 chars in length.
		$token = "";
		for($i = 0; $i < 100; $i ++) {
			$d = rand ( 1, 100000 ) % 2;
			$d ? $token .= chr ( rand ( 33, 79 ) ) : $token .= chr ( rand ( 80, 126 ) );
		}
		(rand ( 1, 100000 ) % 2) ? $token = strrev ( $token ) : $token = $token;
		// Generate hash of random string
		$hash = Security::hash ( $token, 'sha256', true );
		;
		for($i = 0; $i < 20; $i ++) {
			$hash = Security::hash ( $hash, 'sha256', true );
		}
		$user->reset_password_token = $hash;
		$user->token_created_at = date ( 'Y-m-d H:i:s' );
		return $user;
	}
	/**
	 * Validate token created at time.
	 * 
	 * @param String $token_created_at        	
	 * @return Boolean
	 */
	private function __validToken($token_created_at) {
		$expired = strtotime ( $token_created_at ) + 86400;
		$time = strtotime ( "now" );
		if ($time < $expired) {
			return true;
		}
		return false;
	}
	/**
	 * Sends password reset email to user's email address.
	 * 
	 * @param
	 *        	$id
	 * @return
	 *
	 */
	private function __sendForgotPasswordEmail($id = null) {
		if (! empty ( $id )) {
			$user = $this->Users->get ( $id );
			$email = new Email ('default');
			$email->to ( $user->email )
				->subject ( 'Demande de réinitialisation de mot de passe' )
				->from ( 'do-not-reply@gomines.rez', 'Gomines' )
				->template ( 'reset_password_request' )
				->emailFormat ( 'html' )
				->viewVars ( [ 
					'user' => $user 
				] )
				->send ();
			return true;
		}
		return false;
	}
	/**
	 * Notifies user their password has changed.
	 * 
	 * @param
	 *        	$id
	 * @return
	 *
	 */
	private function __sendPasswordChangedEmail($user = null) {
		if (! empty ( $user )) {
			
			
			$email = new Email ('default');
			$email->to ( $user->email )
					->subject ( 'Votre mot de passe a été changé' )
					->from ( 'do-not-reply@gomines.rez', 'Gomines' )
					->send ();
			return true;
		}
		return false;
	}
}
