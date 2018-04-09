<?php

/**
 * Этот класс отвечает за выгрузку из базы списка всех фотографий, или одной фотографии, а также редактирует и удаляет информацию из базы
 */
require_once('../config.php');


class ListPhoto {

	protected $link;
	protected $query;
	protected $result; 

	public function getList () {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		$this->query = "SELECT `id`,`title`,`photo` FROM " . DB_NAME . ".`cats_photos`";
		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		//$values_data_array = mysqli_fetch_all($this->result, MYSQLI_ASSOC);  //вытаскиваем все в ассоциативный массив, пригодный для темплейта
		//echo $this->query . '<br>'; echo DB_NAME;

		$values_data_array = array();
		while ($row = mysqli_fetch_assoc($this->result)) {
		array_push($values_data_array, $row);
		} 
		return $values_data_array;
	}

	public function getSingle ($photo_id) {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		$this->query = "SELECT * FROM " . DB_NAME . ".`cats_photos` WHERE `id` =" . $photo_id;
		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		$values_data_array = mysqli_fetch_array($this->result, MYSQLI_ASSOC);  //вытаскиваем все в ассоциативный массив, пригодный для темплейта

		return $values_data_array;
	}

	public function addNew ($title, $description, $photo) {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		$this->query = "INSERT INTO " . DB_NAME . ".`cats_photos` (`title`,`description`,`photo`)
						VALUES ('" . $title . "' , '" . $description . "' , '" . $photo . "')";
		
		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		if($this->result) {
			return true;
		} else {
			return false;
		}
		
	}

	public function update ($id, $title, $description, $photo) {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		if($photo){
			$this->query = "UPDATE " . DB_NAME . ".`cats_photos` SET
						`title` = '" . $title . "' ,
						`description` = '" . $description . "' ,
						`photo` = '" . $photo . "'
						WHERE `cats_photos`.`id` = '" . $id . "'";
		} else {//если нет фотки, то обновляем только название и описание
			$this->query = "UPDATE " . DB_NAME . ".`cats_photos` SET
						`title` = '" . $title . "' ,
						`description` = '" . $description . "' 
						WHERE `cats_photos`.`id` = '" . $id . "'";
		}
		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		if($this->result) {
			return true;
		} else {
			return false;
		}		
	}

	public function delete ($id) {
		$this->link = mysqli_connect(SQL_HOST, DB_USER, DB_PASSW);
		
		$this->query = "DELETE FROM " . DB_NAME . ".`cats_photos` 
						WHERE `cats_photos`.`id` = '" . $id . "'";

		$this->result = mysqli_query($this->link, $this->query);  //делаем запрос к базе
		if($this->result) {
			return true;
		} else {
			return false;
		}		
	}	

}