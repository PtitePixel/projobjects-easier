<?php
namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;

class Country extends DbObject {
  /**
   * @param int $id
   * @return DbObject
   */
  public static function get($id) {
    // TODO: Implement get() method.
  }

  /**
   * @return DbObject[]
   */
  public static function getAll() {
    // TODO: Implement getAll() method.
  }

  /**
   * @return array
   */
  public static function getAllForSelect() {
    $returnList = array();

    $sql = '
      SELECT cou_id, cou_name
      FROM country
      WHERE cou_id > 0
      ORDER BY cou_name ASC
    ';
    $stmt = Config::getInstance()->getPDO()->prepare($sql);
    if ($stmt->execute() === false) {
      print_r($stmt->errorInfo());
    }
    else {
      $allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      foreach ($allDatas as $row) {
        $returnList[$row['cou_id']] = $row['cou_name'];
      }
    }

    return $returnList;
  }

  /**
   * @return bool
   */
  public function saveDB() {
    //if ($this->id > 0) {
			$sql = '
				UPDATE country
				SET cou_id = :id,
				cou_name = :couname
				WHERE cou_id = :id
			';
			$stmt = Config::getInstance()->getPDO()->prepare($sql);
			$stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
		  $stmt->bindValue(':couname', $this->couname, \PDO::PARAM_INT);

			if ($stmt->execute() === false) {
				throw new InvalidSqlQueryException($sql, $stmt);
			}


		  else {
			$sql = '
				INSERT INTO country (cou_id, cou_name)
				VALUES (:id, :couname)
			';
			$stmt = Config::getInstance()->getPDO()->prepare($sql);
			$stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
			$stmt->bindValue(':couname', $this->couname);

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
			DELETE FROM country WHERE cou_id = :id
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
  }



 ?>
