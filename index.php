<?php

require_once __DIR__ . '/UrlManager.php';

$url = $_SERVER['REQUEST_URI'];
$path = explode('?', $url)[0];
// $query = explode('?', $url)[1];
$page = explode('/', $path)[1];

$urlManager = new UrlManager();
$urlManager->load($page);
