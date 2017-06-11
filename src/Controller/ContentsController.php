<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contents Controller
 *
 * @property \App\Model\Table\ContentsTable $Contents
 */
class ContentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        
//         $contents = $this->Contents->find('all')->contain(['Folders', 'DLCategory']);
        
        $this->set(compact('contents'));
        $this->set('_serialize', ['contents']);
    }
    
    public function dataSource(){
    	$this->viewClass = "Ajax";
//     	dd($this->request->data);
    	$contents = $this->Contents->find()
    								->contain(['Folders', 'DLCategory'])
    								->select([
    										'Contents.id',
    										'DLCategory.name',
									    'Contents.name',
									    'Contents.size',
									    'Contents.to_verify'
									]);
    	
    	$draw = intval($this->request->data["draw"]);
    	$recordsTotal = $contents->count();
// 		$recordsTotal = 1;
		$contents = $contents->where(["Contents.name LIKE"=> '%'.$this->request->data["search"]["value"]. '%']);
    	$recordsFiltered = $contents->count();
    	$contents = $contents->limit($this->request->data["length"])
    								->page($this->request->data["draw"]);
    	$data = $contents->all();
    								
    								
    	
    	
//     	$total = $contents->count();
//     	$data["draw"] = $contents->count();
    	
//     	$data["recordsTotal"] = 
    	
    	$this->set(compact('draw', 'recordsTotal', 'recordsFiltered', 'data'));
    }

    /**
     * View method
     *
     * @param string|null $id Content id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $content = $this->Contents->get($id, [
            'contain' => ['DLCategory']
        ]);

        $this->set('content', $content);
        $this->set('_serialize', ['content']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $content = $this->Contents->newEntity();
        if ($this->request->is('post')) {
            $content = $this->Contents->patchEntity($content, $this->request->data);
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $dlcategory = $this->Contents->DLCategory->find('list', ['limit' => 200]);
        $this->set(compact('content', 'dlcategory'));
        $this->set('_serialize', ['content']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $content = $this->Contents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Contents->patchEntity($content, $this->request->data);
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('content'));
        $this->set('_serialize', ['content']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $content = $this->Contents->get($id);
        if ($this->Contents->delete($content)) {
            $this->Flash->success(__('The content has been deleted.'));
        } else {
            $this->Flash->error(__('The content could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
