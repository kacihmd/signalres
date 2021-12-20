#!/bin/bash

echo Mise à jour des paquets...
apt update &> /dev/null
apt upgrade -y &> /dev/null

echo Installation des paquets nécéssaires...
apt install git &> /dev/null

echo Récupération du projet...
cd /var/www/
git clone https://github.com/kacihmd/signalres &> /dev/null


echo Déploiement du projet SignalRes : Fini !

