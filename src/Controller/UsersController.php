<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	public function beforeFilter(\Cake\Event\Event $event)
	{
		$this->Auth->allow(['register']);
	}

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->isAuthorized(2);
		$this->set('users', $this->paginate($this->Users));
		$this->set('_serialize', ['users']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id User id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$this->isAuthorized(2);
		$user = $this->Users->get($id, [
			'contain' => ['VpnComptes']
		]);
		$this->set('user', $user);
		$this->set('_serialize', ['user']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$this->isAuthorized(2);
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('user'));
		$this->set('_serialize', ['user']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$this->isAuthorized(2);
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('user'));
		$this->set('_serialize', ['user']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->isAuthorized(2);
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				$this->_setCookie();
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('Your username or password is incorrect.');
		}
	}

	protected function _setCookie() {
		if (!$this->request->data('remember_me')) {
			return false;
		}
		$data = [
			'email' => $this->request->data('email'),
			'password' => $this->request->data('password')
		];
		$this->Cookie->write('RememberMe', $data, true, '+1 week');
		return true;
	}

	public function logout()
	{
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}

	public function register()
	{
		$this->isAuthorized(0);
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Auth->setUser($user->toArray());
				return $this->redirect([
					'controller' => 'pages',
					'action' => 'index'
				]);
			} else {
				$this->Flash->error(__('Erreur lors de l\'inscription.'));
			}
		}
	}

	public function activate($id = null)
	{
		$this->isAuthorized(2);
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		$user['droits'] = User::$tDroits['Utilisateur'];
		if ($this->Users->save($user)) {
			$this->Flash->success(__('Compte bien activé.'));
			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->error(__('Erreur à la sauvegarde des modifications.'));
		}
		$this->set(compact('user'));
		$this->set('_serialize', ['user']);
	}
}
