<?php

set_include_path('..');  
require "config.php";
require "database.php";

function fail($msg = "") {
  echo "*** FAIL: $msg\n";
  exit();
}

function test_init() {

  $conf = load_config(dirname(__FILE__).'/../config.yaml', 'test');
  global $debug;
  $debug = $conf['debug'];
  $db = db_connect($conf);

}
