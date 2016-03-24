# Gomines Interface

## To-Do
- Merge the upload script with the overall project (Actually has its own fonts, css, js deps...)
- Review DownloadsController->files()
- Add possibility to download a whole folder at once
- Add integration with LDAP for accounting
- Add possibility to "Upload There"
- Add development status + suggest area
- Add VPN bandwidth almost exhausted notification
- Add VPN pending requests list
- Add VPN credited account
- Add VPN reset bandwidth limitation account
- Add change password
- Move VPN scripts to CakePHP Shell commands
- Add rights management
- Change administration part
- Add rogue DHCP server detection : tcpdump -r ~/dhcp.pcap -n  -e
- Review parent folder link

## Install
- git pull
- composer install (or if you do not have composer : php composer.phar install)
- copy config/app.default.php to config/app.php and set the project
- then init the database