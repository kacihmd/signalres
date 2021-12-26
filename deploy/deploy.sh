#!/bin/bash

apache2conf=/etc/apache2

echo -e "--- Mise en place préliminaires ---\n"
# echo "Mise à jour des paquets..."
# apt update &> /dev/null 
# apt upgrade -y &> /dev/null

echo "Installation des paquets necéssaires..."
apt install -y git &> /dev/null

echo "Recupération du projet depuis le dépot github..."
cd /var/www/
git clone https://github.com/kacihmd/signalres &> /dev/null

chown -R urouen signalres

echo -e "--- Configuration d'Apache ---\n"

echo "Supression du site par défaut..."
rm -rf /var/www/html
rm $apache2conf/sites-enabled/000-default.conf 

echo "Configuration d'Apache pour le projet..."
a2enmod rewrite

touch $apache2conf/sites-available/signalres.conf
echo "
    <VirtualHost *:80>
        ServerName 192.168.76.76
        DocumentRoot \"/var/www/signalres\" 
        <Directory \"/var/www/signalres/\"> 
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted 
        </Directory> 
    </VirtualHost>
" > $apache2conf/sites-available/signalres.conf

cd $apache2conf/sites-enabled
ln -s $apache2conf/sites-available/signalres.conf

systemctl restart apache2.service

echo -e "--- Initialisation de la Base de données ---\n"
echo "Remplissage par les données de test (sql/base.sql)..."
cd /var/www/signalres/deploy
mysql --user=projet --password=tejorp projet < sql/base.sql

echo -e "\nDéploiement du projet SignalRes : Fini !\n"