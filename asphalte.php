<?php 
/**
 * Asphalte - Simple PHP routing system
 *
 * @author      Xavier Egoneau
 * @copyright   2016 Xavier Egoneau
 * @version     3.0
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
 * Doc :	
 * https://github.com/hellointeractiv/asphalte/blob/master/README.md
 *
 */

class Asphalte {
	
	private static $routeArray = [];	
	
	public function __construct() {
	    
	    if(isset($_SERVER["REQUEST_URI"])){	$request = $_SERVER["REQUEST_URI"];	}else {$request = null;}
	    
	}
	
	public function check_404(callable $fonction) {
	    $result = false;
	    foreach ($this::$routeArray as $route) {

	        if ($route["statut"]) {
	            $result = true;
	        }
	    }

	    if(!$result){
	    return $fonction();
	    }
	}
	
	public function map($request) {
		$array = explode("/", $request);
		return $array;
	}
	public function run($type, $request_client) {
	    
    	    /*
    	    | -------------
    	    | init vars
    	    | -------------
    	    */
    
    	    $statut = false;
    	    $request = array();
    	    $size = false;
	        $route = [];
            /*
			| -------------
			| on va chercher la requette
			| -------------
			*/
			
			if(isset($_SERVER["REQUEST_URI"])){	$request_test = $_SERVER["REQUEST_URI"];	}else {$request_test = null;}
			
			if(strtolower($_SERVER['REQUEST_METHOD']) == strtolower($type) or $type=="any" ){
				
				$statut = true;
			
			
				/*
				| -------------
				| on transforme es requetes en array
				| -------------
				*/
				$requestArray = $this->map($request_test);
				$request = $requestArray;
				$request_client_array = $this->map($request_client);
				
				/*
				| -------------
				| on compare la taille des 2 requetes
				| -------------
				*/
				if(sizeof($requestArray) == sizeof($request_client_array)  ){
					$size = true;
				}else{
					$statut = false;
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
									$statut=false;
	
									
								}
								
								/*
								| -------------
								| si la variable est dynamique on instancie GET avec le nom de variable donné par le client
								| -------------
								*/
								if(sizeof($test_variable_dynamique) > 1){

									$name = $test_variable_dynamique[1];
									$route[$name] = $requestArray[$i];
								}
								
							
						}
				}
					
			}else{
					$statut = false;
			}
			
			/*
			| -------------
			| on envoie la réponse !
			| -------------
			*/
            
            $route["statut"] = $statut;
            $route["request"] = $request;
            $route["size"] = $size;
            
           
            $this::$routeArray[] = $route;
            //dd($route);
			return (object) $route;
	    
	        //return $fonction($route);
	}
	
	

	
	public function get_map(){
		
			$route = array();
			/*
			| -------------
			| on va chercher la requette
			| -------------
			*/
			
			$request = $_SERVER["REQUEST_URI"];
			
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
	

	
	public function get($request_client, callable $fonction){
		$route = $this->run("get", $request_client);
		if($route->statut){return $fonction($route);}
	}
	public function post($request_client, callable $fonction){
		$route = $this->run("post", $request_client);
		if($route->statut){return $fonction($route);}
	}
	public function any($request_client, callable $fonction){
		$route = $this->run("any", $request_client);
		if($route->statut){return $fonction($route);}
		
	}
	public function put($request_client, callable $fonction){
		$route = $this->run("put", $request_client);
		if($route->statut){return $fonction($route);}
	}
	public function delete($request_client, callable $fonction){
		$route = $this->run("delete", $request_client);
		if($route->statut){return $fonction($route);}
	}
	
	public function match($type, $request_client, $chemin){
		$route = $this->run($type, $request_client);
		if($route->statut){
		    
		    $route_explode = explode("@", $chemin);
		    if(sizeof($route_explode)>1){
		        $target_controler = new $route_explode[0]();
		        $target_fnctn = $route_explode[1];
		        
		        if( method_exists($target_controler,$target_fnctn) ){
		             ob_start();
		             $target_controler->$target_fnctn();
		             $result = ob_get_contents();
		             ob_end_clean();
		        }
		    }else{
		        $result ="";
		    }
		    
		    
		    echo $result;
		}
	}
	
	
}
