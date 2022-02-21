<?php
if ( ! empty( $instance['text'] ) ) {
	if ( ! empty( $instance['link'] ) ) {
		echo '<h4 class="title"><a href="' . $instance['link'] . '">' . $instance['text'] . '</a></h4>';
	} else {
		echo '<h4 class="title">' . $instance['text'] . '</h4>';
	}
}
if ( ! empty( $instance['content'] ) ) {
	echo '<div class="desc">' . $instance['content'] . '</div>';
}