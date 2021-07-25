#!/bin/sh
echo $FLAG > /flag_no_0n3_kn0w.txt
export FLAG=not_flag
FLAG=not_flag
#要写在最后
/usr/local/tomcat/bin/catalina.sh run
rm -f docker-entrypoint.sh

