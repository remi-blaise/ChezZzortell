Guide d'installation complète d'un système Linux
================================================

Préambule
---------

Après avoir installé deux fois Ubuntu dans la même journée, je suis maintenant bien rodé et chaud pour écrire ce petit guide.
Ce guide est une sorte de mémo ayant pour objectif de retracer une installation parfaite d'Ubuntu, rendant compte de mes façons
de faire les plus opti et les plus faciles pour une installation sans accro et un système absolumment parfait !

Je précise qu'il est parfaitement adapté à mon cas mais qu'il répond à mes besoins personnels.

Update : Modification pour installation Ubuntu 16.0

Étape préalable
---------------

Si vous êtes sous Windows, pensez à défragmentez votre disque à l'aide du défragmenteur intégré
(Démarrer > Tous les programmes > Accessoires > Outils Système > Défragmenteur de disque)
si vous comptez toucher à la partition de Windows. Windows, quand même...

Sous Ubuntu, utiliser gparted.

Installation d'Ubuntu 14.04 LTS
-------------------------------

### Création d'une clé USB-Live

1) Téléchargez l'[image ISO](https://ubuntu-fr.org/telechargement) (1 Go, environ 40 minutes à un débit de 25 Mo/min).

2) Préparer un clé avec un 1 Go d'espace libre. Si la clé contient des fichiers, mettez-les dans un dossier Files :
```bash
mkdir Files
mv -R * Files
```

