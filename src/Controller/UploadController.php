<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Mailer\Email;

/**
 * VpnComptes Controller
 *
 * @property \App\Model\Table\VpnComptesTable $VpnComptes
 */
class UploadController extends AppController
{
	public function beforeFilter(Event $event){
		$this->LoadModel('Users');
	}


	public $helpers = ['Paginator'];
	public $paginate = [];

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$user = $this->Users->get($this->Auth->user()['id']);
		$pass = substr(md5($user->password),0,10);
		$username = $user->email;
		$this->set(compact('pass', 'username'));
	}

	public function newFile(){
		$extension_allowed = ['avi', 'mkv', 'm4v', 'mp4', 'srt'];
		$mail = Configure::read("Upload.Mail");

		$files = $this->request->data;
		$messages = array();

		foreach($files as $file){
		    $filename = $file['name'];
		    $objet = "Upload de ".$filename." sur G*";
		    $user = $this->Auth->user();
		    $extension = strrchr($filename, '.');
		    $extension = substr($extension, 1);
		    $extension = strtolower($extension);

		    //if(in_array($extension, $extension_allowed)){
		        move_uploaded_file($file['tmp_name'], '/media/Series2/UploadsWeb/' . $filename);
		        $email = new Email('default');
		        $email->from(['upload@gomines.rez' => 'Uploads'])
		        	->to($mail)
		        	->subject($objet)
		        	->send('Un nouveau fichier a été uploadé par '. $user['nom'].' '.$user['prenom'].'!');
		        $messages[] = $filename." a bien été enregistré !";
		    //}
		    //else{
		    //    $messages[] = $filename." n'a pas été enregistré : extension non autorisée...";
		    //}
		}

		$this->set(['messages' => $messages]);
	}
}
