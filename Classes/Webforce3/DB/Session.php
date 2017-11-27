<?php

namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;

class Session extends DbObject {

	protected $startDate;
	protected $endDate;
	protected $sesNB;

	public function __construct($id=0, $startDate='', $endDate='', $sesNB='') {

		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->sesNB = $sesNB;


		parent::__construct($id, $inserted);
	}

	/**
	 * @param int $id
	 * @return DbObject
	 */
	public static function get($id) {
		// TODO: Implement get() method.
		$sql = '
			SELECT ses_id, ses_start_date, ses_end_date, ses_number
			FROM session
			WHERE ses_id = :id
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		$stmt->bindValue(':id', $id, \PDO::PARAM_INT);

		if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}
		else {
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
			if (!empty($row)) {
				$currentObject = new Student(
					$row['ses_id'],
					new Session($row['session_ses_id']),
					$row['ses_start_date'],
					$row['ses_number']

				);
				return $currentObject;
			}
		}

		return false;
	}

	/**
	 * @return DbObject[]
	 */
	public static function getAll() {
		// TODO: Implement getAll() method.
		$returnList = array();

		$sql = '
		SELECT ses_id, ses_start_date, ses_end_date, ses_number
		FROM session
		WHERE ses_id = :id
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}
		else {
			$allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			foreach ($allDatas as $row) {
				$currentObject = new Student(
					$row = $stmt->fetch(\PDO::FETCH_ASSOC);
					if (!empty($row)) {
						$currentObject = new Student(
							$row['ses_id'],
							new Session($row['session_ses_id']),
							$row['ses_start_date'],
							$row['ses_number']
				);
				$returnList[] = $currentObject;
			}
		}

		return $returnList;
	}
	}
