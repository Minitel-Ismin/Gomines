<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Folder;
use Cake\Network\Http\Response;

/**
 * DLCategory Controller
 *
 * @property \App\Model\Table\DLCategoryTable $DLCategory
 */
class DLCategoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $dLCategory = $this->DLCategory->find('all')->contain(['folders']);

        $this->set(compact('dLCategory'));
        $this->set('_serialize', ['dLCategory']);
    }

    /**
     * View method
     *
     * @param string|null $id D L Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dLCategory = $this->DLCategory->get($id, [
            'contain' => ['folders']
        ]);

        $this->set('dLCategory', $dLCategory);
        $this->set('_serialize', ['dLCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dLCategory = $this->DLCategory->newEntity();
        if ($this->request->is('post')) {
            $dLCategory = $this->DLCategory->patchEntity($dLCategory, $this->request->data);
            $folders=[];
            $folderTable = TableRegistry::get('Folders');
            
            
            foreach ($this->request->data["folders"] as $fol){
            	$temp = $folderTable->newEntity();
            	$temp->path = $fol;
            	$folders[] = $temp;
            }
            	
//             $folder->path = $this->request->data['folders'];;//
            $dLCategory->folders = $folders;
            if ($this->DLCategory->save($dLCategory)) {
                $this->Flash->success(__('The d l category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The d l category could not be saved. Please, try again.'));
                
            }
        }
        $this->set(compact('dLCategory'));
        $this->set('_serialize', ['dLCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id D L Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dLCategory = $this->DLCategory->get($id, [
            'contain' => ['folders']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dLCategory = $this->DLCategory->patchEntity($dLCategory, $this->request->data);
            
            $folders=[];
            $folderTable = TableRegistry::get('Folders');

            $folderTable->deleteAll(['id_dlcategory' => $id]);
            foreach ($this->request->data["folders"] as $fol){
            	if($fol!=""){
            		$temp = $folderTable->findOrCreate(["path"=>$fol]);
            		$temp->path = $fol;
            		$folders[] = $temp;
            	}
            	
            }
            
            $dLCategory->folders = $folders;
            
            if ($this->DLCategory->save($dLCategory)) {
                $this->Flash->success(__('The d l category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The d l category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dLCategory'));
        $this->set('_serialize', ['dLCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id D L Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dLCategory = $this->DLCategory->get($id);
        if ($this->DLCategory->delete($dLCategory)) {
            $this->Flash->success(__('The d l category has been deleted.'));
        } else {
            $this->Flash->error(__('The d l category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
