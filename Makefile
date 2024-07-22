### Symfony Console ###
SYMFONY_BIN = symfony
SYMFONY_CONSOLE = $(SYMFONY_BIN) console
PHP_CONSOLE = php bin/console
PHPSTAN = php vendor/bin/phpstan

sf-entity:
	$(SYMFONY_CONSOLE) make:entity

sf-form:
	$(SYMFONY_CONSOLE) make:form

sf-ctrl:
	$(SYMFONY_CONSOLE) make:controller


### Grumphp ###

grumphp:
	php ./vendor/bin/grumphp run

### Stan ###
stan:
	$(PHPSTAN) analyse -l max -c configurations/.phpstan.neon --memory-limit 1G
	@echo "PHPStan analysis completed with exit code $$?"