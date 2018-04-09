<?php

/**
* От этого класса мне нужны базовые операции с файлами
-получить из ПОСТ
-переместить
-удалить
переименовать(что равносильно перемещению, кстати)
*/
class FileMaster
{
	public $current_file_name; //текущее имя файла, полное, вместе с полным путем
	public $current_file_basename;

	public $post_file_info; //если получаем заруженный по http файл, то помещаем сюда исходные данные.

	public $destination_dir; //папка, в которую нужно переместить файл
	public $new_file_name; //можно записать сюда новое имя файла, полное, с путем
	public $new_file_extension; // если мы хотим поменять расширение по ходу дела, то записываем его сюда

	public $error = ''; //сюда записываем ошибку, если таковая случится
	
	public $last_operation_success = false;

	/*Эта функция просто получает данные из массива, чтобы с ними в дальнейшем можно было что-то делать*/
	function get_from_post($name_in_FILES)
	{
		if (isset($_FILES[$name_in_FILES])) {
			$this->current_file_name = $_FILES[$name_in_FILES]['tmp_name'];
			$this->post_file_info = $_FILES[$name_in_FILES];
			if ($this->post_file_info['error'] === UPLOAD_ERR_OK) { //если нормально загрузилось, то все гуд
				$this->last_operation_success = true;
				return true;
			} else { //если не загрузилось, то сохраняем сообщение об ошибке, возвращаем фолс
				$this->error = "Ошибка загрузки файла: " . $this->post_file_info['error'];
				$this->last_operation_success = false;
				return false;
			} 
		} else {
			$this->error = "Не поступало такого файла через http";
			$this->last_operation_success = false;
			return false;
		}
	}

	/*Поскольку с кириллицей веб-сервер не очень дружит,нам нужно придумать новое имя. Это функцию можно запускать после get_from_post*/
	public function generate_new_file_name ($extension = false, $destination_dir = false)
	{
		$orig_name = $this->post_file_info['name']; //берем оригинальное имя из пост
		if (!$extension) { //если в качестве аргумента не переданы расширение и папка назначения, то берем из свойств объекта
			$extension = pathinfo($orig_name, PATHINFO_EXTENSION);
		}
		if (!$destination_dir) {
			$destination_dir = $this->destination_dir;
		}

		$i = 0;
		do { //Пытаемся сгенерировать случайное имя файла
			$new_name = md5($orig_name . time()) . rand(0,100);
			$new_full_name = $destination_dir . '/' . $new_name . '.' . $extension;
			if(!file_exists($new_full_name)) {
				$new_base_name = $new_name . '.' . $extension;
				return $new_base_name;
			} else {
				$i++;
				if ($i > 19) {
					$this->error = "Не получается подобрать новое имя файла после 20 попыток";
					return null;
				}
			}
		} while (true);
	}

	public function move_uploaded ($destination_dir, $new_name)
	{
		$old_path = $this->current_file_name;
		$new_path = $this->destination_dir . '/' . $new_name;
		$success = move_uploaded_file($old_path, $new_path);
		if ($success) {
			$this->last_operation_success = true;
			$this->current_file_name = $new_path;
			$this->current_file_basename = $new_name;
			return true;
		} else {
			$this->error = "Ошибка в перемещении загруженного файла, либо файл не является загруженным";
			$this->last_operation_success = false;
			return false;
		}
	}

	public function delete_file ()
	{
		@unlink($this->current_file_name);
	}

	/*
	TODO: file_delete ();
	TODO: file_copy ();
	TODO: file_move ();
	*/
}
