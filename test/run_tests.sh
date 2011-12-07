#!/bin/sh

export ENV=test
DIR=`dirname $0`

$DIR/reload_tables.sh

for i in member request; do
  echo -n "${i}_test: "
  php $DIR/${i}_test.php
done
