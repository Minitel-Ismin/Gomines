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

$Film;
$Serie;
$Jeux;
$NSFW;
$Autre;
$Blu-Ray;
$Logiciel;
$Cours;
$Manga;

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
		$uploadFolder = Configure::read("Upload.folder");

		$files = $this->request->data;
		$messages = array();

		foreach($files as $file){
		    $filename = $file['name'];
			$GLOBALS['nom_aze'] = $filename;
		    $objet = "Upload de ".$filename." sur G*";
		    $user = $this->Auth->user();
		    $extension = strrchr($filename, '.');
		    $extension = substr($extension, 1);
		    $extension = strtolower($extension);

		    //if(in_array($extension, $extension_allowed)){
		    if(move_uploaded_file($file['tmp_name'],  $uploadFolder . $filename)){//'/media/Series2/UploadsWeb/'
		    	$email = new Email('default');
		    	$email->from(['upload@gomines.rez' => 'Uploads'])
		    	->to($mail)
		    	->subject($objet)
		    	->send('Un nouveau fichier a été uploadé par '. $user['nom'].' '.$user['prenom'].'!');
		    	$messages[] = $filename." a bien été enregistré !";
		    }
		    else{
		        $messages[] = $filename." n'a pas été enregistré : extension non autorisée...";
		    }
		}


		$fichier = fopen('fichier', 'w'); /*Andres tu vas pas aimer mais j'ai pas trouver d'autre solution... Le fichier est supprimé dans le controller suivant...*/
		fputs($fichier, $filename);
		fclose($fichier);
		$this->set(['messages' => $messages]);


	}

	public function traitement()
	{
		$fichier = fopen("fichier", 'r');
		$nom_fichier = fgets($fichier);
		/*unlink($fichier); supprime le fichier créer juste au dessus*/
		$files = $this->request->data;
		$new_name = $files['nom'];
		if($files['nom'] == "") 
		{
			$nom_fichier = "...";
		}
		if($files['qualite'] != "Inconnue")
		{
			$new_name .= " - ".$files['qualite'];
		}
		if($files['date'] > 1900)
		{
			$new_name .= " - ".$files['date'];
		}
		$extension = preg_split("/\./", $nom_fichier); /*On récupère l'extension du fichier*/
		$new_name .= ".".$extension[count($extension) - 1];
		if($nom_fichier != "...")
			/*rajouter le Script de Andres permettant de déterminer le disque le moins utilisé*/
			rename($GLOBALS['Autre'].$new_name, $GLOBALS[$type].$new_name);
		$this->set(compact('nom_fichier'));

		
	}
}
