#!/bin/bash

OS = $(shell uname)
UID = $(shell id -u)
PLATFORM = "linux/arm64/v8"
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


build: ## Rebuilds all the containers for target "build"
	docker compose build --no-cache

restart: ## Restart the containers
	@make down
	@make up

up: ## Run the containers
	docker compose up --build -d

stop: ## Stop the containers
	docker compose stop

down: ## Stop and remove the containers and volumes
	docker compose down --remove-orphans -v

logs: ## Show the logs of the containers with timestamps
	docker compose logs -tf

logs-error: ## Show the logs of the containers with errors
	docker compose logs -tf
