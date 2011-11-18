<?

# debug.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# Licensed under The MIT License
# http://www.opensource.org/licenses/mit-license.php

# Debug output, formatted (or hidden) based on the $conf['debug'] global
# - 0 = no debugging, 1 = inline comment, 2 = visable, 3 = raw
function debug( $msg='' ) {

    global $conf;
    switch ($conf['debug']) {
        case 1:
            echo "<!-- $msg -->\n";
            break;
        case 2:
            echo "<pre>DEBUG: $msg</pre>\n";
            break;
        case 3:
            echo "$msg\n";
            break;
            
    }
}

?>
