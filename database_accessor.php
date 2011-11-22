<?php

# database_accessor.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# Licensed under The MIT License
# http://www.opensource.org/licenses/mit-license.php

require_once 'debug.php';

class DatabaseAccessor {

  public $id;

  protected static $table = '';
  protected static $primary_key = 'id';
  protected static $unique_keys = array( 'id' );
  protected static $save_cols = array();

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

  public function from_array( $array ) {
    foreach( static::$save_cols as $col ) {
      $this->{$col} = $array[$col];
    }
  }

  public function debug() {
    debug( "Id: $this->id" );
    foreach( static::$save_cols as $col ) {
      debug( $col . ': ' . $this->{$col} );
    }
  }

  public function check() {
     
  }

  # NB: This uses late static binding, which requires PHP 5.3+
  #   e.g., if entered via Member::get_by, static refers to Member
  public static function get_by( $key, $val ) {
    if( in_array($key, static::$unique_keys) ) {
      # Make sure we create an instance of the calling class, not this one
      $new = new static;
      $sql = "SELECT * FROM " . static::$table;
      $sql .= " WHERE $key = '" . mysql_real_escape_string($val) . "'";
      debug("SQL: $sql");
      $result = mysql_fetch_assoc(mysql_query($sql));
      $new->id = $result[static::$primary_key];
      $new->from_array( $result );
      return $new;
    } else {
      debug("Bad key: $key");
    }
  }

  public static function get_by_id( $id ) {
    return self::get_by( static::$primary_key, $id );
  }

  public function save() {
    if( !$this->id ) {
      $sql = 'INSERT into ' . static::$table;
      $sql .= '(' . $this->sql_list(static::$save_cols) . ")";
      $sql .= " VALUES (" . $this->sql_list($this->names_to_vals(static::$save_cols), true) . ")";
      debug("SQL: $sql");
      $result = mysql_query($sql);
      if(!$result) {
        debug("INSERT failed: " . mysql_error());
        return;
      } else {
        $this->id = mysql_insert_id();
        return $this->id;
      }
    } else {
      $sql = "UPDATE " . static::$table . " SET ";
      $sql .= $this->sql_pairs(static::$save_cols);
      $sql .= " WHERE " . static::$primary_key . " = $this->id";
      debug("SQL: $sql");
      $result = mysql_query($sql);
      if(!$result) {
        debug("UPDATE failed: " . mysql_error());
        return;
      } else {
        return $this->id;
      }
    }
  }

}

?>
