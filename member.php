<?php

# member.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# License: GNU GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)

require_once 'debug.php';
require_once 'database_accessor.php';

class Member extends DatabaseAccessor {

  protected static $table = 'members';
  protected static $primary_key = 'member_id';
  protected static $unique_keys = array( 'member_id', 'email' );
  protected static $save_cols = array( 'name', 'join_date', 'email', 'type', 'occupation','employer', 'birth_year', 'address', 'city', 'country', 'state', 'zip', 'phone', 'approver' ); 

  public $name;
  public $join_date;
  public $email;
  public $type;
  public $occupation;
  public $employer;
  public $birth_year;
  public $address;
  public $city;
  public $country;
  public $state;
  public $zip;
  public $phone;
  public $approver;
  public $updated;

}

?>
