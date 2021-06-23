require "db.php";

/**
 * confのなかのtable名を返す
 */
function getTableName(){
	$db_ini = parse_ini_file("sample.ini");
	$db_table = $db_ini['table'];

	return db_table;
}
