<?php

class Hash {

	public static function encode_sha256($string) {
		return hash('sha256', $string );
	}
	public static function md5($string) {
		return hash('sha256', $string );
	}

}
// echo hash('sha256', '1' ) . "<br>";					user name: 1_benutzerName
// echo hash('sha256', '2_kontoPasswort' ) . "<br>";	user name: 2_benutzerName
// echo hash('sha256', '3_kontoPasswort' ) . "<br>";
// echo hash('sha256', '4_kontoPasswort' ) . "<br>";
// echo hash('sha256', '5_kontoPasswort' ) . "<br>";


?>