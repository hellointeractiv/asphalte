# asphalte
minimal route system class in php


## install

$app = array();

require('route.php');

$route = new Route;


## use 

if(	$route->get("")	){  ...  }

if(	$route->get(":id")	){  ...  }

if(	$route->get("user/:userid")	){  ...  }

if(	$route->post("ajax/:action")	){  ...  }


## work for rest API

if(	$route->put(":id")	){  ...  }
if(	$route->delete(":id")	){  ...  }
