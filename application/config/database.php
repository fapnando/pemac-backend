<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'web';
$active_record = TRUE;

$db['local']['hostname'] = 'localhost';
$db['local']['username'] = 'root';
$db['local']['password'] = '';
$db['local']['database'] = 'pemac';
$db['local']['dbdriver'] = 'mysql';
$db['local']['dbprefix'] = '';
$db['local']['pconnect'] = TRUE;
$db['local']['db_debug'] = TRUE;
$db['local']['cache_on'] = FALSE;
$db['local']['cachedir'] = '';
$db['local']['char_set'] = 'utf8';
$db['local']['dbcollat'] = 'utf8_unicode_ci';
$db['local']['swap_pre'] = '';
$db['local']['autoinit'] = TRUE;
$db['local']['stricton'] = FALSE;

$db['web']['hostname'] = 'mysql01.pemaceng1.hospedagemdesites.ws';
$db['web']['username'] = 'pemaceng1';
$db['web']['password'] = 'pemac279';
$db['web']['database'] = 'pemaceng1';
$db['web']['dbdriver'] = 'mysql';
$db['web']['dbprefix'] = '';
$db['web']['pconnect'] = TRUE;
$db['web']['db_debug'] = TRUE;
$db['web']['cache_on'] = FALSE;
$db['web']['cachedir'] = '';
$db['web']['char_set'] = 'utf8';
$db['web']['dbcollat'] = 'utf8_unicode_ci';
$db['web']['swap_pre'] = '';
$db['web']['autoinit'] = TRUE;
$db['web']['stricton'] = FALSE;
/* End of file database.php */
/* Location: ./application/config/database.php */