<?php

/**
 * @var $title
 * @var $styles
 * @var $content
 * Для отрисовки страницы нужны эти переменные
 */

$this->title = 'Список фото котов';
$this->styles = ['style1', 'style2'];

?>
<!doctype html>
<html>
	<head>
		<title><?= $this->title ?></title>
		<meta charset="UTF8">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
		<?php
		$this->styles;
		foreach ($this->styles as $style) { //циклом добавляем все стили 
		 ?>
			<link rel="stylesheet" type="text/css" href="css/<?= $style ?>.css">
		<?php } ?>
		
		
	</head>
	<body>
	<div class="main">
		<div class="header">
			<div class="header-center">
				<h1>Лучшие коты</h1>
			</div>
		</div>
		<div class="content">
			<?= $content ?>
		</div>

	</div>
	<div class="prefooter">
	</div>
	<div class="footer">
			<div class="footer-center">
				Это футер
			</div>
	</div>
	</body>
</html>
