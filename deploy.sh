#!/bin/bash

apache2conf=/etc/apache2

echo -e "--- Mise en place préliminaires ---\n"
echo "Mise à jour des paquets..."
apt update &> /dev/null
apt upgrade -y &> /dev/null

echo "Installation des paquets necéssaires..."
apt install git 

echo "Recupération du projet depuis le dépot github..."
cd /var/www/
git clone https://github.com/kacihmd/signalres 

echo -e "--- Configuration d'Apache ---\n"

echo "Supression du site par défaut..."
rm $apache2conf/sites-enabled/000-defaut.conf 

touch $apache2conf/sites-available/signalres.conf
echo "
    <VirtualHost *:80>
        ServerName 192.169.76.76:80
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

echo Déploiement du projet SignalRes : Fini !

