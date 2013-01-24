<?php

/*
|--------------------------------------------------------------------------
| Localtime Library
|--------------------------------------------------------------------------
|
| Map Localtime Library using PSR-0 standard namespace.
|
*/

Autoloader::namespaces(array(
	'Localtime\Model' => Bundle::path('localtime').'models'.DS,
	'Localtime'       => Bundle::path('localtime').'libraries'.DS,
));