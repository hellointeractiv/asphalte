# Asphalte
minimal route system class in php


## install

```php

require('asphalte.php');

$route = new Asphalte;	

```

## principle

```php

$route->get("article/:id"); 
// return 2 variables in array(object) statut and route 
//route can be have many vars in array )

//exemple 
echo $route->get("article/:id")->route["id"];
echo $route->get("article/:id")->statut;

```

## use 

```php
if(	$route->get("")->statut	){	
  echo "ok we view the home page.";
}

if(	$route->get("article/:id")->statut	){	
  echo " we view the article page id : ".$route->get("article/:id")->id;
}


if(	$route->get(":id")->statut	){  ...  }

if(	$route->get("user/:userid")->statut	){  ...  }

if(	$route->post("ajax/:action")->statut	){  ...  }

```

## REST

```php
if(	$route->put(":id")->statut	){  ...  }

if(	$route->delete(":id")->statut	){  ...  }

```
