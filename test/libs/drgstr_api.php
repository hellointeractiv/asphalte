<? if ( ! defined('app')) die('Accès Interdit');
	
	/**
	 * api call - a simple class to call api with unirest
	 *
	 * @author      Xavier Egoneau
	 * @copyright   2014 Xavier Egoneau
	 * @version     1.0
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
	 
	 class Api {
	 		
	 		public function send($type, $url, $headers, $body){
	 				global $app;
	 				
	 				Unirest\Request::timeout(50);
	 				Unirest\Request::verifyPeer(false); // Disables SSL cert validation
	 				//$auth = Unirest\Request::auth($logs["auth"], $logs["login"]);
	 				
	 				if(strtolower($type)=="get"){
	 					$response = Unirest\Request::get( $url, $headers, $body);
	 				}else if(strtolower($type)=="post"){
	 					$response = Unirest\Request::post( $url, $headers, $body);
	 				}else if(strtolower($type)=="put"){
	 					$response = Unirest\Request::put( $url, $headers, $body);
	 				}else if(strtolower($type)=="delete"){
	 					$response = Unirest\Request::delete( $url, $headers, $body);
	 				}
	 				
	 				$response->code;        // HTTP Status code
	 				$response->headers;     // Headers
	 				$response->body;        // Parsed body
	 				$response->raw_body;    // Unparsed body
	 				
	 				$resultat = $response->raw_body;
	 				$resultat2 = json_decode($resultat,true);	
	 				$resultat3 = json_encode($resultat2);
	 				//var_dump($response);
	 				return $resultat3;
	 				
	 		}
	 		
	 		public function get($request,$datas=array()) {
	 			 				
	 			 				global $app;
	 			 						
	 			 				$headers = array("Accept" => "application/json","Content-Type"=>"application/json");
	 			 				$body = json_encode(array(
	 			 					"data"=>$datas
	 			 				));
	 		
	 							$result = $this->send("get",$app['url_api'].$request, $headers, $body);
	 			 				return json_decode($result ,true);
	 			 				
	 		}
	 		
	 		public function post($request,$datas=array()) {
	 				
	 				global $app;
	 						
	 				$headers = array("Accept" => "application/json","Content-Type"=>"application/json");
	 				$body = json_encode(array(
	 					"data"=>$datas
	 				));

					$result = $this->send("post",$app['url_api'].$request, $headers, $body);
	 				return json_decode($result ,true);
	 				
	 		}
	 		
	 		public function put($request,$datas=array()) {
	 			 				
					global $app;
	 						
	 				$headers = array("Accept" => "application/json","Content-Type"=>"application/json");
	 				$body = json_encode(array(
	 					"data"=>$datas
	 				));

					$result = $this->send("put",$app['url_api'].$request, $headers, $body);
	 				return json_decode($result ,true);
	 			 				
	 		}
	 		
	 		public function delete($request) {
	 			 				
					global $app;
	 						
	 				$headers = array("Accept" => "application/json","Content-Type"=>"application/json");
	 				$body = "";

					$result = $this->send("delete",$app['url_api'].$request, $headers, $body);
	 				return json_decode($result ,true);
	 			 				
	 		}
	 		
	 		 
	 
	 }

?>
