#!/bin/bash

echo ""
echo "------------------------"
echo "|           🚀          |"
echo "|  PDF Tables for PHP  |"
echo "------------------------"

cd .
DIR=`pwd`
echo "Moving to PDF Tables for PHP working directory…"
cd $DIR

echo "Crunching files…"
API_KEY=`php -f convert.php`

echo "Retreiving remaining conversion credits…"
curl https://pdftables.com/api/remaining?key=$API_KEY

echo "Thanks!"
echo ""
