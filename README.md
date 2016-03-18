# Gomines Interface

## To-Do
- Merge the upload script with the overall project (Actually has its own fonts, css, js deps...)
- Review DownloadsController->files()
- Add possibility to download a whole folder at once
- Add integration with LDAP for accounting
- Add possibility to "Upload There"
- Add development status + suggest area
- Add VPN bandwidth almost exhausted notification
- Add VPN pending requests
- Add VPN credited account
- Add VPN reset accounts
- Add change password

## Install
- git pull
- composer install (or if you do not have composer : php composer.phar install)
- copy config/app.default.php to config/app.php and set the project
- then init the database