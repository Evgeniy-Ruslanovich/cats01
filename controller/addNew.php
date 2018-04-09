<?php

/*
*Добавление новой фотографии с названием и описанием
*/
error_reporting(E_ALL);
$haveNewPhoto = false;
$haveNewPhotoTitle = false;
$haveNewPhotoFile = false;
$debug_mode = true;
$debug_info = '';
$success = 'пока ничего не загружено';

require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'PhotoMaster.class.php');

if(isset($_POST['title'])){
	$title = $_POST['title'];
	$description = $_POST['description'];
	$haveNewPhotoTitle = true;
}

if (isset($_FILES['picture'])  ) {

	$picture = new PhotoMaster();
	$create_thumbnail_params = array('mode' => 'auto_from_center'); 
	$picture->get_from_post_save_and_create_thumbnail('picture', IMAGE_DIR, THUMBS_DIR, $create_thumbnail_params);
	$haveNewPhotoFile = $picture->last_operation_success; //тру или не тру? получилось ли у нас загрузить фотку?
	if ($haveNewPhotoFile) {
		$new_file_name = $picture->current_file_basename;
	}
} 

require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'ListPhoto.class.php');  //Подключаем файл класса модели, нужен чтоб выкачать список фоток и их данные
require_once(TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'Template.class.php'); //подключаем файл класса шаблона, нужен чтобы вызвать отрисовку страницы

if($haveNewPhotoTitle && $haveNewPhotoFile){
	$newPhoto = new ListPhoto();  
	$database_upload_success = $newPhoto->addNew($title, $description, $new_file_name);
} else {
	$success = false;
}

$data = [];  //эта переменная будет передана в render
$data['debug_mode'] = false;
$data['database_upload_success'] = $database_upload_success;
$data['debug_info'] = $debug_info;

$page = new Template();  //создаем объект страницы
$page->layout = 'layout.php';  //указываем файл лейаута
$page->template = 'formNewPhotoTpl.php';  //указываем файл маленького шаблона

$page->render($data);

