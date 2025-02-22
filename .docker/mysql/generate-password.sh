#!/usr/bin/env sh

# Генерация случайного пароля длиной 16 символов с использованием openssl
MYSQL_PASSWORD=$(openssl rand -base64 16)

# Запись пароля в .env файл с использованием sed
# Создаем или обновляем строки MYSQL_ROOT_PASSWORD и MYSQL_PASSWORD в файле .env
sed -i "/^MYSQL_ROOT_PASSWORD=/d" .env
sed -i "/^MYSQL_PASSWORD=/d" .env
echo "MYSQL_ROOT_PASSWORD=$MYSQL_PASSWORD" >> .env
echo "MYSQL_PASSWORD=$MYSQL_PASSWORD" >> .env

# Вывод сгенерированного пароля
echo "Новый пароль для MySQL: $MYSQL_PASSWORD"
