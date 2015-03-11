<? if ( ! defined('app')) die('Accès Interdit');
/**
 * route - a simple PHP routing system
 *
 * @author      Xavier Egoneau
 * @copyright   2014 Xavier Egoneau
 * @version     2.0
 *
 * DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 *
 * Everyone is permitted to copy and distribute verbatim or modified
 * copies of this license document, and changing it is allowed as long
 * as the name is changed.
 *
 * DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 * TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
 *
 * 0. You just DO WHAT THE FUCK YOU WANT TO.
 *
 */

class Asphalte {
	
	public function map($request) {
		$array = explode("/", $request);
		return $array;
	}
	
	public function done($type, $request_client){
		global	$app;
			
			$app['route'] = array();
			/*
			| -------------
			| init $size
			| -------------
			*/
			$size = false;
			$return = true;
			/*
			| -------------
			| on va chercher la requette
			| -------------
			*/
			
			$request = $_GET['request'];
			
			if(strtolower($_SERVER['REQUEST_METHOD']) != strtolower($type) ){
					$return = false;
			}
			
			/*
			| -------------
			| on transforme es requetes en array
			| -------------
			*/
			$requestArray = $this->map($request);
			$request_client_array = $this->map($request_client);
			
			/*
			| -------------
			| on compare la taille des 2 requetes
			| -------------
			*/
			if(sizeof($requestArray) == sizeof($request_client_array)  ){
				$size = true;
			}
			
			/*
			| -------------
			| si == on va comparer les formats des elements du tableau
			| -------------
			*/
			if($size == true){
		
				for ($i = 0; $i < sizeof($request_client_array); $i++) {
					
					/*
					| -------------
					| on test si c'est une variable dynamique
					| -------------
					*/
					$test_variable_dynamique = explode(":", $request_client_array[$i]);
					
					/*
					| -------------
					| si la variable n'est pas dynamique et que la comparaison avec la route du client n'est pas ok : 
					| -------------
					*/
					if(sizeof($test_variable_dynamique) < 2 && $request_client_array[$i] != $requestArray[$i]){
						$return=false;
					}
					
					/*
					| -------------
					| si la variable est dynamique on instancie GET avec le nom de variable donné par le client
					| -------------
					*/
					if(sizeof($test_variable_dynamique) > 1){
						$app['route'][$test_variable_dynamique[1]]=$requestArray[$i];
					}
					
				}
					
				
			}else{
				$return = false;
			}
			
			/*
			| -------------
			| on envoie la réponse !
			| -------------
			*/
			return $return;
		
	}
	
	public function get($request_client){
		global	$app;
		$return = $this->done("get", $request_client);
		return $return;
	}
	public function post($request_client){
		global	$app;
		$return = $this->done("post", $request_client);
		return $return;
	}
	public function put($request_client){
		global	$app;
		$return = $this->done("put", $request_client);
		return $return;
	}
	public function delete($request_client){
		global	$app;
		$return = $this->done("delete", $request_client);
		return $return;
	}
	
	
}


?>
