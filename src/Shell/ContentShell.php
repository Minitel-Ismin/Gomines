<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Content;

use Cake\Datasource\ConnectionManager;

/**
 * Content shell command.
 */
class ContentShell extends Shell {
	
	/**
	 * Manage the available sub-commands along with their arguments and help
	 *
	 * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
	 *
	 * @return \Cake\Console\ConsoleOptionParser
	 */
	public function getOptionParser() {
		$parser = parent::getOptionParser ();
		
		return $parser;
	}
	
	/**
	 * main() method.
	 *
	 * @return bool|int Success or error code.
	 */
	public function main() {
		$CategoryTable = TableRegistry::get ( 'DLCategory' );
		$ContentTable = TableRegistry::get ( 'contents' );
		$FolderTable = TableRegistry::get ( 'folders' );
		$category = $CategoryTable->find ( "all" )->contain ( [ 
				'folders',
				'contents' 
		] )->toArray ();
		
// 		dd($category);
		$this->out ( "(0) pour faire un import dans toutes les catégories" );
		//construit les tableau des catégories
		foreach ( $category as $key => $cat ) {
			$this->out ( "(" . ($key + 1) . ") " . $cat->name );
		}
		$cat = $this->in ( 'Quel catégorie importer?' );
		if ($cat) {
			$newContent = [ ];
			$category = $category [$cat - 1]; //sélectionne dans le tableau des catégories
			foreach ( $category->folders as $folder ) {
				$newFolderContent = [ ];
				
				$folder->path = str_replace ( '\\',  '/', $folder->path );
				$results = [ ];
				$this->getDirContents ( $folder->path, $results );
				foreach ( $results as $result ) {
					
					$path = str_replace ( '\\',  '/', $result["path"] );
					$path = str_ireplace($folder->path."/", "", $path);
					$temp = $ContentTable->findOrCreate ( [ 
// 							"name" => $result ["name"],
							"path" => $path
					] );
					if($temp->name==""){
						$temp->name = $result ["name"];
						
						//virtual path contient le chemin du fichier sans son nom
						$temp->virtual_path = str_replace($result ["name"], "", $path);
					}
					
					$temp->modified = date ( "Y-m-j H:i:s", filemtime ( $result ['path'] ) ); //date de modification = date de modification du fichier
					$temp->to_verify = 0; // à "vérifier"
					

					if (!isset($result['folder']) ) {
						$temp->size = $result ['filesize'];
						$temp->sub_folder = 0;
					} else {
						$temp->size = 0;
						$temp->sub_folder = 1;
					}
					$temp->folder_id = $folder->id;
					$temp->dlcategory_id = $category->id;
					$ContentTable->save($temp);
				}
			}
		}
		// TODO: pouvoir ajouter toutes les catégories d'un coup
	}
	
	//TODO: pouvoir faire un update des fichiers
	public function update(){
		
	}
	
	/**
	 * fonction lisant récursivement le dossier $dir spécifié
	 * 
	 * @param unknown $dir        	
	 * @param array $results        	
	 */
	private function getDirContents($dir, &$results = array()) {
		$files = scandir ( $dir );
		
		foreach ( $files as $key => $value ) {
			$path = realpath ( $dir . DIRECTORY_SEPARATOR . $value );
			$temp = [ ];
			$temp ["path"] = $path;
			$temp ["name"] = $value;
			if (! is_dir ( $path )) { // si ce n'est pas un dossier, on l'enregistre
				$temp ["filesize"] = filesize ( $path );
				$results [] = $temp;
			} else if ($value != "." && $value != "..") { // on continue dans les sous dossiers
				$temp ["folder"] = true;
				$results [] = $temp;
				$this->getDirContents ( $path, $results );
			}
		}
		
		return $results;
	}
}
