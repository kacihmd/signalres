#!/bin/bash

# Connexion au compte root
su < rotomagus 

# Mise à jour des paquets
apt update 
apt upgrade -y

# Installation des paquets nécéssaires
apt install git

# Récupération du projet
cd /var/www/
git pull https://github.com/kacihmd/signalres
