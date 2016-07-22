<?php

namespace App\Shell;


use Cake\Console\Shell;

use Cake\Network\Http\Client;
use App\Model\Entity\Film;
use Cake\ORM\TableRegistry;

class FilmInfoShell extends Shell{
	
	/**
	 *
	 * Documentation de l'api allocine v3 : https://wiki.gromez.fr/dev/api/allocine_v3
	 * exemple de départ : 
	 * 
	 */
	
	private $_api_url = 'http://api.allocine.fr/rest/v3';
	private $_partner_key = '100043982026';
	private $_secret_key = '29d185d98c984a359e6e6f26a0474269';
	private $_user_agent = 'Dalvik/1.6.0 (Linux; U; Android 4.2.2; Nexus 4 Build/JDQ39E)';
	
	
	public function main($directory)
	{
	
		$file_response = 'response.txt';
		$dir = scandir($directory);
		
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
				$searchResult = $this->search($temp);
				
// 				var_dump($searchResult);
				//test du nombre de résultat
				if($searchResult["feed"]["totalResults"] > 5){
					rename($directory."/".$elmt,$directory."/a_traite/".$elmt);
				}else{ //sinon on prend le premier résultat (indice 0) mais on met le status "à vérifier"
					$filmTable = TableRegistry::get('Film');
					$query = $filmTable->find()->where(['allocine_code'=>$searchResult["feed"]["movie"][0]["code"]]);
// 					$filmTable
					//si le film existe déjà, on le met dans le dossier doublon (vérifier la qwalitay)
					if($query->first() != NULL){
						rename($directory."/".$elmt,$directory."/doublon/".$elmt);
					}else{
						$film = $filmTable->newEntity();
						$film->title = $searchResult["feed"]["movie"][0]["title"];
						$film->allocine_code = $searchResult["feed"]["movie"][0]["code"];
						$film->year = $searchResult["feed"]["movie"][0]["productionYear"];
						$film->actors = $searchResult["feed"]["movie"][0]["castingShort"]["actors"];
						$film->directors = $searchResult["feed"]["movie"][0]["castingShort"]["directors"];
						$film->path = $directory."/".$elmt;
						$film->press_rate = $searchResult["feed"]["movie"][0]["statistics"]["pressRating"];
						$film->user_rate = $searchResult["feed"]["movie"][0]["statistics"]["userRating"];
						$film->poster = $searchResult["feed"]["movie"][0]["poster"]["href"];
						$film->allocine_link = $searchResult["feed"]["movie"][0]["link"][0]["href"];
						$film->size = filesize($directory."/".$elmt);
						
						if($searchResult["feed"]["totalResults"] == 1){
							$film->to_verify = 0;
						}
						
						$searchResult = $this->get($searchResult["feed"]["movie"][0]["code"]);
						
// 						$film->category = $searchResult["movie"]["genre"][0]["$"];
						$categoryTable = TableRegistry::get('Category');
						$category = $categoryTable->find()->where(["allocine_code"=>$searchResult["movie"]["genre"][0]["code"]])->first();
						if(!$category){
							$this->out("here");
							$category = $filmTable->category->newEntity();
							$category->name = $searchResult["movie"]["genre"][0]["$"];
							$category->allocine_code = $searchResult["movie"]["genre"][0]["code"];
						}
						$film->category = $category;
// 						var_dump($searchResult);
						$filmTable->save($film);
					}
				}
				
				
				
// 				var_dump($this->search($temp)["feed"]["totalResults"]);
// 				file_put_contents($file_response,json_encode($this->search($temp)), FILE_APPEND );
			}
		}
	}
	
	public function test(){
		//déplacer le fichier dans à traiter
		rename("E:\Film\Gods.of.Egypt.2016.FRENCH.BRRip.XViD-eVe.avi", "E:\Film\a_traite\Gods.of.Egypt.2016.FRENCH.BRRip.XViD-eVe.avi");
	}
	
	/**
	 * recherche un film ($query) 
	 * 
	 * @param unknown $query
	 */
	public function search($query)
	{
		// build the params
		$params = array(
				'partner' => $this->_partner_key,
				'q' => $query,
				'format' => 'json',
				'filter' => 'movie'
		);
		// do the request
		$response = $this->_do_request('search', $params);
		
		$response = json_decode($response, true);
		
		
// 		$this->out(var_dump($response));
		return $response;
	}
	
	/**
	 * 
	 * information sur un film
	 */
	public function get($id)
	{
		// build the params
		$params = array(
				'partner' => $this->_partner_key,
				'code' => $id,
				'profile' => 'large',
				'filter' => 'movie',
				'striptags' => 'synopsis,synopsisshort',
				'format' => 'json',
		);
		// do the request
		$response = $this->_do_request('movie', $params);
		$response = json_decode($response, true);
// 		$this->out($response);
		return $response;
	}
	
	
	private function _do_request($method, $params)
	{
		// build the URL
		$query_url = $this->_api_url.'/'.$method;
		// new algo to build the query
		$sed = date('Ymd');
		$sig = urlencode(base64_encode(sha1($this->_secret_key.http_build_query($params).'&sed='.$sed, true)));
		$query_url .= '?'.http_build_query($params).'&sed='.$sed.'&sig='.$sig;
		// do the request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $query_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->_user_agent);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
}