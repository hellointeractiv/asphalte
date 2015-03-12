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
