<div class="container-fluid">
    <div class="row">
		<?= $this->element('AdminMenu'); ?>
		<div class="col-lg-9 col-md-8 column content">
			<h1>Indicateurs</h1>
			<p>Connectés au VPN : <?= $indicateurs['nbVPN'] ?></p>
			<p>Nombre de fichiers en attente : <?= $indicateurs['nbUploads'] ?></p>

			<h1>Demandes de compte</h1>
			<table class="table">
				<tr>
					<th>Utilisateur</th>
					<th>E-Mail</th>
					<th>Action</th>
				</tr>
				<?php foreach($demande as $dc): ?>
					<tr>
						<td><?= $dc->prenom ?> <?= $dc->nom ?></td>
						<td><?= $dc->email ?></td>
						<td><?= $this->Html->link("Activer", ['controller' => 'users', 'action' => 'activate', $dc->id]) ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
			<h1>Demandes de compte VPN</h1>
			<!-- ET AJOUTER LES COMPTES SANS CONFIGURATION -->
			<table class="table">
				<tr>
					<th>Utilisateur</th>
					<th>Activé</th>
					<th>Configuration</th>
					<th>Action</th>
				</tr>
				<?php foreach($demandeVPN as $dv): ?>
					<tr>
						<td><?= $dv->user->prenom ?> <?= $dv->user->nom ?></td>
						<td><?= ($dv->actif) ? "Oui" : "Non" ?></td>
						<td><?= (is_null($dv->cert) or is_null($dv->pkey)) ? "Non" : "Oui" ?></td>
						<td><?= ($dv->actif) ? $this->Html->link("Générer", ['controller' => 'vpn', 'action' => 'generateVPN', $dv->user_id]) : $this->Html->link("Activer", ['controller' => 'vpn', 'action' => 'activateVPN', $dv->user_id]) ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
			<h1>Suggestions</h1>
		</div>
    </div>
</div>