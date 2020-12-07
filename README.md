Environment construction using laradock

WEB | http://localhost PHPMyadmin | http://localhost:8081/

Create Laravel environment file

->git clone git@github.com:ChronoDevs/darwin-real-estate-system.git

Copy the environment file of Laravel from .env.example as .env and change it as follows

APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=tele-tracker
DB_USERNAME=root
DB_PASSWORD=root

Create Laradock environment file

-git clone https://github.com/Laradock/laradock.git
-cd laradock
-cp env-example .env
-.env

-APP_CODE_PATH_HOST = ../
+APP_CODE_PATH_HOST=../cebutele_timetracker

-WORKSPACE_INSTALL_IMAGEMAGICK = false
+WORKSPACE_INSTALL_IMAGEMAGICK = true

-PHP_FPM_INSTALL_EXIF = false
+PHP_FPM_INSTALL_EXIF = true

+PMA_PORT=8081

-MYSQL_VERSION = latest
+MYSQL_VERSION = 5.7
Start Docker and install laravel Note that the following commands are very long for the first time. It may take about an hour.

docker-compose up -d nginx phpmyadmin mysql maildev workspace
Connect to launched docker docker-compose exec workspace bash

chmod -R 777 storage /

composer install

npm install
