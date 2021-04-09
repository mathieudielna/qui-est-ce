#!/bin/sh

USER="levetsph"

DBADMIN="levetsph_oling"
DBPW=":Js5$89V6TPS."

DB1="levetsph_mapsi"

DATE=`date -I`


find /home/$USER/backups/files/public_html* -mtime -1 -exec rm {} \;
find /home/$USER/backups/bdd/bdd* -mtime -1 -exec rm {} \;


mysqldump -u ${USER}_${DBADMIN} -p$DBPW ${USER}_${DB1} | gzip > /home/$USER/backups/bdd/bddbackup_${DB1}_${DATE}.sql.gz

tar czf /home/$USER/backups/files/public_html_$DATE.tar.gz -C / home/$USER/public_html;