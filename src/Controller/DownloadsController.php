<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class DownloadsController extends AppController
{
    public function display($subcat = "")
    {
    	$conf = Configure::read("FileFolders");
    	if($subcat != "" && isset($conf[$subcat])){
    		$cats = [];
    		foreach($conf as $n => $c)
    			if(isset($c['cat']) && $c['cat'] == $subcat)
    				$cats[$n] = $c;
    		$conf = $cats;
    	}
        $this->set(compact("conf", "subcat"));
    }

    // TO-DO : Review this function
    // TO-DO : Ajouter lien de retour qui, lorsque l'on est au top-level d'une catégorie, nous ramène à la page de la catégorie
    // Affiche le contenu des dossiers & permet le téléchargement de fichiers
    public function files($virtFolder = "", $path = ""){
    	// Récupération Conf + Init variables
    	$conf = Configure::read("FileFolders");
    	$hiddenFiles = Configure::read("HiddenFiles");
    	$directory = [];
    	$file = false;

    	// Lecture du dossier virtuel
    	if($virtFolder == "")
    		throw new NotFoundException('Dossier inexistant.');
    	if(!isset($conf[$virtFolder]))
    		throw new NotFoundException('Dossier inexistant.');
    	$directory = $conf[$virtFolder]['folder']."/";
    	$vpath = $virtFolder."/";

    	// Lecture du path
    	if($path != ""){
    		// TODO : Sanitize $path var
    		$directory .= $path;
    		$vpath .= $path;
    	}

    	// Vérification et Lecture
    	$file = is_file($directory);
    	if($file){
    		// Télécharger le fichier
    		$name = substr(strrchr($directory,"/"),1);
		    $this->response->file($directory, array(
		        'download' => true,
		        'name' => $name,
		    ));
		    $hFile = new File($directory);
			$this->response->type($hFile->mime());
		    return $this->response;
    	}else{
	    	$directory = new Folder($directory);
	    	$files = $directory->read(true,$hiddenFiles);

            $readme = $directory->find("readme\..*");
            if(count($readme) > 0){
                $readme = $readme[0];
                $readme = new File($directory->pwd()."/".$readme);
                $readme = $readme->read();
            }else{
                $readme = false;
            }

	    	$this->set(compact("files", "vpath", "readme"));
			// files : liste des dossiers & fichiers du dossier courant
			// vpath : répertoire dans lequel se trouve l'utilisateur
    	}
    }
}
