<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vpn Compte'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vpn Historique'), ['controller' => 'VpnHistorique', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vpn Historique'), ['controller' => 'VpnHistorique', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vpnComptes index large-9 medium-8 columns content">
    <h3><?= __('Vpn Comptes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('bp_used') ?></th>
                <th><?= $this->Paginator->sort('actif') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vpnComptes as $vpnCompte): ?>
            <tr>
                <td><?= $this->Number->format($vpnCompte->id) ?></td>
                <td><?= $vpnCompte->has('user') ? $this->Html->link($vpnCompte->user->id, ['controller' => 'Users', 'action' => 'view', $vpnCompte->user->id]) : '' ?></td>
                <td><?= $this->Number->format($vpnCompte->bp_used) ?></td>
                <td><?= h($vpnCompte->actif) ?></td>
                <td class="actions">
                	<div class="btn-group">
	                    <?= $this->Html->link(__('View'), ['action' => 'view', $vpnCompte->id], ["class" => "btn btn-default"]) ?>
	                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vpnCompte->id], ["class" => "btn btn-default"]) ?>
	                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vpnCompte->id], ["class" => "btn btn-default", 'confirm' => __('Are you sure you want to delete # {0}?', $vpnCompte->id)]) ?>
                	</div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
