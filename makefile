-include .env

STAGE ?= $(APP_ENV)

help: ## Display available make commands
	@if command -v awk >/dev/null 2>&1; then \
		awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} \
			/^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-25s\033[0m %s\n", $$1, $$2 } \
			/^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) }' $(MAKEFILE_LIST); \
	else \
		echo ""; \
		echo "Usage:"; \
		echo "  make <target>"; \
		echo ""; \
		echo "Available targets:"; \
		findstr /R "^[a-zA-Z_-]*:.*##" $(MAKEFILE_LIST) | sed "s/:.*##/ - /"; \
	fi

.PHONY=install-symfony start stop cc php composer-install composer-update create-database migrations fixtures

##@ General

start: ## Start project
	docker compose --env-file .env -f docker/compose.$(STAGE).yml up -d

stop: ## Stop project
	docker compose --env-file .env -f docker/compose.$(STAGE).yml stop

cc:  ## Clear cache
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php php bin/console cache:clear

cw:  ## Warmup cache
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php php bin/console cache:warmup --env=$(APP_ENV)

build: ## Build the app
	docker compose --env-file .env -f docker/compose.$(STAGE).yml build --no-cache

php: ## Run bash console in php container
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm php bash

deptrac: ## Run Deptrac analyse
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php php vendor/bin/deptrac analyse

##@ Composer
composer-install: ## Install composer dependencies
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php composer install

composer-update: ## Update composer dependencies
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php composer update

##@ Symfony
create-database: ## Create database
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php php bin/console doctrine:database:create

migrations: ## Execute migrations
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php php bin/console doctrine:migrations:migrate

fixtures: ## Load fixtures
	docker compose --env-file .env -f docker/compose.$(STAGE).yml run --rm --no-deps php php bin/console doctrine:fixtures:load