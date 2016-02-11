<?php
header('Content-Type: application/ovpn');
header("Content-disposition: attachment; filename=\"" . $this->fetch('filename') . ".ovpn\""); 
echo $this->fetch('content');
?>