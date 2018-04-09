<?php

require_once (MODEL_DIR . DIRECTORY_SEPARATOR . 'FileMaster.class.php');

/**
* Класс для работы с изображениями. Проверяет, является ли файл изображением, проверяет его тип.
* Может создать миниатюру заданного размера из изображения.
* С помощью функций родительского класса сохранить, переместить и т.п., изображение, как люой файл.
*/
class PhotoMaster extends FileMaster
{
	public $image_type;
	public $image_info;
	protected $resource;
	protected $new_resource;
	protected $image_type_checked = false; //проверен ли тип изображения
	public $square_thumbnail_size = 300;
	public $thumbnails_prefix = 't-';
	public $thumbnails_dir;
	protected $supported_mime_types = array('image/jpeg', 'image/png', 'image/gif'); //можно добавлять новые типы потом, если будет желание
	protected $supported_image_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);

	public function check_image_type ()
	{
		$mime = mime_content_type($this->current_file_name);
		//$supported_mime_types = array('image/jpeg', 'image/png', 'image/gif'); //можно добавлять новые типы потом, если будет желание

		if ( in_array($mime, $this->supported_mime_types, true)) { //последний true означает строгое сравнение
			$this->image_info = getimagesize($this->current_file_name);

			if (in_array($this->image_info[2], $this->supported_image_types, true)) {
				$this->image_type = $this->image_info[2];
				$this->new_file_extension = $this->action_by_image_type('get_extension', $this->image_type);
				$this->image_type_checked = true;
				$this->last_operation_success = true;
				//return true;
			} else {
				$this->error = 'Файл не является поддерживаемым файлом изображения. Тип файла: ' . $this->image_info[2];
				$this->last_operation_success = false;
				return false;
			}

		} else {
			$this->error = 'Файл не является поддерживаемым файлом изображения. Тип файла: ' . $mime;
			$this->image_type = $mime;
			$this->last_operation_success = false;
			return false;
		}

		if ($this->image_info[0] === 0 || $this->image_info[1] === 0) {
			$this->error = 'Изображение имеет нулевой размер';
			$this->last_operation_success = false;
			return false;
		}
	}

	/*Будем создавать миниатюрку
		Планирую сделать два режима - автоматический, или ручной
		При автоматическом - 'auto_from_center' - создаем миниатюру в виде квадратика с заданным размером, из центра оригинального изображения
		$params = array(
		mode => auto_from_center/manual/fit_in_rectangle
	 - при автоматическом - из центра, с авторасчетом, при ручном должны задать все параметры.  Еще потом сделаю вариант "поместиться в прямоугольник" - т.е. миниатюра - это вся картинка, но уменьшенная до размеров, не более заданных, например должна поместиться в прямоугольник 100*150
	 	thumbnails_dir => куда сохранять миниатюры
	 	thumbnails_prefix => пришлось ещедобавить и такую фигню, когда я обнаружил, что предыдущие миниатюры были сохранены с префиксом.
	 		(потом убрал префикс, перенес в свойства объекта, так удобнее оказалось, можно еще в другом месте применить)
		src_x => откуда начинать обрезку горизонталь (Подсчет координат идет с левого верхнего угла)
		src_y => откуда начинать обрезку вертикаль
		src_width => ширина вырезаемого прямоугольника
		src_height => высота вырезаемого прямоугольника
		thumbnail_width => ширина конечной картинки
		thumbnail_height => высота конечной картинки
		*/
	/*То есть если мы хотим вырезать кусок 100*100 из верхнего угла, нам нужно такой массив $params = ['mode' => 'manual', 'src_x' =>0,'src_y' =>0, 'src_width' => 100, 'src_height' => 100, 'thumbnail_width' => 100, 'thumbnail_height' => 100]*/

	public function create_thumbnail($params)
	{
		$create_resource_func = $this->action_by_image_type('create_resource_func_name', $this->image_type);
		$this->resource = $create_resource_func($this->current_file_name);

		switch ($params['mode']) {
			case 'auto_from_center':
				$thumbnail_width = $this->square_thumbnail_size;
				$thumbnail_height = $this->square_thumbnail_size;
				$params_calculated = $this->calculate_coordinates_for_сutting();
				$src_x = $params_calculated['src_x'];
				$src_y = $params_calculated['src_y'];
				$src_width = $params_calculated['src_width'];
				$src_height = $params_calculated['src_height'];
				break;
			case 'manual':
				$thumbnail_width = $params['thumbnail_width']; //тут вообще можно было бы распаковать архив циклом, ну это потом как-нибудь. Пока пусть останется как есть, для наглядности
				$thumbnail_height = $params['thumbnail_height'];
				$src_x = $params['src_x'];
				$src_y = $params['src_y'];
				$src_width = $params['src_width'];
				$src_height = $params['src_height'];
				break;
			case 'fit_to_rectangle':
				/*В разработке*/
				return false;
				break;
			default:
				$this->error = 'Низвестный параметр mode при создании миниатюры';
				$this->last_operation_success = false;
				break;
		}

		$thumbnail = imagecreatetruecolor ($thumbnail_width, $thumbnail_height);
		imagecopyresampled($thumbnail, $this->resource, 0, 0, $src_x, $src_y, $thumbnail_width, $thumbnail_height, $src_width, $src_height);
		//$thumbs_dir = $this->thumbnails_dir;//$this->destination_dir . '/thumbs' ; //Папку передаем БЕЗ конечного слеша
		/*Тут была моя ошибка, я в самом классе, который по идее относится к модели, зашил папку, в которой должны храниться миниатюры. И я бы даже не заметил этого косяка, если бы не решил пересадить этот класс в другой проект, где уже загрузка фотографий худо-бедно была организована, но относительное расположение папок было другое. Класс должен работать автономно, и он не знает ничего о расположении всяких там папок.*/
		$function_write_file = $this->action_by_image_type('write_to_file_func_name', $this->image_type);
		$thumbnail_name = $this->thumbnails_prefix . $this->current_file_basename;
		$success = $function_write_file($thumbnail, $this->thumbnails_dir . '/' . $thumbnail_name);
		if ($success) {
			$this->last_operation_success = true;
		} else {
			$this->last_operation_success = false;
			$this->error = 'Создание миниатюры не удалось';//TODO вообще хорошо бы ошибки константами обозначать, и строковое соответствие в отдельном месте хранить
		}
		
	}

	/*Если мы хотим создать миниатюру в автоматическом режиме, то нам нужно рассчитать, откуда начать резать, и какого размера квадрат вырезать
		возвращает массив:
		src_x => откуда начинать обрезку горизонталь (Подсчет координат идет с левого верхнего угла)
		src_y => откуда начинать обрезку вертикаль
		src_width => ширина вырезаемого прямоугольника
		src_height => высота вырезаемого прямоугольника
	*/
	protected function calculate_coordinates_for_сutting() {
		$orig_width = $this->image_info[0];
		$orig_height = $this->image_info[1];
		$params_c = array();
		if ($orig_width >= $orig_height) {
			$params_c['src_width'] = $orig_height;
			$params_c['src_height'] = $orig_height;
			$params_c['src_x'] = (int)round(($orig_width - $orig_height)/2);
			$params_c['src_y'] = 0;
		} else {
			$params_c['src_width'] = $orig_width;
			$params_c['src_height'] = $orig_width;		
			$params_c['src_x'] = 0;
			$params_c['src_y'] = (int)round(($orig_width - $orig_height)/2);
		}
		return $params_c;
	}

	protected function action_by_image_type($action_need, $image_type)
	{
		switch ($action_need) {
			case 'get_extension':
				$extensions = array(
					IMAGETYPE_JPEG => 'jpg', 
					IMAGETYPE_PNG => 'png', 
					IMAGETYPE_GIF => 'gif'
					);
				return $extensions[$image_type];
				break;
			case 'create_resource_func_name':
				$func_names = array(
					IMAGETYPE_JPEG => 'imagecreatefromjpeg', 
					IMAGETYPE_PNG => 'imagecreatefrompng', 
					IMAGETYPE_GIF => 'imagecreatefromgif'
					);
				return $func_names[$image_type];
				break;
			case 'write_to_file_func_name':
				$func_names = array(
					IMAGETYPE_JPEG => 'imagejpeg', 
					IMAGETYPE_PNG => 'imagepng', 
					IMAGETYPE_GIF => 'imagegif'
					);
				return $func_names[$image_type];
				break;		
			default:
				return false;
				break;
		}	
	}

	public function delete_photo_and_thumb ($filename)
	{
		$thumbnails_dir = $this->thumbnails_dir;
		$thumbnails_prefix = $this->thumbnails_prefix;
		$img_dir = $this->destination_dir;//
		@unlink($img_dir . DIRECTORY_SEPARATOR . $filename);
		@unlink($thumbnails_dir . DIRECTORY_SEPARATOR .  $thumbnails_prefix . $filename);
		//Как-то функция не очень красиво получилась
	}

	public function get_from_post_save_and_create_thumbnail ($name_in_FILES, $destination_dir, $thumbnails_dir, $create_thumbnail_params) {
		$get = $this->get_from_post($name_in_FILES);
		if ($get) {
			$this->check_image_type ();
			if ($this->image_type_checked) {
				$this->destination_dir = $destination_dir;
				$this->thumbnails_dir = $thumbnails_dir;
				$new_name = $this->generate_new_file_name($this->new_file_extension);//новое расширение появляется в ходе check_image_type()
				$this->move_uploaded($this->destination_dir, $new_name); //тут появляется новое имя файла
				if ($this->last_operation_success) {
					$this->create_thumbnail($create_thumbnail_params);
				} else {
					return ;//выходим, если не удалось перемещение
				}
			} else {
				return ;//выходим, если не подходящий тип
			}
		} else {
			return ;//выходим, если не получили файл по хттп
		}

	}
}