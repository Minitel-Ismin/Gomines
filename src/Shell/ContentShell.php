<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Content;

/**
 * Content shell command.
 */
class ContentShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() 
    {
    	$CategoryTable = TableRegistry::get('DLCategory');
    	$ContentTable = TableRegistry::get('contents');
    	$FolderTable = TableRegistry::get('folders');
    	$category = $CategoryTable->find("all")->contain(['folders','contents'])->toArray();
    	$this->out("(0) pour faire un import dans toutes les catégories");
    	foreach($category as $key=>$cat){
    		$this->out("(".($key+1).") ".$cat->name);
    	}
    	$cat = $this->in('Quel catégorie importer?');
    	if($cat){
    		$newContent = [];
    		$category=$category[$cat-1];
    		foreach ($category->folders as $folder){
    			$newFolderContent = [];

    			$folder->path = strtr($folder->path, '\\', '/');
    			$result=[];
    			$this->getDirContents($folder->path, $result);
    			foreach ($result as $res){
    				$temp = $ContentTable->findOrCreate(["name"=>$res["name"], "path"=>$res["path"]]);
    				
    					$temp->name = $res['name'];
    					$temp->path = $res['path'];
    					$temp->modified = date("Y-m-j H:i:s",filemtime($res['path']));
    					$temp->to_verify = 0;
    					$temp->virtual_path = substr(preg_split('/'.str_replace("/","\/",$folder->path).'/',strtr($temp->path, '\\', '/'))[1],1);
    					$temp->virtual_path = preg_split("#[^/]*$#", $temp->virtual_path)[0];
    					if(isset($res['filesize'])){
    						$temp->size = $res['filesize'];
    						$temp->sub_folder = false;
    					}else{
    						$temp->size=0;
    						$temp->sub_folder = true;
    					}
    					$newContent[] = $temp;
    					$newFolderContent[] = $temp;
    			}
    			$folder->contents = $newFolderContent;
    			$FolderTable->save($folder);

				
    		}
    		$category->contents = $newContent;
    		$CategoryTable->save($category);
    		
    	}
    	//TODO: pouvoir ajouter toutes les catégories d'un coup
    }

    
    /**
     * fonction lisant récursivement le dossier $dir spécifié
     * @param unknown $dir
     * @param array $results
     */
    private function getDirContents($dir, &$results = array()){
    	$files = scandir($dir);
    	
    	foreach($files as $key => $value){
    		$path = realpath($dir.DIRECTORY_SEPARATOR.$value);
    		$temp = [];
    		$temp["path"] = $path;
    		$temp["name"] = $value;
    		if(!is_dir($path)) { //si ce n'est pas un dossier, on l'enregistre
    			$temp["filesize"] = filesize ($path);
    			$results[] = $temp;
    		} else if($value != "." && $value != "..") { //on continue dans les sous dossiers
    			$temp["folder"] = true;
    			$results[] = $temp;
    			$this->getDirContents($path, $results);
    		}
    	}
    
    	return $results;
    }
}
