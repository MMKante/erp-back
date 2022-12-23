<?php
	namespace Library;

	class DBFactory {
		public static function MySQLPDO() : \PDO {
			$db = new \PDO('mysql:host=localhost;dbname=MYSQL_DATABASE;charset=utf8','MYSQL_USER','MYSQL_ROOT_PASSWORD');
			$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

			return $db;
		}
		public static function MySQLMySQLi() {
			return new \MySQLi('localhost','root','','erp');
		}
	}