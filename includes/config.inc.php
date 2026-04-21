<?php
$pagetitle = array(
    'title' => 'Net Pizzeria'
);

$header = array(
    'imagesource' => 'logo.png',
    'imagealt' => 'logo',
    'title' => 'Net Pizzeria',
    'motto' => 'Fast pizza delivery day and night'
);

$footer = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'firm' => 'Net Pizzeria'
);

$pages = array(
    '/' => array('file' => 'home', 'text' => 'Mainpage', 'menun' => array(1,1)),
    'gallery' => array('file' => 'images', 'text' => 'Images', 'menun' => array(1,1)),
    'contact' => array('file' => 'contact', 'text' => 'Contact', 'menun' => array(1,1)),
    'crud' => array('file' => 'crud', 'text' => 'CRUD', 'menun' => array(1,1)),
    'messages' => array('file' => 'messages', 'text' => 'Messages', 'menun' => array(0,1)),
    'login' => array('file' => 'login', 'text' => 'Login', 'menun' => array(1,0)),
    'login2' => array('file' => 'login2', 'text' => '', 'menun' => array(0,0)),
    'logout' => array('file' => 'logout', 'text' => 'Logout', 'menun' => array(0,1)),
    'register' => array('file' => 'register', 'text' => '', 'menun' => array(0,0)),
    'createpizza' => array('file' => 'createpizza', 'text' => '', 'menun' => array(0,0)),
    'editpizza' => array('file' => 'editpizza', 'text' => '', 'menun' => array(0,0)),
    'deletepizza' => array('file' => 'deletepizza', 'text' => '', 'menun' => array(0,0))
);

$error_page = array ('file' => '404', 'text' => 'Page not found!');
?>
