<?php

# config.php -- global configuration and settings

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# License: GNU GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)

include('lib/spyc.php');

function load_config( $config_file, $environment = "" ) {

    $configs = Spyc::YAMLLoad($config_file);

    if(!$environment) {
      $environment = $_SERVER['ENV'];
      is_string($environment) || $environment = "";
    }

    if( !array_key_exists($environment, $configs) ) {
      echo "Configuration does not exist for environment.\n";
      echo "  \$ENV: '" . $environment . "'\n";
      echo "  Configuration file: '" . $config_file . "'\n";
      exit;
    }

    foreach ($configs[$environment] as $key => $value) {
      $conf[$key] = $value;
    }

    return $conf;

}
  
?>
