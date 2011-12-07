<?php

# request.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# License: GNU GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)

require_once 'debug.php';
require_once 'database_accessor.php';
require_once 'lib/rfc822.php';

class Request extends DatabaseAccessor {

  protected static $table = 'requests';
  protected static $primary_key = 'request_id';
  protected static $unique_keys = array( 'request_id', 'email' );
  protected static $save_cols = array( 'name', 'email', 'occupation', 'employer', 'birth_year', 'address', 'city', 'country', 'state', 'zip', 'phone', 'account', 'user', 'user_alt', 'status' );

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
  public $account;
  public $user;
  public $user_alt;
  public $status;

  public function check() {

    # any unicode letter followed by any unicode marks, numbers, or
    # punctuation, single spaces separators
    $name_regex = '/\A\p{L}+[\p{L}\p{M}\p{N}\p{P}]*( [\p{L}\p{M}\p{N}\p{P}]+)*\z/u';
    if( !preg_match($name_regex, $this->name) ) {
      debug("Check: name invalid: '$this->name'");
      return false;
    }

    if( !is_valid_email_address($this->email) ) {
      debug('Check: email invalid');
      return false;
    }

    if( $this->account == 1 ) {
      if( !preg_match('/\A[a-z0-9]{3,16}\z/', $this->user) ) {
        debug("Check: invalid username: '$this->user'");
        return false;
      }
      if( !preg_match('/\A([a-z0-9]{3,16}|)\z/', $this->user_alt) ) {
        debug("Check: invalid alt username: '$this->user_alt'");
        return false;
      }
    }

    return true;

  }

}

?>
