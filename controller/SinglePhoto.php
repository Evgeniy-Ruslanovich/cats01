<?php

/**
 * Этот контроллер должен получать одну фотку в большом арзмере, исходя из гет-параметра.
 */

require_once(MODEL_DIR . DIRECTORY_SEPARATOR . 'ListPhoto.class.php');  //Подключаем файл класса модели, нужен чтоб выкачать данные фотки
require_once(TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'Template.class.php'); //подключаем файл класса шаблона, нужен чтобы вызвать отрисовку страницы

$SinglePhoto = new ListPhoto();  //да, звучит коряво, но на жеманности уже времени не было
$photoInfo = $SinglePhoto->getSingle ($route); 


$data = [];  //эта переменная будет передана в render
$data['photoInfo'] = $photoInfo;  //одним из полей массива data будет массив с данными для фотографий. Запихиваем его в data

//Так, теперь нужно отрендерить темплейт

$page = new Template();  //создаем объект страницы
$page->layout = 'layout.php';  //указываем файл лейаута
$page->template = 'singlePhotoTpl.php';  //указываем файл маленького шаблона

$page->render($data); //и - барабанная дробь - рендерим

