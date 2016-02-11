<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vpn Historique'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vpn Comptes'), ['controller' => 'VpnComptes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vpn Compte'), ['controller' => 'VpnComptes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vpnHistorique index large-9 medium-8 columns content">
    <h3><?= __('Vpn Historique') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('time') ?></th>
                <th><?= $this->Paginator->sort('action') ?></th>
                <th><?= $this->Paginator->sort('real_ip') ?></th>
                <th><?= $this->Paginator->sort('vpn_compte_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vpnHistorique as $vpnHistorique): ?>
            <tr>
                <td><?= $this->Number->format($vpnHistorique->id) ?></td>
                <td><?= $this->Number->format($vpnHistorique->time) ?></td>
                <td><?= h($vpnHistorique->action) ?></td>
                <td><?= h($vpnHistorique->real_ip) ?></td>
                <td><?= $vpnHistorique->has('vpn_compte') ? $this->Html->link($vpnHistorique->vpn_compte->id, ['controller' => 'VpnComptes', 'action' => 'view', $vpnHistorique->vpn_compte->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vpnHistorique->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vpnHistorique->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vpnHistorique->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vpnHistorique->id)]) ?>
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
