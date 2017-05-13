<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TicketTheme Controller
 *
 * @property \App\Model\Table\TicketThemeTable $TicketTheme
 */
class TicketThemeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	$ticketThemes = $this->TicketTheme->find('all');

        $this->set(compact('ticketThemes'));
    }

    /**
     * View method
     *
     * @param string|null $id Ticket Theme id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticketTheme = $this->TicketTheme->get($id, [
            'contain' => []
        ]);

        $this->set('ticketTheme', $ticketTheme);
        $this->set('_serialize', ['ticketTheme']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ticketTheme = $this->TicketTheme->newEntity();
        if ($this->request->is('post')) {
            $ticketTheme = $this->TicketTheme->patchEntity($ticketTheme, $this->request->data);
            if ($this->TicketTheme->save($ticketTheme)) {
                $this->Flash->success(__('The ticket theme has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ticket theme could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ticketTheme'));
        $this->set('_serialize', ['ticketTheme']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket Theme id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticketTheme = $this->TicketTheme->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticketTheme = $this->TicketTheme->patchEntity($ticketTheme, $this->request->data);
            if ($this->TicketTheme->save($ticketTheme)) {
                $this->Flash->success(__('The ticket theme has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ticket theme could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ticketTheme'));
        $this->set('_serialize', ['ticketTheme']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket Theme id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticketTheme = $this->TicketTheme->get($id);
        if ($this->TicketTheme->delete($ticketTheme)) {
            $this->Flash->success(__('The ticket theme has been deleted.'));
        } else {
            $this->Flash->error(__('The ticket theme could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
