<?php

require('test.php');
require('member.php');

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
    fail("save didn't return a valid id: $id");
    return false;
  }

  $n = Member::get_by_id($id);

  if( $n->name != $name ) {
    $n->debug();
    fail("saved attribute not retrieved");
    return false;
  }

  return true;

}

test_init();

test_save();
echo "Success!\n";

?>
