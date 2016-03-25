<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-8">

                <h3 class="text-center">Utilisateurs VPN</h3>
                <div class="paginator text-center">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>
            
                <table class="table table-striped">
                <tr>
                <th><?= $this->Paginator->sort('Users.prenom','Prénom') ?></th>
                <th><?= $this->Paginator->sort('Users.nom','Nom') ?></th>
                <th><?= $this->Paginator->sort('VpnComptes.bp_used', 'BP Totale') ?></th>
                <th><?= $this->Paginator->sort('VpnComptes.bp_used_day', 'BP Journée') ?></th>
                <th>Action</th>
                </tr>
                <?php foreach($user as $u): ?>
                    <tr>
                        <td><?= $u['user']['prenom'] ?></td>
                        <td><?= $u['user']['nom'] ?></td>
                        <td><?= $u['bp'] ?></td>
                        <td><?= $u['bp_day'] ?></td>
                        <td><?= $this->Html->link("Reset",['controller' => 'vpn', 'action' => 'vpnResetBW', $u['user']['id']]) ?></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            
                <div class="paginator text-center">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>

        </div>
    </div>
</div>