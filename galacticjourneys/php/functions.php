<?php

function test_input($con, $data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($con, $data);
	return $data;
}
function crypt_password($data) {
	$data = trim($data);
	$data = crypt($data, '$1$rasmusle$');
	return $data;
}

?>