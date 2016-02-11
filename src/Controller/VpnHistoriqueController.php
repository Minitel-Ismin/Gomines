<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VpnHistorique Controller
 *
 * @property \App\Model\Table\VpnHistoriqueTable $VpnHistorique
 */
class VpnHistoriqueController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['VpnComptes']
        ];
        $this->set('vpnHistorique', $this->paginate($this->VpnHistorique));
        $this->set('_serialize', ['vpnHistorique']);
    }

    /**
     * View method
     *
     * @param string|null $id Vpn Historique id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vpnHistorique = $this->VpnHistorique->get($id, [
            'contain' => ['VpnComptes']
        ]);
        $this->set('vpnHistorique', $vpnHistorique);
        $this->set('_serialize', ['vpnHistorique']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vpnHistorique = $this->VpnHistorique->newEntity();
        if ($this->request->is('post')) {
            $vpnHistorique = $this->VpnHistorique->patchEntity($vpnHistorique, $this->request->data);
            if ($this->VpnHistorique->save($vpnHistorique)) {
                $this->Flash->success(__('The vpn historique has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vpn historique could not be saved. Please, try again.'));
            }
        }
        $vpnComptes = $this->VpnHistorique->VpnComptes->find('list', ['limit' => 200]);
        $this->set(compact('vpnHistorique', 'vpnComptes'));
        $this->set('_serialize', ['vpnHistorique']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vpn Historique id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vpnHistorique = $this->VpnHistorique->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vpnHistorique = $this->VpnHistorique->patchEntity($vpnHistorique, $this->request->data);
            if ($this->VpnHistorique->save($vpnHistorique)) {
                $this->Flash->success(__('The vpn historique has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vpn historique could not be saved. Please, try again.'));
            }
        }
        $vpnComptes = $this->VpnHistorique->VpnComptes->find('list', ['limit' => 200]);
        $this->set(compact('vpnHistorique', 'vpnComptes'));
        $this->set('_serialize', ['vpnHistorique']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vpn Historique id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vpnHistorique = $this->VpnHistorique->get($id);
        if ($this->VpnHistorique->delete($vpnHistorique)) {
            $this->Flash->success(__('The vpn historique has been deleted.'));
        } else {
            $this->Flash->error(__('The vpn historique could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
