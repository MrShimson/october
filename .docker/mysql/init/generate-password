#!/usr/bin/env sh

# Генерация случайных паролей длиной 16 символов с использованием openssl
MYSQL_ROOT_PASSWORD=$(openssl rand -base64 16)
MYSQL_PROD_USER_PASSWORD=$(openssl rand -base64 16)

# Запись паролей в .env файл с использованием sed
# Заменяем значение для DB_ROOT_PASSWORD
sed -i "s/^DB_ROOT_PASSWORD=.*/DB_ROOT_PASSWORD=$MYSQL_ROOT_PASSWORD/" .env
# Заменяем значение для DB_PASSWORD
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$MYSQL_PROD_USER_PASSWORD/" .env

# Вывод сгенерированных паролей
echo "Новый пароль для root MySQL: $MYSQL_ROOT_PASSWORD"
echo "Новый пароль для пользователя MySQL: $MYSQL_PROD_USER_PASSWORD"
