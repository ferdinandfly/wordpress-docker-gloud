docker_compose_exec = docker-compose exec -T
docker_console = $(docker_compose_exec) wp bin/console

none: help

###############
# Application #
###############

## Install and start full application
install: build start

stop:
	docker-compose down

remove: stop
	docker-compose rm --force

remove-volume: remove
	docker-compose down -v

build: remove
	docker-compose build	

## Run containers
up: start

## Halt containers
down: stop

start:
	docker-compose up -d --remove-orphans

## Wordpress bash
bash:
	docker-compose exec wp bash

log:
	docker-compose logs -f

## sync with gcloud
sync:
	cd wp-app; gcloud app deploy app.yaml cron.yaml

sync-origin:
	cd wp-app-origin; gcloud app deploy app.yaml cron.yaml

sync-wordpress:
	cd wp-app;wp core update  --path=wordpress;
sync-plugin:
	cd wp-app; wp plugin update --all; wp theme update --all;


# Help instructions
help:
	@echo "\033[0;33mUsage:\033[0m"
	@echo "     make [target]\n"
	@echo "\033[0;33mAvailable targets:\033[0m"
	@awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		returnMessage = match(n4line, /^# (.*)/); \
		if (returnMessage) { \
			printf "\n"; \
			printf "     %s\n", n5line; \
			printf "     %s\n", n4line; \
			printf "     %s\n", n3line; \
			printf "\n"; \
		} \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "     \033[0;32m%-22s\033[0m %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ n5line = n4line; n4line = n3line; n3line = n2line; n2line = lastLine; lastLine = $$0;}' $(MAKEFILE_LIST)
	@echo ""
