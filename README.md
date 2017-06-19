# Gomines Interface

## To-Do
- Add possibility to download a whole folder at once
- Add integration with LDAP for accounting (suspended)
- Add possibility to "Upload There"
- Add possibility to move & rename folders
- Add VPN bandwidth almost exhausted notification
- Move VPN scripts to CakePHP Shell commands
- Review parent folder link
- Add regex support in file manager
- Add disk space available

## Install
- git pull
- composer install (or if you do not have composer : php composer.phar install)
- copy config/app.default.php to config/app.php and set the project
- then init the database : bin/cake migrations migrate

## Prerequisites
- mysql server
- web server with php at least 5
- [composer](https://getcomposer.org/)

## Authors
* [Mathieu Rousse](https://github.com/m-rousse) ( [mathieu@rousse.me](mathieu@rousse.m) )
* [Thomas Trouchkine](https://github.com/Kerzas) ( [thomas.trouchkine@gmail.com](thomas.trouchkine@gmail.com) )
* [Guillaume ANDRES](https://github.com/Brutia) ( [guillaume.andres@yahoo.fr](guillaume.andres@yahoo.fr) )