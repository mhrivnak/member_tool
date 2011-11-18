<?php

# config.php -- global configuration and settings

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# License: MIT License, http://www.opensource.org/licenses/mit-license.php

include('lib/spyc.php');

function load_config( $config_file ) {

    $configs = Spyc::YAMLLoad($config_file);

    $environment = $_SERVER['ENV'];
    is_string($environment) || $environment = "";

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
