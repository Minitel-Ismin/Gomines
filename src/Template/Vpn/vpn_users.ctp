<?= $this->element('datatable') ?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-8">
                <h3 class="text-center">Utilisateurs VPN</h3>
                <table class="table table-striped" id="Table">
                	<thead>
	                <tr>
		                <th>Prénom</th>
		                <th>Nom</th>
		                <th>BP Totale</th>
		                <th>BP Journée</th>
		                <th>Action</th>
	                </tr>
	                </thead>
	                <?php foreach($user as $u): ?>
	                    <tr>
	                        <td><?= $u['user']['prenom'] ?></td>
	                        <td><?= $u['user']['nom'] ?></td>
	                        <td><?= $u['bp'] ?></td>
	                        <td><?= $u['bp_day'] ?></td>
	                        
	                        <td>
	                            <div class="btn-group">
	                            <?= $this->Html->link("Reset",['controller' => 'vpn', 'action' => 'vpnResetBW', $u['user']['id']], ["class" => "btn btn-default"]) ?>
	                            </div>
	                        </td>
	                    </tr>
	                <?php endforeach; ?>
                </table>
        </div>
    </div>
</div>