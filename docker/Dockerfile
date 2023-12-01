FROM debian:buster-slim

RUN apt update
RUN apt install apache2 -y
RUN apt-get install php -y
RUN apt-get install mariadb-server -y
RUN apt-get install php-mysql -y
RUN rm /var/www/html/index.html


COPY ./website/* /var/www/html/
COPY start_service.sh /start_service.sh
 
RUN service mysql start && mysql -e "CREATE DATABASE biostest;" 
RUN service mysql start && mysql -e "USE biostest; CREATE TABLE users (\`id\` int(11) NOT NULL AUTO_INCREMENT, \`username\` varchar(50) NOT NULL, \`email\` varchar(50) NOT NULL, \`password\` varchar(50) NOT NULL, PRIMARY KEY (\`id\`));"

RUN service mysql start && mysql -e "USE biostest; INSERT INTO users values('1','admin','admin@admin','21232f297a57a5a743894a0e4a801fc3');"



CMD ["/bin/bash", "/start_service.sh"]


EXPOSE 80 3306









