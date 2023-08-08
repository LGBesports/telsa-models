<?php
if($exception->statusCode == '404') {
	echo $this->render('404.html');
} else {
	echo 'Ooops, something went wrong';
}

