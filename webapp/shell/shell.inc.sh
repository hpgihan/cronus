#!/bin/bash

#Application specific variables (added by Pubudu)
OS="LINUX"; #Has to be either LINUX or BSD
SERVER='multi'; #Has to be either basic or multi
FILE_SYS_HOME='ad0s1d/home'; #Make sure to configure this if the OS is BSD
VIRTUAL_GROUP='customers'; #Make sure to configure this if the OS is LINUX

# Mysql specific variables
DBUSER="root"
DBPASS=''
if [ -f /home/cust${PORT}/etc/dbuserpassword.txt ];then
	DBPASS=`cat /home/cust${PORT}/etc/dbuserpassword.txt`
fi
MYSQL_PORT=`expr $PORT - 1000`

# config variables
INFRASERVER="infra.thinkcube.net"
MAILSERVER="mail.thinkcube.net"
WEBAPPSERVER="webapp.thinkcube.net"

#MYSQL="mysql --protocol tcp"

## Added by Gihan
MYSQL_HOST="localhost";
MYSQL_USER="root";
MYSQL_PASS="thinkcube";

#Hosting type specific variables (Added by Pubudu)
if [[ $SERVER == "basic" ]]; then
	DB_TC="cust${PORT}_tc";
	DBUSER="cust${PORT}";
	MYSQL="mysql";
	MYSQL_USER_PASS=$MYSQL_PASS;
	DBPORT=3306;
	AUTH_USER="www-data";
	APACHE_SITES_AVAILABLE_DIR="/etc/apache2/sites-available";
	APACHE_SITES_ENABLE_DIR="/etc/apache2/sites-enable";
else
	DB_TC="tc";
	MYSQL_USER_PASS=$DBPASS;
	DBPORT=$MYSQL_PORT;
	MYSQL="mysql -P $MYSQL_PORT --protocol tcp";
	AUTH_USER="cust$PORT";	
fi

#Server type specific variables (Added by Pubudu)
if [[ $OS == "LINUX" ]]; then
	MD5SUM='md5sum';
	USERADD='useradd';
	USERDEL='userdel';
	GROUPADD='groupadd';
	SUDOGROUP='sudo';
	APACHE_CONF='apache2.conf.linux';
	APACHE_STARTUP_SCRIPT='/usr/sbin/apache2ctl';
	APACHECOMMAND="apache2ctl";
	APACHE_DIS_SITE="a2dissite";
	APACHE_EN_SITE="a2ensite";
elif [[ $OS == "BSD" ]]; then
	MD5SUM='md5';
	USERADD='pw useradd';
	USERDEL='pw userdel';
	GROUPADD='pw groupadd';
	SUDOGROUP='wheel';
	APACHE_CONF='apache2.conf.bsd';
	APACHE_STARTUP_SCRIPT='/usr/local/sbin/apachectl';
	APACHECOMMAND="apachectl";
fi

#Server independent variables (Added by Pubudu)
CHOWN='chown';
MYSQL_CONF='/etc/mysql/my.cnf';
HOME="/home/";
TOUCH='touch';
PWGEN='pwgen';
INFO='master.info';
