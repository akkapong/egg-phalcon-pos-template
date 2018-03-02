#!/bin/sh

docker rm -f <%= projectName %>-mariadb
docker rm -f <%= projectName %>-app
docker rm -f <%= projectName %>-swagger
docker-compose rm

docker-compose build <%= projectName %>-mariadb
docker-compose up -d <%= projectName %>-mariadb

docker-compose build <%= projectName %>-swagger
docker-compose up -d <%= projectName %>-swagger

docker-compose build <%= projectName %>-app
docker-compose up -d <%= projectName %>-app