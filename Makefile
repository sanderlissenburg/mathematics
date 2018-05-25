help: ## Show this help message.
	@echo 'usage: make [target] ...'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

install:
	docker-compose run --rm  php-fpm composer install -n

test:
	docker-compose run --rm php-fpm bin/phpunit
