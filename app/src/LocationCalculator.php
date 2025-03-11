<?php

	namespace Demo;

	use Demo\Repository as Repository;

	class LocationCalculator {
		private const EARTH_RADIUS = 6371;
		private Repository $repository;
		private array $locations;

		public function __construct()
		{
			$this->repository = new Repository();
			$this->locations = $this->repository->getLocations();
		}

		public function getLocations(string $destination, float $radius): array
		{
			if (!array_key_exists($destination, $this->locations)) {
				throw Exception('The specific destination does not exist');
			}

			[$destinationLat, $destinationLon] = $this->locations[$destination];
			$result = [];
			foreach ($this->locations as $name => [$locationLat, $locationLon]) {
				if ($name === $destination) {
					continue;
				}

				$distance = $this->haversineMethod($destinationLat, $destinationLon, $locationLat, $locationLon);
				if ($distance > $radius) {
					continue;
				}

				$result[(string) $distance] = [
					'destination' => $name,
					'distance' => round($distance, 2) . ' km',
				];
			}

			ksort($result);

			return $result;
		}

		private function haversineMethod(float $destinationLat, float $destinationLon, float $locationLat, float $locationLon): float
		{
			$dLat = deg2rad($locationLat - $destinationLat);
			$dLon = deg2rad($locationLon - $destinationLon);
			$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($destinationLat)) * cos(deg2rad($locationLat)) * sin($dLon/2) * sin($dLon/2);

			return self::EARTH_RADIUS * 2 * atan2(sqrt($a), sqrt(1-$a));
		}
	}
