<?php

# member.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# Licensed under The MIT License
# http://www.opensource.org/licenses/mit-license.php

require 'debug.php';

class Member {

  public $id;
  public $firstName;
  public $lastName;
  public $email;

  function _map_result( $result ) {
     $this->id = $result['member_id'];
     $this->firstName = $result['first_name'];
     $this->lastName = $result['last_name'];
     $this->email = $result['email'];
  }

  public function get_by( $key, $val ) {
    $valid_keys = array( 'member_id', 'email' );
    if( in_array($key, $valid_keys) ) {
      $new = new Member;
      $sql = "SELECT * FROM member_list WHERE $key = '" . mysql_real_escape_string($val) . "'";
      debug("SQL: $sql");
      $result = mysql_fetch_assoc(mysql_query($sql));
      $new->_map_result( $result );
      return $new;
    } else {
      debug("Bad key: $key");
    }
  }

  public function get_by_id( $id ) {
    return self::get_by( 'member_id', $id );
  }

}

?>
