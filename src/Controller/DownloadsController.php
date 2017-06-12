<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;
use Cake\Http\Client\Request;
use Cake\Event\Event;

class DownloadsController extends AppController
{

    private function docTypeAndColor($filename){
        $ext_excel = ['xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw', 'ods'];
        $ext_pdf = ['pdf'];
        $ext_word = ['docx', 'doc', 'dot', 'docm', 'dotx', 'dotm', 'docb', 'odt'];
        $ext_sound = ['mp3', 'wav'];
        $ext_archive = ['gz', 'rar', 'tar', 'zip'];
        $ext_image = ['png', 'gif', 'bmp', 'jpeg', 'jpg', 'jpe'];
        $ext_text = ['txt'];
        $ext_video = ['mkv, avi'];
        $ext_code = ['html', 'XML', 'h', 'hpp', 'cpp', 'c', 'vhd', 'php', 'js', 'css', 'ctp', 'py'];
        $ext_powerpoint = ['ppt', 'pot', 'pps', 'pptx', 'pptm', 'potx', 'potm', 'ppam', 'ppsx', 'ppsm', 'sldx', 'sldm'];

        $ext=strrchr($filename,'.');
        $ext=substr($ext,1);

        if(in_array($ext, $ext_excel))
            return ['type' => '-excel', 'color' => '#208A45'];
        if(in_array($ext, $ext_pdf))
            return ['type' => '-pdf', 'color' => '#CA1C00'];
        if(in_array($ext, $ext_word))
            return ['type' => '-word', 'color' => '#395496'];
        if(in_array($ext, $ext_sound))
            return ['type' => '-sound', 'color' => '#FF8040'];
        if(in_array($ext, $ext_archive))
            return ['type' => '-archive', 'color' => '#A93B88'];
        if(in_array($ext, $ext_image))
            return ['type' => '-image', 'color' => '#800000'];
        if(in_array($ext, $ext_text))
            return ['type' => '-text', 'color' => '#0080FF'];
        if(in_array($ext, $ext_video))
            return ['type' => '-video', 'color' => '#FF8000'];
        if(in_array($ext, $ext_code))
            return ['type' => '-code', 'color' => '#8080FF'];
        if(in_array($ext, $ext_powerpoint))
            return ['type' => '-powerpoint', 'color' => '#C14424'];

        return ['type' => '', 'color' => 'black'];
    }

    public function display($subcat = "")
    {
    	$this->loadModel('DLCategory');
    	$column = 2;
    	$limit = 10;
    	
    	
    	$categories = $this->DLCategory->find('all');
    	$numberCat = $categories->count();
    	
    	
    	while($numberCat%$column!=0 && $column!=$limit){
    		$column++;
    		
    	}
    	$row = $numberCat/$column;
    	$categories = $categories->toArray();

        $this->set(compact("categories", "row", "column"));
    }

