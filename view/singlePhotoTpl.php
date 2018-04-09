<?php

/**
 * 
 */
?>
<a href="./">на главную страницу</a>
<div class=big-photo>
	<a href="img/<?= $photoInfo['photo'] ?>" target="_blank">
		<img src="img/<?= $photoInfo['photo'] ?>" style="max-height: 600px; max-width: 100%">
	</a>
</div>
<h1><?= $photoInfo['title'] ?></h1>
<p><?= $photoInfo['description'] ?> </p>
<!-- <p>ID: <?= $photoInfo['id'] ?> </p> -->
<p><a href="./?edit=<?= $photoInfo['id'] ?>">Редактировать</a></p>
<p><a href="./?delete=<?= $photoInfo['id'] ?>">Удалить</a></p>
<?php
