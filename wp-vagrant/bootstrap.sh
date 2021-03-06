#!/usr/bin/env bash

#
# load settings file
#
. /vagrant/wp-vagrant/settings.sh

debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password password $mysql_root_password"
debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password_again password $mysql_root_password"

# default packages (php, mysql, nginx, etc), are preinstalled in the base box
# update anyway, and also make sure php-mbstring is installed
# we'll move this into the base box next update 

apt-get update
apt-get upgrade
apt-get install php-mbstring php7.0-mbstring php5.5-mbstring php5.6-mbstring -y

echo "**** add byobu config"
. /vagrant/wp-vagrant/configs/byobu.sh

echo "**** Moving nginx config files into place…"
. /vagrant/wp-vagrant/nginx/nginx.sh

echo "**** mysql config…"
mv /etc/mysql/my.cnf /etc/mysql/my.cnf.default
cp /vagrant/wp-vagrant/mysql/my.cnf /etc/mysql/my.cnf

echo "**** Set PHP to ${php_version} and copy config files"
. /vagrant/wp-vagrant/php/php.sh


echo "Starting services…"
service nginx restart
service php5.5-fpm stop
service php5.6-fpm stop
service php7.0-fpm stop

service php${php_version}-fpm restart
service mysql restart

# Custom: add wp-config.
echo "wp core config --path=$wp_path --dbname=$wp_db_name --dbuser='$wp_db_user' --dbpass='$wp_db_password'"

sudo -u vagrant -i -- rm $wp_path/wp-config.php
sudo -u vagrant -i -- wp core config  --path=$wp_path --dbname=$wp_db_name --dbuser=$wp_db_user --dbpass=$wp_db_password --extra-php <<PHP
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_HOME', 'http://localhost.stanforddaily.com' );
define( 'WP_SITEURL', 'http://localhost.stanforddaily.com' );
PHP

# sudo -u vagrant -i -- wget s3 > dump.sql 

# WP-CLI
. /vagrant/wp-vagrant/wp/wp-cli.sh

# Create database
. /vagrant/wp-vagrant/mysql/create_database.sh

# Install WP
. /vagrant/wp-vagrant/wp/install-wp.sh

# Import database
. /vagrant/wp-vagrant/mysql/import_database.sh
