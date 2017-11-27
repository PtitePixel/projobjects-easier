<?php

namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;

class City extends DbObject {
	private $name;
	private $country;

	public function __construct($id=0,$name='', $country='', $inserted='') {

		$this->name = $name;


		if (empty($country)) {
			$this->country = new Country();
		}
		else {
			$this->country = $country;
		}


		parent::__construct($id, $inserted);
	}


		/**
	 * @param int $id
	 * @return DbObject
	 */
	public static function get($id) {
		// TODO: Implement get() method.
		$sql = '
			SELECT cit_id, cit_name, country_cou_id
			FROM city
			WHERE cit_id = :id
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		$stmt->bindValue(':id', $id, \PDO::PARAM_INT);

		if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}
		else {
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
			print_r($row);
			if (!empty($row)) {
				$currentObject = new City(
					$row['cit_id'],
					$row['cit_name'],
					new Country($row['country_cou_id'])
				);

				return $currentObject;
			}
		}
	}

	/**
	 * @return DbObject[]
	 */
	public static function getAll() {
		// TODO: Implement getAll() method.
		$returnList = array();

		$sql = '
			SELECT cit_name, country_cou_id
			FROM city
			WHERE cit_id = :id
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}
		else {
			$allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			foreach ($allDatas as $row) {
				$currentObject = new City(
					$row['cit_id'],
					new City($row['city_cit_id']),
					$row['cit_name']
				);
				$returnList[] = $currentObject;
			}
		}

		return $returnList;
	}

	/**
	 * @return array
	 */
	public static function getAllForSelect() {
		$returnList = array();

		$sql = '
			SELECT cit_id, cit_name
			FROM city
			WHERE cit_id > 0
			ORDER BY cit_name ASC
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		if ($stmt->execute() === false) {
			print_r($stmt->errorInfo());
		}
		else {
			$allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			foreach ($allDatas as $row) {
				$returnList[$row['cit_id']] = $row['cit_name'];
			}
		}

		return $returnList;
	}

	/**
	 * @return bool
	 */
	public function saveDB() {
		// TODO: Implement saveDB() method.
		$sql = '
			UPDATE city
			SET cit_id = :id,
			cit_name = :citname
			WHERE cit_id = :id
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		$stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
		$stmt->bindValue(':citname', $this->couname, \PDO::PARAM_INT);

		if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}

		else {
		$sql = '
			INSERT INTO city (cit_id, cit_name)
			VALUES (:id, :citname)
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		$stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
		$stmt->bindValue(':citname', $this->couname);

		if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}
		else {
			$this->id = Config::getInstance()->getPDO()->lastInsertId();
			return true;
		}
	}

	return false;
}


/**
* @param int $id
* @return bool
*/
public static function deleteById($id) {
	// TODO: Implement deleteById() method.
	$sql = '
	DELETE FROM city WHERE cit_id = :id
	';
	$stmt = Config::getInstance()->getPDO()->prepare($sql);
	$stmt->bindValue(':id', $id, \PDO::PARAM_INT);

	if ($stmt->execute() === false) {
		print_r($stmt->errorInfo());
	}
	else {
		return true;
	}
	return false;
}

    //Getter
    public function getCountry() {
        return $this->country;
    }

    // Setter
    public function setCountry($country) {
        // J'en profite pour vérifier le type/format
        if (is_string($country)) {
            $this->country = $country;
        }
    }
		//Getter
		public function getName() {
				return $this->name;
		}

		// Setter
		public function setName($name) {
				// J'en profite pour vérifier le type/format
				if (is_string($name)) {
						$this->name = $name;
				}
		}


}
