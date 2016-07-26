<?php

namespace App\Shell;


use Cake\Console\Shell;

use Cake\Network\Http\Client;
use App\Model\Entity\Film;
use Cake\ORM\TableRegistry;
use App\Helpers\Allocine;

class FilmInfoShell extends Shell{
	
	
	
	
	public function main($directory)
	{
	
		$dir = scandir($directory);
		
		$allocine = new Allocine();
		
		foreach($dir as $elmt){
			if($elmt != '.' && $elmt != ".." && $elmt != "doublon" && $elmt!="a_traite"){
				$temp = $elmt;
				$limit = 10;
				
				//remove all dot before the date
				while(!preg_match("#.\d{4}$#", $temp) && $limit){
					$temp = preg_replace('/\\.[^.\\s]{3,}$/', '', $temp);
					$limit--;	
				}
				
				
				//remove [ .. ]
				$temp = preg_replace("#\[.+\]\s*#", '', $temp);
				
				$temp = preg_replace("#www.+com#", '',$temp);
				
				//remove dot
				$temp = str_replace('.', ' ', $temp);
				// keep name before year
				$temp = preg_split("/\(*\d{4}/", $temp)[0];
				
				//on effectue la recherche
				$searchResult = $allocine->search($temp);
				
				
				
				$filmTable = TableRegistry::get('Film');
				//test du nombre de résultat
				if(isset($searchResult["error"]) || $searchResult["feed"]["totalResults"] > 5){
					try{
						rename($directory."/".$elmt,$directory."/a_traite/".$elmt);
					}catch (Exception $e){
						$this->out("erreur lors du déplacement de".$elmt);
					}
					
					$film = $filmTable->newEntity();
					$film->title = $elmt;
					$film->to_verify = 1;
// 					$film->allocine_code = $searchResult["feed"]["movie"][0]["code"];
// 					$film->year = $searchResult["feed"]["movie"][0]["productionYear"];
// 					$film->actors = $searchResult["feed"]["movie"][0]["castingShort"]["actors"];
// 					$film->directors = $searchResult["feed"]["movie"][0]["castingShort"]["directors"];
// 					$film->path = $directory."/".$elmt;
// 					$film->press_rate = $searchResult["feed"]["movie"][0]["statistics"]["pressRating"];
// 					$film->user_rate = $searchResult["feed"]["movie"][0]["statistics"]["userRating"];
// 					$film->poster = $searchResult["feed"]["movie"][0]["poster"]["href"];
// 					$film->allocine_link = $searchResult["feed"]["movie"][0]["link"][0]["href"];
// 					$film->size = filesize($directory."/".$elmt);
					$filmTable->save($film);
				}else if($searchResult["feed"]["totalResults"] > 0){ //sinon on prend le premier résultat (indice 0) mais on met le status "à vérifier"
					
					$query = $filmTable->find()->where(['allocine_code'=>$searchResult["feed"]["movie"][0]["code"]]);
// 					$filmTable
					//si le film existe déjà, on le met dans le dossier doublon (vérifier la qwalitay)
					if($query->first() != NULL){
						rename($directory."/".$elmt,$directory."/doublon/".$elmt);
					}else{
// 						var_dump($searchResult);
						$film = $filmTable->newEntity();
						(isset($searchResult["feed"]["movie"][0]["title"])) ? $film->title = $searchResult["feed"]["movie"][0]["title"]:$film->title = $searchResult["feed"]["movie"][0]["originalTitle"];

						
						
						$film->allocine_code = $searchResult["feed"]["movie"][0]["code"];
						$film->year = $searchResult["feed"]["movie"][0]["productionYear"];
						$film->actors = $searchResult["feed"]["movie"][0]["castingShort"]["actors"];
						$film->directors = $searchResult["feed"]["movie"][0]["castingShort"]["directors"];
						$film->path = $directory."/".$elmt;
						(isset($searchResult["feed"]["movie"][0]["statistics"]["pressRating"]))? $film->press_rate = $searchResult["feed"]["movie"][0]["statistics"]["pressRating"]:$film->press_rate=0 ;
						(isset($searchResult["feed"]["movie"][0]["statistics"]["userRating"]))? $film->user_rate = $searchResult["feed"]["movie"][0]["statistics"]["userRating"]:$film->user_rate = 0;
// 						if(isset)
						(isset($searchResult["feed"]["movie"][0]["poster"]["href"]))?$film->poster = $searchResult["feed"]["movie"][0]["poster"]["href"]:$film->poster="";
						$film->allocine_link = $searchResult["feed"]["movie"][0]["link"][0]["href"];
						$film->size = filesize($directory."/".$elmt);
						
						if($searchResult["feed"]["totalResults"] == 1){
							$film->to_verify = 0;
						}
						
						$searchResult = $allocine->get($searchResult["feed"]["movie"][0]["code"]);
						
// 						$film->category = $searchResult["movie"]["genre"][0]["$"];
						$categoryTable = TableRegistry::get('Category');
						$category = $categoryTable->find()->where(["allocine_code"=>$searchResult["movie"]["genre"][0]["code"]])->first();
						if(!$category){
							if(isset($searchResult["movie"]["genre"][0]["$"])){
								$category = $filmTable->category->newEntity();
								$category->name = $searchResult["movie"]["genre"][0]["$"];
								$category->allocine_code = $searchResult["movie"]["genre"][0]["code"];
							}
							
						}
						$film->category = $category;
						$filmTable->save($film);
						
					}
					
				}
				
				
			
			}
		}
	}
	
// 	public function test(){
// 		//déplacer le fichier dans à traiter
// // 		rename("E:\Film\Gods.of.Egypt.2016.FRENCH.BRRip.XViD-eVe.avi", "E:\Film\a_traite\Gods.of.Egypt.2016.FRENCH.BRRip.XViD-eVe.avi");
// 		$filmTable = TableRegistry::get('Film');
// 		$film = $filmTable->get(10,[
//     		'contain' => ['Category']
// 		]);
// 		$this->out($film->category);
// 	}
	
}