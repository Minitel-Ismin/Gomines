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
        //Changer l'url du script "fileManager.js" pour avoir l'url
        //de target en absolu
        $this->viewClass = "Ajax";
        
        $source = $_POST["srcfolder"]."/".$_POST["source"];
        $destination = $_POST["destination"];
        $extension = strrchr($_POST["source"],'.');
        $nouveauNom = $_POST["nouveauNom"].$extension;

        if(rename($source,$destination."/".$nouveauNom)){
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
        $folder = [];
        foreach($conf as $categorie){
            if($i>0){
                if($categorie['folder']){
                    $idFolder[$i] = substr($categorie['folder'], 15);
                    $folder[$i] = $categorie['folder'];
                }
            }
            $i++;
        }
        $this->set(compact("idFolder", "folder"));
    }
}