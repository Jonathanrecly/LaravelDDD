#!make

# agreagate commands
quality: pint


serve:
	docker-compose up -d

stop:
	docker-compose stop


# quality command
pint:
	docker-compose exec app ./vendor/bin/pint
