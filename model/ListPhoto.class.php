<?php

/**
 * Этот класс отвечает за выгрузку из базы списка всех фотографий
 */
require_once('../config.php');


class ListPhoto {

	protected $link;
	protected $query;
	protected $result; 

	public function getList () {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		$this->query = "SELECT `id`,`title`,`photo` FROM `cats`.`cats_photos`";
		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		//$values_data_array = mysqli_fetch_all($this->result, MYSQLI_ASSOC);  //вытаскиваем все в ассоциативный массив, пригодный для темплейта


	$values_data_array = array();
	while ($row = mysqli_fetch_assoc($this->result)) {
	array_push($values_data_array, $row);
	} 

		return $values_data_array;
	}

	public function getSingle ($photo_id) {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		$this->query = "SELECT * FROM `cats`.`cats_photos` WHERE `id` =" . $photo_id;
		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		//var_dump($this->result);
		$values_data_array = mysqli_fetch_array($this->result, MYSQLI_ASSOC);  //вытаскиваем все в ассоциативный массив, пригодный для темплейта

		return $values_data_array;
	}

}