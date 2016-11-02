# Asphalte
minimal route system class in php Objet


## Install

### Composer 
```
composer require hellointeractiv/asphalte
```
### or 
```
"hellointeractiv/asphalte": "2.0.0"
```

#### Htaccess
```htaccess
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule .* index.php [L]
</IfModule>
```

#### Php
```php

require('asphalte.php'); // or require_once("../app/vendor/autoload.php");

$route = new Asphalte;	

```



## How to use 

```php

# Exemple 
$result = "";

$result = app("asphalte")->get('/test', function ($route) { 
    return $route;
});
# return 3 variables in object(stdClass) statut request and dynamic vars
echo $result->statut;
echo $result->statut;
var_dump($result->request);

#or

$result = app("asphalte")->match('GET','/test', "base_controler@test");

if($result==""){
    echo construct("base_controler@view404");
}else{
    echo $result;
}

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
