#!/bin/bash

if [[ -f /var/www/html/db.sql ]]; then
    mysql -e "source /var/www/html/db.sql" -uroot -proot
    rm -f /var/www/html/db.sql
fi

# 修改数据库中的 FLAG 
mysql -e "USE kee1ongzs_news;INSERT INTO Flag VALUES('$FLAG');" -uroot -proot

export FLAG=not_flag
FLAG=not_flag

rm -f /flag.sh

chown -R root:root /var/www/html/
chmod -R 755 /var/www/html/
