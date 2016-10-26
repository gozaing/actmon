#!/bin/sh

# setup locale
BASH_PROFILE="/home/vagrant/.bash_profile"
echo "export LANGUAGE=ja_JP.UTF-8" >> "$BASH_PROFILE"
echo "export LANG=ja_JP.UTF-8" >> "$BASH_PROFILE"
echo "export LC_ALL=ja_JP.UTF-8" >> "$BASH_PROFILE"

# yum update
sudo yum -y update

# repos(epel)
sudo rpm -ivh http://ftp-srv2.kddilabs.jp/Linux/distributions/fedora/epel/6/x86_64/epel-release-6-8.noarch.rpm
# repos(remi)
sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm

# php packages
sudo yum install -y --enablerepo=remi --enablerepo=remi-php56 php php-opcache php-devel php-mbstring php-mcrypt php-mysqlnd php-phpunit-PHPUnit php-pecl-xdebug php-pear php-xml php-pecl-apcu php-gd

# MySQL
sudo yum install -y http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm
sudo yum install -y mysql mysql-devel mysql-server mysql-utilities

# installation
sudo yum install -y httpd vim

# set document root
sudo rm -rf /var/www/html
sudo ln -fs /vagrant /var/www/html

# apache
sudo service httpd start
sudo chkconfig httpd on

# mysql
sudo service mysqld start
sudo chkconfig mysqld on
