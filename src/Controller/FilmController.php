<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Helpers\Allocine;
use Cake\ORM\TableRegistry;


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
    
    
    public function filmInfo($id){
    	$this->request->allowMethod(['post']);
    	$allocine = new Allocine();
    	$filmInfo = $allocine->get($this->request->data["title"]);
    	$query = $this->Film->find()->where(["allocine_code"=>$filmInfo["movie"]["code"]]);
//     	$this->set("content",$query->first());
//     	file_put_contents("response1.txt", json_encode($allocine->get($this->request->data["title"])));
		$test = $query->first();
		if(!$test){ //si aucun résultat n'est trouvé en bdd on l'enregistre
			$film = $this->Film->get($id);
			(isset($filmInfo["movie"]["title"])) ? $film->title = $filmInfo["movie"]["title"]:$film->title = $filmInfo["movie"]["originalTitle"];
			
			

			$film->allocine_code = $filmInfo["movie"]["code"];
			$film->year = $filmInfo["movie"]["productionYear"];
			$film->actors = $filmInfo["movie"]["castingShort"]["actors"];
			$film->directors = $filmInfo["movie"]["castingShort"]["directors"];
			(isset($filmInfo["movie"]["statistics"]["pressRating"]))? $film->press_rate = $filmInfo["movie"]["statistics"]["pressRating"]:$film->press_rate=0 ;
			(isset($filmInfo["movie"]["statistics"]["userRating"]))? $film->user_rate = $filmInfo["movie"]["statistics"]["userRating"]:$film->user_rate = 0;
			// 						if(isset)
			(isset($filmInfo["movie"]["poster"]["href"]))?$film->poster = $filmInfo["movie"]["poster"]["href"]:$film->poster="";
			$film->allocine_link = $filmInfo["movie"]["link"][0]["href"];
			$film->to_verify = 0;
			
			
			$categoryTable = TableRegistry::get('Category');
			$category = $categoryTable->find()->where(["allocine_code"=>$filmInfo["movie"]["genre"][0]["code"]])->first();
			if(!$category){
				if(isset($filmInfo["movie"]["genre"]["$"])){
					$category = $this->Film->category->newEntity();
					$category->name = $filmInfo["movie"]["genre"]["$"];
					$category->allocine_code = $filmInfo["movie"]["genre"]["code"];
				}
					
			}
			$film->category = $category;
			$this->Film->save($film);
			$this->set("content","ok");
		}else{
			$this->set("content","error");
		}
    }
    
}
