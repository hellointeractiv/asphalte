# Asphalte
minimal route system class in php Objet


## Install

```php

require('asphalte.php');

$route = new Asphalte;	

```



## How to use 

```php

// Exemple 
$route->get("article/:id"); 
// return 2 variables in array(object) statut and route 
//route can be have many vars in array )

// For exemple  :
if(	$route->get("article/:id")->statut	){	
  echo " we view the article page id : ".$route->get("article/:id")->route["id"];
}

// Other exemples :
if(	$route->get("")->statut	){	
  echo "ok we view the home page.";
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
