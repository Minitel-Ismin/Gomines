<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Helpers\Allocine;


/**
 * Film Controller
 *
 * @property \App\Model\Table\FilmTable $Film
 */
class FilmController extends AppController
{
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $film = $this->paginate($this->Film);

        $this->set(compact('film'));
        $this->set('_serialize', ['film']);
    }

    /**
     * View method
     *
     * @param string|null $id Film id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $film = $this->Film->get($id, [
            'contain' => ['Category']
        ]);

        $this->set('film', $film);
        $this->set('_serialize', ['film']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $film = $this->Film->newEntity();
        if ($this->request->is('post')) {
            $film = $this->Film->patchEntity($film, $this->request->data);
            if ($this->Film->save($film)) {
                $this->Flash->success(__('The film has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The film could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('film'));
        $this->set('_serialize', ['film']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Film id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $film = $this->Film->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $film = $this->Film->patchEntity($film, $this->request->data);
            if ($this->Film->save($film)) {
                $this->Flash->success(__('The film has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The film could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('film'));
        $this->set('_serialize', ['film']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Film id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $film = $this->Film->get($id);
        if ($this->Film->delete($film)) {
            $this->Flash->success(__('The film has been deleted.'));
        } else {
            $this->Flash->error(__('The film could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    public function filmInfo(){
    	$this->request->allowMethod(['post']);
    	$allocine = new Allocine();
    	$filmInfo = $allocine->get($this->request->data["title"]);
    	$this->set("content","ok");
		
//     	$this->render('/Layout/ajax');
    }
    
}
