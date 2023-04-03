<?php

class Redirect
{
	public static function goTo($url = null, $time = 0)
	{
		if ($time != 0) {
			header("Refresh:$time;url=$url");	// Belirtilen zaman bekledikten sonra, verilen adrese yonlendirir
		} else {
			header("Location:$url");			// verilen adrese hemen yonlendirir
		}
	}

	public static function comeBack($time = 0)
	{
		$url = $_SERVER["HTTP_REFERER"];		// current page
		if ($time != 0) {
			header("Refresh:$time;url=$url");	// Belirtilen zaman bekledikten sonra, verilen adrese yonlendirir
		} else {
			header("Location:$url");		// verilen adrese hemen yonlendirir
		}
	}
}
