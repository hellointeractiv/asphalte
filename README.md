# Asphalte
minimal route system class in php


## install

```php

require('asphalte.php');

$route = new Asphalte;	

```

## use 

```php
if(	$route->get("")->statut	){	
  echo $route->get("")->statut;
}

if(	$route->get("article/:id")->statut	){	
  echo " we view the article id : ".$route->get("article/:id")->id;
}

if(	$route->get("")	){  ...  }

if(	$route->get(":id")	){  ...  }

if(	$route->get("user/:userid")	){  ...  }

if(	$route->post("ajax/:action")	){  ...  }

```

## REST

```php
if(	$route->put(":id")	){  ...  }

if(	$route->delete(":id")	){  ...  }

```
