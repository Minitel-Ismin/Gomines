<?php
$title = "Services";
?>
<div id="mainContent">
	<div class="whole">
		<div class="type vpn">
			<p>VPN</p>
		</div>
		<div class="plan">
			<div class="header">
				<?= $this->Html->link($this->Html->image("/img/vpn.png"),['controller' => 'Vpn'], ['escape' => false]); ?>
			</div>
		</div>
	</div>
	<div class="whole">
		<div class="type upload">
			<p>Upload</p>
		</div>
		<div class="plan">
			<div class="header">
				<?= $this->Html->link($this->Html->image("/img/upload.png"),['controller' => 'Upload'], ['escape' => false]); ?>
			</div>
		</div>
	</div>
	<div class="whole">
		<div class="type admin">
			<p>Administration</p>
		</div>
		<div class="plan">
			<div class="header">
				<?= $this->Html->link($this->Html->image("/img/g.png"),['controller' => 'users'], ['escape' => false]); ?>
			</div>
		</div>
	</div>
</div>