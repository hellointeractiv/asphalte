# Asphalte
minimal route system class in php


## install

$app = array();

require('asphalte.php');

$route = new Asphalte;


## use 

```php
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
