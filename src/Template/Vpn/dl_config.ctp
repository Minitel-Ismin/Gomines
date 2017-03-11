<?php
$this->layout = "vpn_config";
$cn = strtolower($user['prenom'].".".$user['nom']);
$this->assign('filename', $cn);
?>
client
remote-cert-tls server
tls-client
dev tun
remote 192.168.163.11 1194 udp
resolv-retry infinite
nobind
persist-key
persist-tun
comp-lzo
verb 2
explicit-exit-notify 3
<ca>
<?= $ca; ?>
</ca>
<cert>
<?= $user['vpn_compte']['cert']; ?>
</cert>
<key>
<?= $user['vpn_compte']['pkey']; ?>
</key>
