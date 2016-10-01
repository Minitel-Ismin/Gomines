<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use App\Controller\AppController;
    
/*
 * File manager controller
 */
class FileManagerController extends AppController
{
    /*
     * Index method
     * 
     * @return void
     */
    public function target()
    {
    	$this->isAuthorized(2);
        //Changer l'url du script "fileManager.js" pour avoir l'url
        //de target en absolu
        $this->viewClass = "Ajax";
        
        $source = $this->request->data["srcfolder"].$this->request->data["source"]; //le "/" est déjà dedans, cf ci-bas
        $destination = $this->request->data["destination"];
        $extension = strrchr($this->request->data["source"],'.');
        $nouveauNom = $this->request->data["nouveauNom"].$extension;

        if(rename($source,$destination.'/'.$nouveauNom)){
            $msg = "success";
        }
        else{
            $msg = "failure";
        }
        
        $this->set(compact('msg'));
    }
    
    public function files($path = ""){
        $this->isAuthorized(2);
    	// Récupération Conf + Init variables
    	$conf = Configure::read("FileFolders");
    	$directory = [];

    	// Lecture du dossier virtuel
    	$directory = $conf['AClasser']['folder']."/";
		$this->set(compact("directory"));
    	// Lecture du path
    	if($path != ""){
    		// TODO : Sanitize $path var
    		$directory .= $path;
    	}

    	// Vérification et Lecture
        $directory = new Folder($directory);
        $files = $directory->read(true);

        $this->set(compact("files"));
        // files : liste des dossiers & fichiers du dossier courant
        // vpath : répertoire dans lequel se trouve l'utilisateur
        $i = 0;
        $folder = []; //contient tout les dossiers ayant une propriété folder ==> un dossier de fichiers
        foreach($conf as $categorie){
            if($i>0){
                if($categorie['folder']){
                	$temp = preg_split('#\/#', $categorie['folder']);
                    $idFolder[$i] = $temp[count($temp)-1];
                    $folder[$i] = $categorie['folder'];
                }
            }
            $i++;
        }
        $this->set(compact("idFolder", "folder"));
    }
    
}