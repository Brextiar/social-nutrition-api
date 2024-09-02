SYMFONY_BIN = symfony
SYMFONY_CONSOLE = $(SYMFONY_BIN) console
PHP_CONSOLE = php bin/console
PHPSTAN = php vendor/bin/phpstan

.DEFAULT_GOAL := help
Arguments := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))

## —————————————————————————————————————————————————————————————————
## —— MAKE HELP ————————————————————————————————————————————————————
help: ## -> Outputs this help screen
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
## —————————————————————————————————————————————————————————————————
## ——— Symfony  ————————————————————————————————————————————————————
entity: ## -> make:entity
	$(SYMFONY_CONSOLE) make:entity
entity-gs: ## -> make:entity with getters/setters
	$(SYMFONY_CONSOLE) make:entity --regenerate
form: ## -> make:form
	$(SYMFONY_CONSOLE) make:form
ctrl: ## -> make:controller
	$(SYMFONY_CONSOLE) make:controller
cc: ## -> clear cache
	$(SYMFONY_CONSOLE) cache:clear
s-start: ## -> start symfony server
	$(SYMFONY_BIN) server:start
s-stop: ## -> stop symfony server
	$(SYMFONY_BIN) server:stop
## —————————————————————————————————————————————————————————————————
## ——— Doctrine ————————————————————————————————————————————————————
ddc: ## -> doctrine:database:create
	$(PHP_CONSOLE) doctrine:database:create --if-not-exists
mm: ## -> make:migration
	$(PHP_CONSOLE) make:migration
dmm: ## -> doctrine:migrations:migrate
	$(PHP_CONSOLE) doctrine:migrations:migrate
## —————————————————————————————————————————————————————————————————
## ——— Grumphp —————————————————————————————————————————————————————
grumphp: ## -> run
	php ./vendor/bin/grumphp run
## —————————————————————————————————————————————————————————————————
## ——— Stan ————————————————————————————————————————————————————————
stan: ## -> analyse
	$(PHPSTAN) analyse -l max -c configurations/.phpstan.neon --memory-limit 1G
	@echo "PHPStan analysis completed with exit code $$?"
## —————————————————————————————————————————————————————————————————
## ——— Test ————————————————————————————————————————————————————————
run-tests: ## -> run all tests
	php bin/phpunit
new-test: ## -> create new test
	$(PHP_CONSOLE) make:test