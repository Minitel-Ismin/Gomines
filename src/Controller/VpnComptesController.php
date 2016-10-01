<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VpnComptes Controller
 *
 * @property \App\Model\Table\VpnComptesTable $VpnComptes
 */
class VpnComptesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('vpnComptes', $this->VpnComptes->find('all'));
        $this->set('_serialize', ['vpnComptes']);
    }

    /**
     * View method
     *
     * @param string|null $id Vpn Compte id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vpnCompte = $this->VpnComptes->get($id, [
            'contain' => ['Users', 'VpnHistorique']
        ]);
        $this->set('vpnCompte', $vpnCompte);
        $this->set('_serialize', ['vpnCompte']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vpnCompte = $this->VpnComptes->newEntity();
        if ($this->request->is('post')) {
            $vpnCompte = $this->VpnComptes->patchEntity($vpnCompte, $this->request->data);
            if ($this->VpnComptes->save($vpnCompte)) {
                $this->Flash->success(__('The vpn compte has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vpn compte could not be saved. Please, try again.'));
            }
        }
        $users = $this->VpnComptes->Users->find('list', ['limit' => 200]);
        $this->set(compact('vpnCompte', 'users'));
        $this->set('_serialize', ['vpnCompte']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vpn Compte id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vpnCompte = $this->VpnComptes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vpnCompte = $this->VpnComptes->patchEntity($vpnCompte, $this->request->data);
            if ($this->VpnComptes->save($vpnCompte)) {
                $this->Flash->success(__('The vpn compte has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vpn compte could not be saved. Please, try again.'));
            }
        }
        $users = $this->VpnComptes->Users->find('list', ['limit' => 200]);
        $this->set(compact('vpnCompte', 'users'));
        $this->set('_serialize', ['vpnCompte']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vpn Compte id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vpnCompte = $this->VpnComptes->get($id);
        if ($this->VpnComptes->delete($vpnCompte)) {
            $this->Flash->success(__('The vpn compte has been deleted.'));
        } else {
            $this->Flash->error(__('The vpn compte could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
