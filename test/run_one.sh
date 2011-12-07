#!/bin/sh

export ENV=test
DIR=`dirname $0`

$DIR/reload_tables.sh

php $DIR/$1_test.php
