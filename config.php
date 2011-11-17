<?php

    # config.php -- global configuration and settings

    # Eric Lease Morgan (eric_morgan@infomotions.com)
    # http://www.infomotions.com

    # Database configuration
    $gDbHost       = "localhost";
    $gDatabase     = "membership_dev";
    $gUsername     = "membership-www";
    $gPassword     = "foobar";

    # Contact information
    $gHome         = "http://www.trilug.org/";
    $gDate         = "2011/11/15";
    $gContactName  = "TriLUG Member Tool Maintainers";
    $gContactEmail = "member-tool@trilug.org";

    # Behavior of the debug function
    # - 0 = no debugging, 1 = inline comment, 2 = visable, 3 = raw
    # - set to 0 when deployed
    $gDebug        = 2;

?>