3) Gravez l'image sur la clé :
- Sous Windows
  [www.linuxliveusb.com](http://www.linuxliveusb.com/) (déconseillé ?)
  [Rufus](http://rufus.akeo.ie/?locale=fr_FR/)
- Sous Ubuntu
  Grâce à l'excellent [USB Creator](www.linuxliveusb.com) intégré par défaut.
  Pour cela recherchez" à partir du Dash "USB" et ouvrez le "Créateur de disque de démarrage".
  Sélectionnez votre image et votre clé.

### Installation du système d'exploitation

Interromptez le démarrage normal et bootez à partir de votre clé, en lecteure seule. Suivez la procédure d'installation.
Assurez-vous d'effectuer l'installation branché sur secteur (si vous êtes sur portable) et rélié à Internet.

Pour le partitionnement, si ce n'est déjà fait, préférez le partitionnement manuel, réduisez celle de votre OS actuel et
créez une partition réservé à Ubuntu. Le système fait 6.5 Go, la configuration minimale est de 8 Go, celle recommandée de 15 Go.
Préférez une partition primaire si vous n'en avez rien à faire de pouvoir ajouter des partitions à l'avenir, choisissez un système
ext4 sauf si vous détestez l'utilisateur de cet ordi.
N'oubliez pas d'y indiquer le point de montage root du système de fichiers, inscrivez-y `/`.
Créez enfin la partition "swap" (extension dure de la mémoire vive), réservez-y 1 Go, ou si comme moi vous avez tellement de mémoire
que vous ne savez pas quoi en foutre, pourquoi pas 2 Go, même si c'est probablement inutile. ;)

Continuez la procédure, préférez un nom d'ordi et d'utilisateur court (2 lettres c'est bien, pour moi zz@pc).

Astuce : La langue d'installation demandée au début déterminera la configuration linguistique du système installé. Si vous ne
voulez pas avoir à la changer par la suite, n'ayez pas la flemme de la préciser correctement ! (je me suis fait avoir comme ça ^^)

Paramètrage du système
----------------------

Jetez tout d'abord un oeil à tous les paramètres proposés dans les "Paramètres système", notamment :
### Personnel
- Apparence :
	Aspect
		Thème : Radiance
		Taille des icônes du launcher : 44
	Comportement
		Launcher :
			Rétractabilité
			Sensibilité maximum
		Activer les espaces de travail
		Menus des fenêtres dans la barre de menu
- Luminosité & verrouillage :
	Diminuer la luminosité pour économiser la batterie
	Éteindre l'écran au bout de 5 minutes d'inactivité
	Verrouillage de l'écran après extinction
	Protéger au déverrouillage avec un mot de passe
- Sécurité et vie privée
	Sécurité
		Demander le mot de passe en sortant de veille
	Fichiers & Applications
		Enregistrer l'utilisation des documents uniquement
### Matériel
- Affichage :
	Lanceur sur l'écran intégré uniquement
	Bords non collants
- Couleur :
	À voir pour les imprimantes
- Énergie
	Mettre en veille après 10 minutes d'inactivité sur batterie, 20 sur secteur
	Mettre en veille lorsque l'écran est refermé
	Afficher tout le temps la batterie
- Souris
	Vitesse du pointeur : rapide
	Pavé tactile :
		Vitesse du pointeur : maximale
		Désactiver lors de la frappe, taper pour cliquer, défilement à deux doigts
### Système
- Comptes utilisateur :
	Connexion automatique : off
	Narcissisme maximal
- Date et heure
	Heure et date (^^)
		Depuis Internet
	Horloge
		Afficher dans la barre de menu
		Date et mois, sur 24 heures
		Calendrier mensuel, inclure les numéros de la semaine
- Logiciels & MAJ
	Mises à jour
		Vérifier tous les jours, afficher immédiatement toutes les MAJ

Il est nécessaire de procéder à un paramètrage complémentaire avec [Ubuntu Tweak](https://doc.ubuntu-fr.org/ubuntu_tweak) :
```bash
sudo add-apt-repository ppa:tualatrix/ppa
sudo apt-get update
sudo apt-get install ubuntu-tweak
```
! Attention, non mis à jour depuis 14.0.

Pour obtenir Ubuntu Tweak sous Ubuntu 16.0, j'ai procédé [comme proposé sur le forum](http://forum.ubuntu-fr.org/viewtopic.php?pid=21501324#p21501324).

À regarder en détail, et notamment :
### Ajustements
- Réglages de l'écran de connexion :
	Désactiver le compte invité
	Désactiver le son à la connexion
- Espace de travail :
	Vertical : 1
- Gestionnaire de fichiers :
	Afficher l'emplacement au lieu de la barre de chemin
### Administration
- Scripts :
	Ouvrir et parcourir en sudo
	Copier et déplacer vers...
	Créer un lanceur
	Définir une image en tant que fond d'écran
	Convertir en PNG

Paramétrez ensuite la console (Édition > Préférences du profil) :
Général
	Forme du curseur : Barre verticale

Enfin, paramètrez Nautilus car il en a grand besoin (Édition > Préférences) :
Vues
	Afficher en liste
	Trier les dossiers avant les fichiers
	Afficher les fichiers cachés et de backups
	Niveau de zoom :
		Vue en icône : 66%
		_	en liste : 33%
Comportement
	Simple clic pour ouvrir
	Demander de lancer ou d'afficher les exécutables
	Demander avant de supprimer (définitivement) des fichiers
Affichage
	Naviguer dans un arbre de dossiers
Colonnes
	Uniquement dernière modification

Téléchargement de vos logiciels préférés
----------------------------------------

Bien entendu, jetez-vous sur [Chrome](https://www.google.fr/chrome/browser/desktop/).

Par la logithèque :
- git
- gimp
- inkscape
- dia
- opera
- filezilla
- gcolor2
- geogebra

Par des dépôts externes :
- [Sublime Text](https://www.sublimetext.com/)
- [Skype](http://www.skype.com/fr/download-skype/skype-for-computer/)

Installation du serveur web
---------------------------

Environnement [LAMP](https://doc.ubuntu-fr.org/lamp) + [phpMyAdmin](https://doc.ubuntu-fr.org/phpmyadmin)
```bash
sudo apt-get -y install apache2 php7.0 libapache2-mod-php7.0 mysql-server mysql-client php7.0-mysql php7.0-mcrypt php7.0-intl phpmyadmin
```

Pour php7.0, j'ai suivi ce [bon tutoriel](https://www.howtoforge.com/tutorial/install-apache-with-php-and-mysql-on-ubuntu-16-04-lamp/).

### Changer le répertoire web

1) Créer le lien
```bash
sudo ln -s ~/localweb /var/www/localweb
```

2) Accorder les droits nécessaires à l'ensemble du répertoire web et *au dossier `localweb` lui-même !*
```bash
chmod +rwX ~/localweb -R
```

3) Modifier la racine web dans la configuration d'Apache
```bash
sudo gedit /etc/apache2/sites-available/000-default.conf
```
ou [directement](http://www.cyberciti.biz/faq/unix-linux-replace-string-words-in-many-files/) :
```bash
sudo sed -i "s/html/localweb/g" /etc/apache2/sites-available/000-default.conf
```

### Régler l'avertissement lors du fameux `apache start` :
```plain
Could not reliably determine the server's fully qualified domain name?
```
Éditer apache2.conf :
```bash
echo "ServerName localhost" | sudo tee -a /etc/apache2/apache2.conf
```

### Régler tous les problèmes par défaut de phpMyAdmin (^^)

1) Activer l'extension mcrypt
```bash
php5enmod mcrypt
```

La solution des deux problèmes suivants ont été trouvés dans [ce fabuleux post](http://tuxette.nathalievilla.org/?p=130).

2) "La connexion au "controluser" tel que défini dans votre configuration a échoué."
```bash
sudo dpkg-reconfigure phpmyadmin
```

3) "Erreur : Certaines fonctionnalités ayant trait aux tables reliées sont désactivées. Pour une analyse du problème, cliquez ici."
Exécuter ce [fichier](http://tuxettechix.free.fr/docs/sql/create_table.sql) pour créer les bases nécessaires.

Derniers réglages
-----------------

### Installer Composer

Comme [décrit dans la doc](https://getcomposer.org/download/) :
```bash
php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/home/zz/bin
```
N'oubliez pas d'inscrire votre répertoire bin personnel dans la variable PATH (`sudo gedit /etc/environment` ou un `.bash_path`).

### Autoriser l'utilisation de la variable PATH avec `sudo`

Éditez le fichier /etc/sudoers :
```bash
sudo visudo
```

Trouvez la ligne :
```plain
Defaults      secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
```
À remplacer par :
```plain
Defaults       !secure_path
# Defaults      secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
```

Voilà !

Il ne vous reste plus qu'à importer tous vos fichiers (Documents, localweb, bin, .bashrc, .bash_aliases, .config, .composer,
.gitconfig, etc.) et let's go!
