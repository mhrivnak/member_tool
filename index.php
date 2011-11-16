<?php

    # index.php - a trilug membership list

    # Copyright (c) 2000 Eric Lease Morgan  <eric_morgan@infomotions.com>
    # Licensed under the GNU GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)

    # define some constants
    $gDbHost       = "localhost";
    $gDatabase     = "membership";
    $gUsername     = "membership-www";
    $gPassword     = "foobarbaz";
    $gHome         = "http://www.trilug.org/";
    $gDate         = "2011/11/15";
    $gContactName  = "Member Tool Maintainers";
    $gContactEmail = "member-tool@trilug.org";

    # Behavior of the debug function
    # - 0 = no debugging, 1 = inline comment, 2 = visable, 3 = raw
    # - set to 0 when deployed
    $gDebug        = 2;

    # let's get started; no editing should be necessary below this line

    include("php4-1-1_varfix.php");
    include("debug.php");

    # open a connection to the database server
    $db_conn = mysql_connect("$gDbHost","$gUsername","$gPassword");
    if(!$db_conn) {
      debug("Cound not open database : ".mysql_error());
      exit;
    }
    $the_db = mysql_select_db("$gDatabase",$db_conn);
    if(!$the_db) {
      debug("Mysql Error : ".mysql_error());
      exit;
    }

    # display the header
    include "header.inc";

    debug("Command is : $cmd");
    # process the command
    if (! $cmd) {

        # display the home page
        include "./home.inc";

    }

    # new member record
    elseif ($cmd == "add") {

        include "add.php";

    }

    # display all members
    elseif ($cmd == "displayall") {

        include "./displayall.php";

    }

    # display a member
    elseif ($cmd == "displayone") {

        include "displayone.php";

    }

    # delete record
    elseif ($cmd == "delete") {

        include "delete.php";

    }

    # edit record
    elseif ($cmd == "edit") {

        include "edit.php";

    }

    # search
    elseif ($cmd == "search") {

        include "search.php";

    }

    # email all
    elseif ($cmd == "emailall") {
        include "emailall.php";
    }

    # email
    elseif ($cmd == "email") {
        include "email.php";
    }

    # manual
    elseif ($cmd == "manual") {

        include "manual.inc";

    }

    # unknown command
    else {

        # error
        $error = "Unknown value for cmd ($cmd).";
        include "error.inc";

    }

    # display the footer
    include "footer.inc";

    # close the database connection
    mysql_close($db_conn);

?>
