<?php

/**
 * Этот контроллер должен редактировать фотку
 */

$haveNewPhotoFile = false;
$update_success = false;
$update_try = false;
$debug_info = '';
require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'ListPhoto.class.php');  //Подключаем файл класса модели, нужен чтоб выкачать список фоток и их данные
require_once(TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'Template.class.php'); //подключаем файл класса шаблона, нужен чтобы вызвать отрисовку страницы

if(count($_POST) > 0){
	$id = $_GET['edit'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$new_file_name = false; //Если нам не дали новую фотку, то функция обновления записи в БД будет вести себя по другому

	if(isset($_FILES['picture'])){

		require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'PhotoMaster.class.php');
		$picture = new PhotoMaster();
		$create_thumbnail_params = array('mode' => 'auto_from_center'); 
		$picture->get_from_post_save_and_create_thumbnail('picture', IMAGE_DIR, THUMBS_DIR, $create_thumbnail_params);
		$haveNewPhotoFile = $picture->last_operation_success; //тру или не тру? получилось ли у нас загрузить фотку?
		//$new_file_name = $picture->current_file_basename;
		if ($haveNewPhotoFile) {
			$new_file_name = $picture->current_file_basename;
		}

	}

	$update_try = true;
	$updatePhoto = new ListPhoto();
	$photoInfo = $updatePhoto->getSingle ($route); //надо получить теперь инфу старой форки, чтоб удалить старую, ведь у нас есть новая
	$update_success = $updatePhoto->update ($id, $title, $description, $new_file_name);
	if($haveNewPhotoFile && $update_success) {
	$picture->delete_photo_and_thumb($photoInfo['photo']);//удаляем старые фотки
	}
	unset($updatePhoto);
	unset($picture);
}

$SinglePhoto = new ListPhoto();
$photoInfo = $SinglePhoto->getSingle ($route); 

$data = [];  //эта переменная будет передана в render
$data['update_try'] = $update_try;
$data['update_success'] = $update_success;
$data['photoInfo'] = $photoInfo;
$data['debug_mode'] = true;
$data['debug_info'] = $debug_info;

$page = new Template();
$page->layout = 'layout.php';
$page->template = 'editPhotoTpl.php';

$page->render($data);

