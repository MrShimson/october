init:
	cp ./.env.example ./.env
	docker network create october-network || true
	make up
	make install
install:
	./bin/composer install -o -a
up:
	docker-compose -f docker-compose.yml up -d --build
down:
	docker-compose -f docker-compose.yml down