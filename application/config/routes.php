<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller']            = "home";

//############################| Usu‡rio |#################################

$route['logout']                        = "usuarios/logout";
$route['numeros']                       = "usuarios/numeros";
$route['perfil/(:any)']                 = "usuarios/perfil/$1";
$route['foto']                          = "usuarios/foto";
$route['esqueci']                       = "usuarios/esqueci_senha";
$route['trocasenha/(:any)']             = "usuarios/trocasenha/$1";
$route['cadastre-se']                 	= "usuarios/cadastro";
$route['alterar-dados']                 = "usuarios/alterar";
$route['ativar']                        = "usuarios/ativar";

//############################| Admin |#################################


$route['galeria/upload/(:any)']  		= 'galeria/upload/$1';
$route['galeria/listar'] 		  		= 'galeria/listar';
$route['galeria/save'] 					= 'galeria/save';
$route['galeria/delete'] 				= 'galeria/delete';

$route['admin']                      	= "administradores/admin";
$route['admin/login']                   = "administradores/admin/login";
$route['admin/logout']                  = "administradores/admin/logout";
$route['admin/dashboard']               = "dashboard";

$route['admin/([a-zA-Z_-]+)/(:num)'] 	= '$1/admin/index/$2';
$route['admin/([a-zA-Z_-]+)/(:any)'] 	= '$1/admin/$2';

$route['admin/([a-zA-Z_-]+)']           = '$1/admin/index';
	
$route['([a-zA-Z_-]+)/admin/(:any)']	= '$1/admin/$2';

//######################| Controllers Padrões |#########################

$route['install/base'] 					= 'marty/install/base';
$route['install/(:any)'] 				= 'marty/install/index/$1';
$route['create/(:any)'] 				= 'marty/create/index/$1';
$route['get/(:any)'] 					= 'marty/get/index/$1';

$route['button/(:any)']					= 'button/$1';
$route['hauth/(:any)']					= 'hauth/$1';
$route['galeria/(:any)']				= 'galeria/$1';
$route['rotas/(:any)']					= 'rotas/$1';
$route['upload/(:any)']					= 'upload/$1';
$route['video/(:any)']					= 'video/$1';

//###########################| Ajax |################################

$route['ajax/paginas/(:any)']								= 'paginas/index';
$route['ajax/([a-zA-Z_-]+)/([a-zA-Z_-]+)/(:any)'] 			= '$1/$2/$3';
$route['ajax/([a-zA-Z_-]+)/(:any)']                        	= '$1/index/$2';
$route['ajax/(:any)']                        				= '$1';
$route[':any']                              				= 'home';

//###########################| Sistema |################################

$route['404_override'] 			= 'error';

//###########################| Routes |################################


//get routes from database
include('database.php');


if($db[$active_group]['pconnect'])
{
	@mysql_pconnect($db[$active_group]['hostname'],$db[$active_group]['username'],$db[$active_group]['password']);	
}
else
{
	mysql_connect($db[$active_group]['hostname'],$db[$active_group]['username'],$db[$active_group]['password']);	
}

mysql_select_db($db[$active_group]['database']) or die("Unable to select database");



$routes	= mysql_query('SELECT * FROM routes');

if($routes){
while($row = mysql_fetch_array($routes))
{
	//if "category" is in the route, then add some stuff for pagination
	//if(strpos($row['route'], 'category') || strpos($row['route'], 'loja') )
	//{
		$route[$row['slug']] = $row['route'];

		$row['slug'] 	.= '/(:num)';
		$row['route'] 	.= '/$1';
	//}
	$route[$row['slug']] = $row['route'];
}

mysql_free_result($routes);
}


//in case we're using pconnect
mysql_close();



/* End of file routes.php */
/* Location: ./application/config/routes.php */