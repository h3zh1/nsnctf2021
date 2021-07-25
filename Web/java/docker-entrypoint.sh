#!/bin/sh
echo "<!-- $FLAG -->" >> /usr/local/tomcat/webapps/java/WEB-INF/web.xml
export FLAG=flag_not_here
FLAG=flag_not_here
#要写在最后
/usr/local/tomcat/bin/catalina.sh run
rm -f docker-entrypoint.sh

