DOCKER_USER ?=foo
DOCKER_PASSWORD ?=bar

#ifneq ("$(wildcard .env)","")
#	include .env
#	export $(shell sed 's/=.*//' .env)
#endif

help: ## Show this help message.
	@echo 'usage: make [target] ...'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

install:
	docker-compose run --rm  php-fpm composer install -n

test:
	docker-compose run --rm php-fpm bin/phpunit

build-prod:
	docker build -t sanderlissenburg/mathematics-php-fpm . -f docker/php-fpm-prod/Dockerfile
	docker build -t sanderlissenburg/mathematics-nginx . -f docker/nginx-prod/Dockerfile
	docker login -u $(DOCKER_USER) -p $(DOCKER_PASSWORD)
	docker push sanderlissenburg/mathematics-php-fpm
	docker push sanderlissenburg/mathematics-nginx

deploy:
	scp docker-compose.prod.yml $(SSH)@$(SERVER_IP):var/www/mathematics
	ssh $(SSH_USER)@$(SERVER_IP) 'cd var/www/mathematics && docker-compose -f docker-compose.prod.yml up -d'
