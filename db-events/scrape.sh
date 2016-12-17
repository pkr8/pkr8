#!/bin/bash
mypath=`realpath $0`
mybase=`dirname $mypath`

dbname=events

cd $mybase
chmod +x eventscraper.py
python eventscraper.py    
psql -af create.sql $dbname
echo $mybase                                                                                                                                                                                 
