<?php

require 'config.php';
require 'request.php';
require 'database.php';

$conf = load_config('config.yaml', 'tower');
 $db = db_connect($conf);
$debug = $conf['debug'];

include 'header.html';

$req = new Request;

$req->from_array($_POST);

if( $req->account == 'yes' ) {
  $req->account = 1;
}
$req->status = 'new';

$req->debug();

$id = $req->save();
debug();
if( $id ) {
  debug("SUCCESS!");
} else {
  debug("FAIL!\n");
}
debug();

$saved = Request::get_by_id($id);
$req->debug();

include 'footer.html';

?>