    // TO-DO : Review this function
    // TO-DO : Ajouter lien de retour qui, lorsque l'on est au top-level d'une catégorie, nous ramène à  la page de la catégorie
    // Affiche le contenu des dossiers & permet le téléchargement de fichiers
    public function files($virtFolder = "", $path = ""){
    	// Récupération Conf + Init variables
    	$conf = Configure::read("FileFolders");
    	$hiddenFiles = Configure::read("HiddenFiles");
    	$directory = [];
    	$file = false;
        $filesData = [[],[]];

    	// Lecture du dossier virtuel
    	if($virtFolder == "")
    		throw new NotFoundException('Dossier inexistant.');
    	if(!isset($conf[$virtFolder]))
    		throw new NotFoundException('Dossier inexistant.');
        $dir = $conf[$virtFolder]['folder'];
        if(!is_array($dir))
            $dir = [$dir];
        
        
        foreach($dir as $d)
        {
            $directory = $d."/";
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

                $filesData[0] = array_merge($filesData[0],$files[0]);

                foreach($files[1] as $key => $f){
                    $filesData[1][$f] =    [
                                            'file' => $f,
                                            'type' => $this->docTypeAndColor($f)['type'],
                                            'color' => $this->docTypeAndColor($f)['color']
                                        ];
                }

    	    	$this->set(compact("filesData", "vpath", "readme"));
    			// files : liste des dossiers & fichiers du dossier courant
    			// vpath : répertoire dans lequel se trouve l'utilisateur
        	}
        }
    }

    public function files2($virtFolder){ //virtFolder sert à créer le lien dans la vue
    	$this->isAuthorized(0);
    	
    	$this->loadModel('Contents');
    	$this->loadModel('DLCategory');
    	$subFolder = preg_split("#/#",$this->request->here);
    	$searchFolder = $subFolder[2];
    	
    	if(count($subFolder) < 4){ //cas sous-dossiers
    		$content = $this->Contents->find('all', ['contain'=>'DLCategory'])->where(['DLCategory.name'=>$virtFolder])
    																		->where(['virtual_path'=>'']);
    		$subFolder = '';
    	}else{
    		$subFolder = htmlspecialchars(urldecode(str_replace("%20", " ", $this->constructPath($subFolder))));
    		$content = $this->Contents->find('all', ['contain'=>['DLCategory', 'Folders']])
							    		->where(['DLCategory.name LIKE'=> '%'.$searchFolder.'%'])
							    		->where(['virtual_path'=>$subFolder]);
    	}
    	
        $this->set(compact('content', 'subFolder', 'virtFolder'));

    }
    
    //construit un path à  partir d'un array split en ne prennant pas en compte les 2 premiers
    private function constructPath($arrFolder, $start = 3){
    	$res = "";
    	foreach($arrFolder as $key => $elmt){
    		if ($key>=$start){
    			$res.=$elmt."/";
    		}
    	}
    	return $res;
    }

    
    public function dlFile($id){
    	$Content = TableRegistry::get('Contents')->get($id);
    	$directory = $Content->path;
    	$name = $Content->name;
        // Télécharger le fichier
        $this->response->file($directory, array(
            'download' => true,
            'name' => $name,
        ));
        $hFile = new File($directory);
        $this->response->type($hFile->mime());
        return $this->response;
    }
	
    public function dlFolder($virtPath){
    	$this->isAuthorized(0);
    	$this->loadModel("Folders");
    	
    	$dir = getcwd();
//     	debug($folder->path."/".$virtPath);
    	chdir($folder->path."/".$virtPath);
//     	debug($virtPath);
    	
    	$fp = popen('zip -0 -r - .', 'r');
    	chdir($dir);
    	
    	$this->response->header([
    		"Content-Disposition" => 'attachment; filename="Gomines.zip"',
    	]);
    	$this->response->type("zip");
    	
    	$this->response->body(function() use ($fp) {
    		$bufsize = 8192;
    		$buff = '';
    		while( !feof($fp) ) {
    			$buff = fread($fp, $bufsize);
    			echo $buff;
    		}
    		pclose($fp);
    	});
    	
    	return $this->response;
    }
    //permet de télécharger tout un dossier
    // TO-DO: Bien nettoyer $path
    public function download($virtFolder = "", $path = ""){
        // Récupération Conf + Init variables
    	$conf = Configure::read("FileFolders");
    	$directory = [];
    	$file = false;
        $filesData = [[],[]];

    	// Lecture du dossier virtuel
    	if($virtFolder == "")
    		throw new NotFoundException('Dossier inexistant.');
    	if(!isset($conf[$virtFolder]))
    		throw new NotFoundException('Dossier inexistant.');
        $dir = $conf[$virtFolder]['folder'];
        if(!is_array($dir))
            $dir = [$dir];

        foreach($dir as $d)
        {
            $directory = $d."/";
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
                // Télécharge le dossier
                $dir = getcwd();
                chdir($directory);
                $fp = popen('zip -0 -r - .', 'r');
                chdir($dir);

                $this->response->header([
                    "Content-Disposition" => 'attachment; filename="Gomines.zip"',
                ]);
                $this->response->type("zip");

                $this->response->body(function() use ($fp) {
                    $bufsize = 8192;
                    $buff = '';
                    while( !feof($fp) ) {
                        $buff = fread($fp, $bufsize);
                        echo $buff;
                    }
                    pclose($fp);
                });

                return $this->response;
        	}
        }
    }
    
    public function beforeRender(Event $event)
    {
    	parent::beforeRender($event);
    	$this->viewBuilder()->helpers(['FileSize']);
    }
}
