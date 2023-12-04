<?php

class Redirect
{
	public static function goTo($url = null, $time = 0)
	{
		if ($time != 0) {
			header("Refresh:$time;url=$url");	// Leitet nach der angegebenen Wartezeit an die angegebene Adresse weiter
		} else {
			header("Location:$url");			// leitet sofort an die angegebene Adresse weiter
		}
	}

	public static function comeBack($time = 0)
	{
		$url = $_SERVER["HTTP_REFERER"];		// current page
		if ($time != 0) {
			header("Refresh:$time;url=$url");	// Wartet die angegebene Zeit ab und leitet an die angegebene Adresse weiter
		} else {
			header("Location:$url");		// leitet sofort an die angegebene Adresse weiter
		}
	}
}
