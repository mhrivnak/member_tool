<?php

set_include_path('..');  
require "config.php";
require "request.php";
require "database.php";

$debug = 0;

function test_save() {
  $r = new Request;

  $name = 'Joe Q. Public';

  $r->name = $name;
  $r->email = 'joe@example.com';
  $r->address = "1234 ABC Street\nApt Pi";
  $r->city = 'Raleigh';
  $r->state = 'NC';
  $r->zip = '27605';
  $r->phone = '919-555-0100';

  $id = $r->save();

  if( !$id ) {
    echo "FAIL: save didn't return a valid id\n";
    return false;
  }

  $s = Request::get_by_id($id);
  if( $s->name != $name ) {
    $s->debug();
    echo "FAIL: saved attribute not retrieved\n";
    return false;
  }

  echo "Success!\n";
  return true;
}

$conf = load_config(dirname(__FILE__).'/../config.yaml', 'test');
$db = db_connect($conf);

test_save();

