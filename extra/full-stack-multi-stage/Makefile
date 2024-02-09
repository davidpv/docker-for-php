#!/bin/bash
SYMFONY_VERSION=7.0

help: ## Show this help message
	@echo
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

.SILENT: run

init:
	@make restart

build:
	docker-compose build --pull

up: ## Start the containers
	docker-compose up --build --detach

stop: ## Stop the containers
	docker compose stop -f

down: ## Remove the containers
	docker compose down --remove-orphans

install: ## Installs symfony
	docker compose exec -it -e SYMFONY_VERSION=${SYMFONY_VERSION} php sh /install.sh
	@make composer

ssh: ## ssh's into the PHP container
	@docker compose exec -it php bash

root: ## ssh's into the PHP container
	@docker compose exec -it -u root php bash

restart: ## Restart the containers
	@make down
	@make build
	@make up
	@make composer

composer: ## Installs composer dependencies
	docker compose exec php composer install --no-scripts --no-interaction --optimize-autoloader

logs: ## Show the logs
	docker compose logs -f