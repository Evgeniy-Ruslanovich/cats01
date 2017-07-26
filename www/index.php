<?php

/**
 *
 */
error_reporting(E_ALL);
require_once('../config.php');

$route = "list";
if (isset($_GET['photo'])) {
	$route = $_GET['photo'];
	require_once(CONTROLLER_DIR . DIRECTORY_SEPARATOR . 'SinglePhoto.php');
	//echo 'Загружаем фотку: ' . $_GET['photo'];
} else {
	require_once(CONTROLLER_DIR . DIRECTORY_SEPARATOR . 'ListPhoto.php');
}
// еще нужно добавить одну ветку - получить джейсон