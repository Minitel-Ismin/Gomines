<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 *
 * @method \App\Model\Entity\News[] paginate($object = null, array $settings = [])
 */
class NewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $news = $this->News->find('all')->contain(['Users']);
        $this->set(compact('news'));
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => ['User']
        ]);

        $this->set('news', $news);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $news = $this->News->newEntity();
        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->getData());
            
            $news->user_id = $this->Auth->user()['id'];
            if ($this->News->save($news)) {
                $this->Flash->success(__('La news a bien été enregistrée'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La news n\'a pas été enregistrée'));
        }
        $this->set(compact('news'));
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->getData());
            if ($this->News->save($news)) {
                $this->Flash->success(__('La news a bien été enregistrée'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La news n\'a pas été enregistrée'));
        }
        $this->set(compact('news'));
        $this->set('_serialize', ['news']);
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $news = $this->News->get($id);
        if ($this->News->delete($news)) {
            $this->Flash->success(__('La news a bien été supprimée'));
        } else {
            $this->Flash->error(__('La news ne peut être supprimée merci de recommencer'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**

    */
    public function display(){
        $news = $this->News->find('all')->contain('Users')->order(['News.created' => 'DESC']);

        $this->set(compact('news'));
    }
}
