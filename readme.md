# Asphalte
minimal route system class in php Objet


## Install

#### Htaccess
```htaccess
RewriteEngine on
RewriteRule ^([a-zA-Z0-9\-\_\/\:]*)$ index.php?request=$1
```

#### Php
```php

require('asphalte.php');

$route = new Asphalte;	

```



## How to use 

```php

# Exemple 

$route->get("article/:id"); 

# return 3 variables in object(stdClass) statut request and dynamic vars
#
# object(stdClass)(3) {  
#  ["statut"]=>bool(true)
#  ["request"]=>array(2) {
#    				[0]=>string(7) "article"
#    				[1]=>string(4) "test"
#  			}
#  ["id"]=>string(4) "test"
# }

$route->get_map("test/:id");

#object(stdClass) (3) {
#	  ["method"]=>string(3) "get"
#	  ["request"]=>
#	  array(2) {
#	    [0]=>string(4) "test"
#	    [1]=>string(4) "ouoi"
#	  }
#	  ["size"]=>int(2)
# }
#route can be have many vars in array )


# For exemple  :

if(	$route->get("article/:category/:id")->statut	){	
  echo " we view the article page id : ".$route->get("article/:category/:id")->id;
  echo " we view the article category id : ".$route->get("article/:category/:id")->category;
}

# Other exemples :

if(	$route->get("")->statut	){	
  echo "ok we view the home page.";
}

if($route->any(":pageurl")->statut){
					
		... 
}

if(	$route->get(":id")->statut	){  ...  }

if(	$route->get("user/:userid")->statut	){  ...  }

if(	$route->post("ajax/:action")->statut	){  ...  }

if(	$route->any("ajax/:action")->statut	){  ...  } // for all

```

## REST

```php
if(	$route->put(":id")->statut	){  ...  }

if(	$route->delete(":id")->statut	){  ...  }

```
