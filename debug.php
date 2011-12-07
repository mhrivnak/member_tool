<?

# debug.php

# Copyright (c) 2011 Jeff Schornick <code@schornick.org>
# License: GNU GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)

# Debug output, formatted (or hidden) based on the $conf['debug'] global
# - 0 = no debugging, 1 = inline comment, 2 = visable, 3 = raw
function debug( $msg='' ) {

    global $debug;
    switch ($debug) {
        case 0:
            break;
        case 1:
            echo "<!-- $msg -->\n";
            break;
        case 2:
            echo "<pre>DEBUG: $msg</pre>\n";
            break;
        case 3:
        default:
            echo "DEBUG: $msg\n";
            break;
            
    }
}

?>
