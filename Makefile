#!make

# agreagate commands
code-quality: pint phpstan


serve:
	docker-compose up -d

stop:
	docker-compose stop


# quality command
pint:
	docker-compose exec app ./vendor/bin/pint

phpstan:
	docker-compose exec app ./vendor/bin/phpstan analyse --memory-limit=2G

phpunit:
	docker-compose exec app ./vendor/bin/phpunit

# configuration

## launch it one time
initgit:
	git config core.hooksPath .githooks
