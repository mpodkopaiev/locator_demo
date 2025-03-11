<?php

	namespace Demo;

	use Demo\DB as DB;
	use PDO;

	class Repository
	{
		private DB $db;
		public function __construct()
		{
			$this->db = new DB();
		}

		public function getLocations(): array
		{
			$locationsQuery = $this->db->getConnection()->query('SELECT name, lat, lon FROM destinations '.
				'where lat IS NOT NULL and lon IS NOT NULL and lat > 0 and lon > 0');

			$locations = [];
			while ($row = $locationsQuery->fetch(PDO::FETCH_ASSOC)) {
				$locations[$row['name']] = [$row['lat'], $row['lon']];
			}

			return $locations;
		}
	}
