<?php

set_include_path('..');
require "config.php";
require "member.php";
require "database.php";

$debug = 0;

function test_save() {

  $m = new Member;
 
  $name = 'Joe Q. Public';

  $m->name = $name;
  $m->email = 'joe@example.com';
  $m->address = "1234 ABC Street\nApt Pi";
  $m->city = 'Raleigh';
  $m->state = 'NC';
  $m->zip = '27605';
  $m->phone = '919-555-0100';

  $id = $m->save();

  if( !$id ) {
    $m->debug();
    echo "FAIL: save didn't return a valid id\n";
    return false;
  }

  $n = Member::get_by_id($id);

  if( $n->name != $name ) {
    $n->debug();
    echo "FAIL: saved attribute not retrieved\n";
    return false;
  }

  echo "Success!\n";
  return true;

}

$conf = load_config(dirname(__FILE__).'/../config.yaml', 'test');
$db = db_connect($conf);

test_save();

?>
