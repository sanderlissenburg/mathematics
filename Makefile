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
	docker-compose run --rm php-fpm composer install -n

up:
	docker-compose up -d

test:
	docker-compose run --rm php-fpm bin/phpunit

build-dev:
	docker build -t sanderlissenburg/mathematics-php-fpm-dev -f docker/php-fpm/Dockerfile .
	docker build -t sanderlissenburg/mathematics-nginx-dev -f docker/nginx/Dockerfile .

build-prod:
	docker build -t sanderlissenburg/mathematics-php-fpm -f docker/php-fpm-prod/Dockerfile .
	docker build -t sanderlissenburg/mathematics-nginx -f docker/nginx-prod/Dockerfile .

push-prod:
	docker login -u $(DOCKER_USER) -p $(DOCKER_PASSWORD)
	docker push sanderlissenburg/mathematics-php-fpm
	docker push sanderlissenburg/mathematics-nginx

deploy:
	scp docker-compose.prod.yml $(SSH_USER)@$(SERVER_IP):~/www/mathematics/
	scp docker-compose.yml $(SSH_USER)@$(SERVER_IP):~/www/mathematics/
	ssh $(SSH_USER)@$(SERVER_IP) 'cd ~/www/mathematics && docker-compose -f docker-compose.prod.yml pull  && docker-compose -f docker-compose.prod.yml up -d'
