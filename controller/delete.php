<?php

/**
 * Этот контроллер должен удалять фотку
 */

$delete_success = false;
$delete_try = true;
require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'ListPhoto.class.php');  //Подключаем файл класса модели, нужен чтоб выкачать список фоток и их данные
require_once(TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'Template.class.php'); //подключаем файл класса шаблона, нужен чтобы вызвать отрисовку страницы
require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'PhotoMaster.class.php');
$id = $_GET['delete'];

$deletePhotoData = new ListPhoto();
$photoInfo = $deletePhotoData->getSingle($id);//Получаем информацию о текущей фотографии, в т.ч. имя текущего файла, которое нужно для его удаления
$delete_success = $deletePhotoData->delete($id);
if ($delete_success) {
	$deletePhotoFile = new PhotoMaster();
	$deletePhotoFile->delete_photo_and_thumb($photoInfo['photo']);//удаляем фото
}
unset($deletePhotoData);
unset($deletePhotoFile);

$data = [];  //эта переменная будет передана в render
$data['delete_success'] = $delete_success;

$page = new Template();  //создаем объект страницы
$page->layout = 'layout.php';  //указываем файл лейаута
$page->template = 'deletePhotoTpl.php';  //указываем файл маленького шаблона

$page->render($data);

