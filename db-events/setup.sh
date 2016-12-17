#!/bin/bash
mypath=`realpath $0`
mybase=`dirname $mypath`

dbname=events

if [[ -n `psql -lqt | cut -d \| -f 1 | grep -w "$dbname"` ]]; then
    dropdb $dbname
fi
createdb $dbname

cd $mybase
python eventscraper.py
psql -af create.sql $dbname
psql -af load.sql $dbname
