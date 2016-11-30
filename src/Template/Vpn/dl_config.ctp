<?php
$this->layout = "vpn_config";
$cn = strtolower($user['prenom'].".".$user['nom']);
$this->assign('filename', $cn);
?>
client
remote-cert-tls server
tls-client
dev tun
#remote 172.17.0.11 443 tcp-client
remote 172.17.0.11 1194 udp
redirect-gateway def1
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
