#!/bin/bash

OS = $(shell uname)
UID = $(shell id -u)
IMAGE_NAME = "mysql_image"
PLATFORM = "linux/arm64/v8"
DOCKER_APP = "app"
NAMESERVER_IP = $(shell ip address | grep docker0)

ifeq ($(OS),Darwin)
	NAMESERVER_IP = host.docker.internal
else ifeq ($(NAMESERVER_IP),)
	NAMESERVER_IP = $(shell grep nameserver /etc/resolv.conf  | cut -d ' ' -f2)
else
	NAMESERVER_IP = 172.17.0.1
endif

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

build: ## Build the containers
	docker build -t ${IMAGE_NAME} .

run: ## Run the containers
	docker run --rm --name ${DOCKER_APP} -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 -v ./docker-entrypoint-initdb.d/:/docker-entrypoint-initdb.d/ -v mysql-data:/var/lib/mysql ${IMAGE_NAME}

ssh: ## Run the containers
	docker exec -it ${DOCKER_APP} bash

down: ## Stop the containers
	docker stop ${DOCKER_APP} && docker rm ${DOCKER_APP}

logs: ## Show the logs of the containers
	docker logs -f ${DOCKER_APP}