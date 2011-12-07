<?php

require 'test.php';
require 'request.php';

function test_check() {
  $r = new Request;

  $r->name = 'Bob Smith';
  $r->email = 'bob@example.com';
  if( !$r->check() ) {
    fail("check failed with good data");
  }

  $r->name = '';
  $r->email = 'bob@example.com';
  if( $r->check() ) {
    fail("allowed blank name");
  }

  $r->name = 'Bob Smith';
  $r->email = 'notanemail';
  if( $r->check() ) {
    fail("allowed bad email");
  }

  $r->name = '龙';
  $r->email = 'bob@example.com';
  if( !$r->check() ) {
    fail("unicode name");
  }

  $r->name = "badname ";
  $r->email = 'bob@example.com';
  if( $r->check() ) {
    fail("allowed space at end of name");
  }

  $r->name = " badname";
  if( $r->check() ) {
    fail("allowed space at beginning of name");
  }

  $r->name = "bad  name";
  if( $r->check() ) {
    fail("allowed duplicate whitespace");
  }

  # user names
  
  $r->name = "Bob Smith";
  $r->email = 'bob@example.com';
  $r->account = 1;
  $r->user = '';
  if( $r->check() ) {
    fail("empty username allowed");
  }

  $r->user = 'mr space';
  if( $r->check() ) {
    fail("invalid username allowed");
  }

  $r->user = 'bob';
  $r->user_alt = 'mr space';
  if( $r->check() ) {
    fail("invalid alt username allowed");
  }

  return true;

}

function test_save() {
  $r = new Request;

  $name = 'Joe Q. Public the 3rd';

  $r->name = $name;
  $r->email = 'joe@example.com';
  $r->address = "1234 ABC Street\nApt Pi";
  $r->city = 'Raleigh';
  $r->state = 'NC';
  $r->zip = '27605';
  $r->phone = '919-555-0100';
  $r->account = 1;
  $r->user = 'joe';
  $r->user_alt = 'joe2';

  $id = $r->save();

  if( !$id ) {
    fail("save didn't return a valid id");
  }

  $s = Request::get_by_id($id);
  if( $s->name != $name ) {
    $s->debug();
    fail("saved attribute not retrieved");
  }

  $t = new request;
  $t->name = 'Bob Smith';
  $t->email = $r->email;  # duplicate
  if( $t->save() ) {
    fail("saved duplicate email");
  }

  return true;
}

test_init();

test_check();
test_save();

echo "Success!\n";

