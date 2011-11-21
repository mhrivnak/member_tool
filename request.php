<?php

# request.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# Licensed under The MIT License
# http://www.opensource.org/licenses/mit-license.php

require 'debug.php';

class Request {

  public $id;
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

  static $table = 'requests';
  static $primary_key = 'request_id';
  static $unique_keys = array( 'request_id', 'email' );
  static $save_cols = array( 'name', 'email', 'occupation', 'employer', 'birth_year', 'address', 'city', 'country', 'state', 'zip', 'phone' );

  # map an array to a list of values suitable for SQL, with optional quotes
  private function sql_list( $array, $quote = false) {
    # create a function which quotes a string using $quote
    if($quote) {
      $quoter = create_function('$str', 'return "\'$str\'";');
      $array = array_map($quoter, $array);
    }
    return implode(',', $array);
  }

  private function sql_pairs( $array ) {
    $pairs = array();
    foreach( $array as $varname ) {
      array_push( $pairs, "$varname = '" . $this->{$varname} . "'" );
    }
    return implode(',', $pairs);
  }

  private function names_to_vals( $array ) {
    $vals = array();
    foreach( $array as $varname ) {
      array_push( $vals, $this->{$varname} );
    }
    return $vals;
  }

  private function map_result( $result ) {
     $this->id = $result[self::$primary_key];
     foreach( self::$save_cols as $col ) {
       $this->{$col} = $result[$col];
     }
  }

  # TODO: should just inherit all this from a generic class
  #  - all we need to set is valid_keys and table_name
  public function get_by( $key, $val ) {
    if( in_array($key, self::$unique_keys) ) {
      $new = new self;
      $sql = "SELECT * FROM " . self::$table;
      $sql .= " WHERE $key = '" . mysql_real_escape_string($val) . "'";
      debug("SQL: $sql");
      $result = mysql_fetch_assoc(mysql_query($sql));
      $new->map_result( $result );
      return $new;
    } else {
      debug("Bad key: $key");
    }
  }

  public function get_by_id( $id ) {
    return self::get_by( self::$primary_key, $id );
  }

  public function save() {
      if( !$this->id ) {
        $sql = 'INSERT into ' . self::$table;
        $sql .= '(' . $this->sql_list(self::$save_cols) . ")";
        $sql .= " VALUES (" . $this->sql_list($this->names_to_vals(self::$save_cols), true) . ")";
        debug("SQL: $sql");
        $result = mysql_query($sql);
        if(!$result) {
          debug("INSERT failed: " . mysql_error());
        }
      } else {
        $sql = "UPDATE " . self::$table . " SET ";
        $sql .= $this->sql_pairs(self::$save_cols);
        $sql .= " WHERE " . self::$primary_key . " = $this->id";
        debug("SQL: $sql");
        $result = mysql_query($sql);
        if(!$result) {
          debug("UPDATE failed: " . mysql_error());
        }
      }
  }

}

?>
