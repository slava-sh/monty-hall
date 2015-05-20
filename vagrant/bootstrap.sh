#!/bin/bash -x
export DEBIAN_FRONTEND=noninteractive

# Force a blank root password for mysql
echo "mysql-server mysql-server/root_password password "       | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password " | debconf-set-selections

aptitude update
aptitude install -q -y -f mysql-server mysql-client nginx php5-fpm php5-cli
aptitude install -q -y -f php5-mysql php5-mbstring php5-curl php5-mcrypt php5-json
aptitude install -q -y -f phpmyadmin
aptitude clean

php5enmod mcrypt

cp /vagrant/nginx-site.conf /etc/nginx/sites-available/default
cp /vagrant/php.ini         /etc/php5/fpm/php.ini

service nginx restart
service php5-fpm restart

mysql -u'root' </vagrant/db.sql

cd /var/www
[ -e .env ] || cp .env.example .env
[ -e logs ] || mkdir logs
[ -e public/phpmyadmin ] || ln -s /usr/share/phpmyadmin public/phpmyadmin

php artisan migrate
