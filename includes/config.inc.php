<?php
$pagetitle = array(
    'title' => 'Simple Website Ltd.',
);

$header = array(
    'imagesource' => 'logo.png',
    'imagealt' => 'logo',
	'title' => 'Simple Website',
	'motto' => ''
);

$footer = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'firm' => 'Simple Website Ltd.'
);

$pages = array(
	'/' => array('file' => 'home', 'text' => 'Home', 'menun' => array(1,1)),
	'introduction' => array('file' => 'introduction', 'text' => 'Introduction', 'menun' => array(1,1)),
	'contact' => array('file' => 'contact', 'text' => 'Contact', 'menun' => array(1,1)),
	'articles' => array('file' => 'articles', 'text' => 'Articles', 'menun' => array(1,1)),
    'table' => array('file' => 'table', 'text' => 'Table', 'menun' => array(1,1)),
    'login' => array('file' => 'login', 'text' => 'Login', 'menun' => array(1,0)),
    'login2' => array('file' => 'login2', 'text' => '', 'menun' => array(0,0)),
    'logout' => array('file' => 'logout', 'text' => 'Logout', 'menun' => array(0,1)),
    'register' => array('file' => 'register', 'text' => '', 'menun' => array(0,0))
);

$error_page = array ('file' => '404', 'text' => 'Page not found!');
?>
