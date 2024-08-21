BIN = ./vendor/bin
SAIL = $(BIN)/sail

# Docker --------------------------------------------------------------------- #
start:
	$(SAIL) up -d

stop:
	$(SAIL) stop

down:
	$(SAIL) down

rebuild:
	make down;
	$(SAIL) build --no-cache;
	make restart;

sh:
	docker exec -it acme-widget-laravel.test-1 bash

restart:
	make stop; make start;

# App ------------------------------------------------------------------------ #
local-setup:
	cp .env.example .env
	composer install;
	make start;
	$(SAIL) artisan key:generate;
	$(SAIL) artisan storage:link;
	make migrate;

migrate:
	$(SAIL) artisan migrate:fresh --seed;

clear:
	$(SAIL) artisan view:clear;
	$(SAIL) artisan config:clear;
	$(SAIL) artisan optimize:clear;
	$(SAIL) artisan route:clear;

test:
	$(SAIL) artisan migrate:fresh --seed --env=testing
	$(SAIL) artisan test;

ecs: ## Runs the ECS checker and fixes anything it can
	@$(SAIL) php $(BIN)/ecs --fix

phpstan: ## Runs the php-stan
	@$(SAIL) php $(BIN)/phpstan analyse -c phpstan.neon

rector: ## Runs the php-stan
	@$(SAIL) php $(BIN)/rector process app

ci: ## Runs all Quality tools
	make ecs
	make rector
	make phpstan
	make test
