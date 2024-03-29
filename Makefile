#!/usr/bin/env make

-include .env
export

default: bash

build:
	docker-compose build --build-arg USER_ID=$$(id -u) --build-arg GROUP_ID=$$(id -g) --no-cache

start:
	docker-compose up -d --no-build

stop:
	docker-compose stop

down:
	docker-compose down --remove-orphans

logs:
	docker-compose logs --timestamps --tail 25 --follow

bash:
	docker-compose exec php sh

ecs:
	docker-compose exec php sh -c 'vendor/bin/ecs check --config=ecs.php;'

ecs_fix:
	docker-compose exec php sh -c 'vendor/bin/ecs check --config=ecs.php --fix;'

phpmd:
	docker-compose exec php sh -c "vendor/bin/phpmd src text phpmd.xml"

phpstan:
	docker-compose exec php sh -c "vendor/bin/phpstan --memory-limit=256M analyse -c phpstan.neon -l 9"

phpunit:
	docker-compose exec php sh -c "vendor/bin/phpunit -c phpunit.xml --testdox"

test:
	@make ecs
	@make phpmd
	@make phpstan
	@make phpunit
