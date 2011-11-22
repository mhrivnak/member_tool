<?php

# request.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# Licensed under The MIT License
# http://www.opensource.org/licenses/mit-license.php

require_once 'debug.php';
require_once 'database_accessor.php';

class Request extends DatabaseAccessor {

  protected static $table = 'requests';
  protected static $primary_key = 'request_id';
  protected static $unique_keys = array( 'request_id', 'email' );
  protected static $save_cols = array( 'name', 'email', 'occupation', 'employer', 'birth_year', 'address', 'city', 'country', 'state', 'zip', 'phone', 'user', 'user_alt', 'status' );

  public $name;
  public $email;
  public $occupation;
  public $employer;
  public $birth_year;
  public $address;
  public $city;
  public $country;
  public $state;
  public $zip;
  public $phone;
  public $user;
  public $user_alt;
  public $status;

  public function check() {
  }

}

?>
