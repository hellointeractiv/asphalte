# Asphalte
minimal route system class in php Objet


## Install

### Composer 
```
composer require hellointeractiv/asphalte
```
### or bower 
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

#### Install
```php

require('asphalte.php'); // or require_once("../app/vendor/autoload.php");

$route = new Asphalte;	

```



## How to use 

```php

# Exemple 
$result = "";

$result = $route->get('/test', function ($route) { 
    return $route;
});

# result return 3 variables in object(stdClass) statut request size and dynamic vars if there is

echo $result->statut;
echo $result->sizetatut;
var_dump($result->request);

#or

$result = $route->match('GET','/test', "base_controler@test");

# result lunch controler-> function if exeist

if($result==""){
    echo "404";
}else{
    echo $result;
}

# variables dynamic

$result = $route->get('/article/:id', function ($route) { 
    return $route;
});

echo $result->id;

# return 3 variables in object(stdClass) statut request and dynamic vars
#
# object(stdClass)(3) {  
#  ["statut"]=>bool(true),
#  ["request"]=>array(2) {
# 	[0]=>string(7) "article"
#    	[1]=>string(4) "test"
#  },
#  ["size"]=>2,	
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






if(	$route->get(...

if(	$route->post(...
if(	$route->any(...

```

## REST

```php
if(	$route->put(...

if(	$route->delete(...

```
