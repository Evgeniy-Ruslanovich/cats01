<?php

/**
 * @var $photoArray
 */

foreach  ($photoArray as $value) {
	$href = $value['id'];
		echo
		'<a href="?photo=' . $href .'">
			<div class="photo-div" >
				<img src="img/thumbs/t-' . $value['photo'] . '.jpg">
				<p>' . $value['title'] . '</p>
			</div>
		</a>';
}
echo '<div style="clear: both"></div>';