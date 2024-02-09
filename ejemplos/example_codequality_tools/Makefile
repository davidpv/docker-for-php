#!/bin/bash

OS = $(shell uname)
UID = $(shell id -u)
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


build: ## Rebuilds all the containers
	docker compose build --no-cache php

restart: ## Restart the containers
	@make down
	@make up

up: ## Run the containers
	docker compose up -d --build

stop: ## Stop the containers
	docker compose stop

down: ## Stop and remove the containers and volumes
	docker compose down --remove-orphans -v

logs: ## Show the logs of the containers with timestamps
	docker compose logs -tf

ssh: ## SSH into the php container
	docker compose exec -it php /bin/bash

php-cs-fixer: ## Run cd fixer
	docker compose exec -it php vendor/bin/php-cs-fixer fix -vv

php-code-sniffer: ## Run codesniffer
	docker compose exec -it php vendor/bin/phpcs .phpcs.xml main.php

phpstan: ## Run phpstan
	docker compose exec -it php vendor/bin/phpstan --memory-limit=-1 analyse main.php
