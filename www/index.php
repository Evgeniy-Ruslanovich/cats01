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
	}
elseif (isset($_GET['addnew'])){
	require_once(CONTROLLER_DIR . DIRECTORY_SEPARATOR . 'addNew.php');
	}
elseif (isset($_GET['edit'])){
	$route = $_GET['edit'];
	require_once(CONTROLLER_DIR . DIRECTORY_SEPARATOR . 'edit.php');
	}
elseif (isset($_GET['delete'])){
	$route = $_GET['delete'];
	require_once(CONTROLLER_DIR . DIRECTORY_SEPARATOR . 'delete.php');
	}
else{
	require_once(CONTROLLER_DIR . DIRECTORY_SEPARATOR . 'ListPhoto.php');
	}

// еще нужно добавить одну ветку - получить джейсон