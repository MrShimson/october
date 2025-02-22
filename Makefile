DB_ROOT_PASSWORD := $(shell grep -m 1 'DB_ROOT_PASSWORD' .env | cut -d '=' -f2)
DB_DATABASE := $(shell grep -m 1 'DB_DATABASE' .env | cut -d '=' -f2)
DB_BACKUP_PATH := $(shell grep -m 1 'DB_BACKUP_PATH' .env | cut -d '=' -f2)

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
	./.docker/mysql/init/generate-password.sh
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
	sleep 20
	./bin/artisan migrate --force
	./bin/artisan october:migrate
	./bin/artisan key:generate

# Database
dump:
	@docker exec mysql-october sh -c 'mysqldump -u root --password=${DB_ROOT_PASSWORD} ${DB_DATABASE} > ${DB_BACKUP_PATH}/${DB_DATABASE}"_backup".sql'
restore:
	@docker exec mysql-october sh -c 'mysql -u root --password=${DB_ROOT_PASSWORD} ${DB_DATABASE} < ${DB_BACKUP_PATH}/${DB_DATABASE}"_backup".sql'
