FROM tomcat:8-jdk8

COPY ./java /usr/local/tomcat/webapps/java
RUN mkdir /init-scripts/
COPY ./docker-entrypoint.sh /init-scripts/docker-entrypoint.sh
RUN chmod +x /init-scripts/docker-entrypoint.sh && chmod 777 /usr/local/tomcat/webapps/java/WEB-INF/web.xml
EXPOSE  8080

CMD ["/init-scripts/docker-entrypoint.sh","run"]