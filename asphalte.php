/**
 * route - a simple PHP routing system
 *
 * @author      Xavier Egoneau
 * @copyright   2016 Xavier Egoneau
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
			
			/*
			| -------------
			| init vars
			| -------------
			*/
			$return = array();
			$return["route"] = array();
			$return["statut"] = false;
			$return["request"] = array();
			$return["size"] = false;
			$size = false;
			/*
			| -------------
			| on va chercher la requette
			| -------------
			*/
			
			$request = $_GET['request'];
			
			if(strtolower($_SERVER['REQUEST_METHOD']) == strtolower($type) or $type=="any" ){
				
				$return["statut"] = true;
			
			
				/*
				| -------------
				| on transforme es requetes en array
				| -------------
				*/
				$requestArray = $this->map($request);
				$return["request"] = $requestArray;
				$request_client_array = $this->map($request_client);
				
				/*
				| -------------
				| on compare la taille des 2 requetes
				| -------------
				*/
				if(sizeof($requestArray) == sizeof($request_client_array)  ){
					$size = true;
					$return["size"] = $size;
				}else{
					$return["statut"] = false;
				}
				
				/*
				| -------------
				| si == on va comparer les formats des elements du tableau
				| -------------
				*/
				if($size == true){
			
						for ($i = 0; $i < sizeof($request_client_array); $i++) {
							  
							  //$return["statut"]=true;
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
									$return["statut"]=false;
	
									
								}//else{$return["statut"]=true;}
								
								/*
								| -------------
								| si la variable est dynamique on instancie GET avec le nom de variable donné par le client
								| -------------
								*/
								if(sizeof($test_variable_dynamique) > 1){
									//$route = (object) array($test_variable_dynamique[1] => $requestArray[$i]);
									$name = $test_variable_dynamique[1];
									$return[$name] = $requestArray[$i];
									//echo "id : ".$name. " content =".$requestArray[$i]." ";
								}
								
							
						}
				}
					
			}else{
					$return["statut"] = false;
			}
			
			/*
			| -------------
			| on envoie la réponse !
			| -------------
			*/
			//print_r($return["request"]);
			return (object) $return;
		
	}

	
	
	public function get_map(){
		
			$route = array();
			/*
			| -------------
			| on va chercher la requette
			| -------------
			*/
			
			$request = $_GET['request'];
			
			$route["method"] = strtolower($_SERVER['REQUEST_METHOD']);
			$route["request"] = $this->map($request);
			$route["size"] = sizeof($route["request"]);
			/*
			| -------------
			| on envoie la réponse !
			| -------------
			*/
			return (object) $route;
		
	}
	

	
	public function get($request_client){
		$return = $this->done("get", $request_client);
		return $return;
		
	}
	public function post($request_client){
		$return = $this->done("post", $request_client);
		return $return;
	}
	public function any($request_client){
		$return = $this->done("any", $request_client);
		return $return;
		
	}
	public function put($request_client){
		$return = $this->done("put", $request_client);
		return $return;
	}
	public function delete($request_client){
		$return = $this->done("delete", $request_client);
		return $return;
	}
	
	
}
