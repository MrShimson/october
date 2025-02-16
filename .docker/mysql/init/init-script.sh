#!/usr/bin/env bash

PLUGIN_CHECK=$(mysql --user=root --password="$MYSQL_ROOT_PASSWORD" -e "SELECT plugin_name FROM information_schema.plugins WHERE plugin_name = 'auth_socket';")

if [[ $PLUGIN_CHECK == *"auth_socket"* ]]; then
    echo "Плагин auth_socket уже установлен. Пропуск установки."
else
    echo "Плагин auth_socket не установлен. Устанавливаем..."
    mysql --user=root --password="$MYSQL_ROOT_PASSWORD" -e "INSTALL PLUGIN auth_socket SONAME 'auth_socket.so';"
    echo "Плагин auth_socket успешно установлен."
fi

#TODO: Если менять пользователя БД, то нужно также менять <root@localhost> => <[username]@localhost> и <root> => <[user_password]>
echo "Установка аутентификации пользователя через Unix сокет"
mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE USER 'root'@'%' IDENTIFIED WITH auth_socket;
    GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';
    FLUSH PRIVILEGES;
EOSQL
id
mysql --user=root -e "SELECT User, Host, Plugin FROM mysql.user;"
