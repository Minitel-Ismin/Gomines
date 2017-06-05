<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/*
 * File manager controller
 */
class FileManagerController extends AppController {
	/*
	 * Index method
	 *
	 * @return void
	 */
	public function target() {
		$this->isAuthorized ( 2 );
		$this->loadModel ( "Contents" );
		$this->loadModel ( "Folders" );
		// Changer l'url du script "fileManager.js" pour avoir l'url
		// de target en absolu
		$this->viewClass = "Ajax";
		
		$source = $this->request->data ["srcfolder"] . $this->request->data ["source"]; // le "/" est déjà dedans, cf ci-bas
		
		$destination = $this->Folders->get ( $this->request->data ["destination"], [ 
				'contain' => [ 
						'DLCategory' 
				] 
		] );
		
		$extension = strrchr ( $this->request->data ["source"], '.' );
		$nouveauNom = $this->request->data ["nouveauNom"] . $extension;
		if (rename ( $source, $destination->path . $this->request->data ["source"])) {
			// $film = $filmTable->newEntity();
			// $film->title = $destination.'/'.$nouveauNom;
			// $film->to_verify = 1;
			// $film->path = $destination.'/'.$nouveauNom;
			// $filmTable->save($film);

			$content = $this->Contents->newEntity ();
			$content->name = $nouveauNom;
			$content->path = $destination->path ."/". $this->request->data ["source"];
			$content->to_verify = 0;
			$content->size = filesize ( $source );
			$content->sub_folder = 0;
			$content->folder_id = $destination->id;
			$content->dlcategory_id = $destination->d_l_category->id;
			$this->Contents->save($content);
			$msg = "success";
		} else {
			$msg = "failure";
		}
		
		$this->set ( compact ( 'msg' ) );
	}
	
	public function files($path = "") {
		$this->isAuthorized ( 2 );
		$this->loadModel ( 'Folders' );
		$conf = Configure::read ( "FileFolders" );
		
		$folders = $this->Folders->find ( 'all' )->contain ( [ 
				'DLCategory' 
		] );
		// Récupération Conf + Init variables
		
		$directory = [ ];
		
		// Lecture du dossier virtuel
		$directory = $conf ['AClasser'] ['folder'] . "/";
		$this->set ( compact ( "directory" ) ); // dossier du fichier initial
		                                        // Lecture du path
		if ($path != "") {
			// TODO : Sanitize $path var
			$directory .= $path;
		}
		
		// Vérification et Lecture
		$directory = new Folder ( $directory );
		$files = $directory->read ( true );
		
		$this->set ( compact ( "files" ) ); // fichiers présent dans le répertoire à classe
		
		$this->set ( compact ( "folders" ) ); // dossier présents sur le serveur
	}
}