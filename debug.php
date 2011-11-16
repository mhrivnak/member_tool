<?

# Debug output, formatted (or hidden) based on the $gDebug global
# - 0 = no debugging, 1 = inline comment, 2 = visable, 3 = raw
function debug( $msg='' ) {
    global $gDebug;
    switch ($gDebug) {
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
