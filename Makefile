# Local

init-local:
	cp ./.env.local ./.env
	docker network create october-network || true
	make up-local
	make install
up-local:
	docker-compose -f docker-compose.local.yml up -d --build
down-local:
	docker-compose -f docker-compose.local.yml down

# Production

init-prod:
	cp ./.env.prod ./.env
	docker network create october-network || true
	make up-prod
	make install
up-prod:
	docker-compose -f docker-compose.prod.yml up -d --build
down-prod:
	docker-compose -f docker-compose.prod.yml down

# Common

install:
	./bin/composer install -o -a
	sleep 10
	./bin/artisan migrate --force
	./bin/artisan october:migrate
	./bin/artisan key:generate
