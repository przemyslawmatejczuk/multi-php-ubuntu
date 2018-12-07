#!/bin/bash

PHP=`which php`
${PHP} -n -d memory_limit=-1  /usr/local/bin/composer "$@"
