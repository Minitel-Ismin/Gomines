<div class="container">
    <div class="row">
		<?= $this->element('AdminMenu'); ?>
		<div class="col-lg-9 col-md-8 column content">
			<h1>Détection de serveurs DHCP</h1>
			<p>La détection de serveurs DHCP sur le réseau fonctionne en écoutant le réseau sur le port 67 en udp (<code>tcpdump -n -e udp port 67</code>) tout en réalisant une requête DHCP grâce à nmap (<code>nmap --script broadcast-dhcp-discover</code>).</p>
			<?php
			echo $this->Form->create();
			echo $this->Form->button(((isset($dhcp)) ? "Re-" : "")."Détecter les serveurs DHCP", ["class" => 'btn btn-primary']);
			echo $this->Form->end();
			if(isset($dhcp)){
				?>
				<table class="table">
					<tr>
						<th>Commande</th>
						<th>Adresse MAC</th>
						<th>Adresse IP</th>
					</tr>
					<?php
					foreach($dhcp as $d):
						?>
						<tr>
							<td><?= $d["Command"] ?></td>
							<td><?= $d["MAC"] ?></td>
							<td><?= $d["IP"] ?></td>
						</tr>
						<?php
					endforeach;
					?>
				</table>
				<?php
			}
			?>
		</div>
    </div>
</div>