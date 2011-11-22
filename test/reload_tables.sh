#!/bin/sh

USER=test
PASSWD=foobar
TABLE=membership_test
SQL_DIR=`dirname $0`/../sql

for i in members requests; do
  echo "Reloading ${i} table..."
  mysql -u $USER -p$PASSWD $TABLE < $SQL_DIR/${i}_table.sql
done

