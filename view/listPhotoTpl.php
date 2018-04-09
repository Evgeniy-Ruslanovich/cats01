<?php

/**
 * @var $photoArray
 */
echo '<p><a href="./?addnew=1">Добавить новую</a></p>';
foreach  ($photoArray as $value) {
	$href = $value['id'];
		echo
		'<a href="?photo=' . $href .'">
			<div class="photo-div" >
				<img style="max-height:300px; max-width:300px;" src="img/thumbs/t-' . $value['photo'] . '">
				<p>' . $value['title'] . '</p>
			</div>
		</a>';
}
echo '<div style="clear: both"></div>';