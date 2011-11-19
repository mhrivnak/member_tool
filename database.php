<?php

# database.php

function db_connect( $conf ) {

  $conn = mysql_connect($conf['db_host'],$conf['db_user'],$conf['db_pass']);
  if(!$conn) {
    debug("Failed to open database: " . mysql_error());
    exit(1);
  }

  $db = mysql_select_db($conf['db_name'], $conn);
  if(!$db) {
    debug("MySQL error: " . mysql_error());
    exit(1);
  }

  return $db;

}

?>
