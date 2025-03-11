<?php

	namespace Demo;

	use Demo\LocationCalculator as Calc;

	class Locator {

		public static function locate(string $destination, float $radius): string
		{
			$calc = new Calc();
			$locations = $calc->getLocations($destination, $radius);

			return json_encode($locations, JSON_PRETTY_PRINT);
		}
	}
