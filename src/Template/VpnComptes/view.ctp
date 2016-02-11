<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vpn Compte'), ['action' => 'edit', $vpnCompte->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vpn Compte'), ['action' => 'delete', $vpnCompte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vpnCompte->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vpn Comptes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vpn Compte'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vpn Historique'), ['controller' => 'VpnHistorique', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vpn Historique'), ['controller' => 'VpnHistorique', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vpnComptes view large-9 medium-8 columns content">
    <h3><?= h($vpnCompte->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $vpnCompte->has('user') ? $this->Html->link($vpnCompte->user->id, ['controller' => 'Users', 'action' => 'view', $vpnCompte->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($vpnCompte->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Bp Used') ?></th>
            <td><?= $this->Number->format($vpnCompte->bp_used) ?></td>
        </tr>
        <tr>
            <th><?= __('Actif') ?></th>
            <td><?= $vpnCompte->actif ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Vpn Historique') ?></h4>
        <?php if (!empty($vpnCompte->vpn_historique)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Time') ?></th>
                <th><?= __('Action') ?></th>
                <th><?= __('Real Ip') ?></th>
                <th><?= __('Vpn Compte Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vpnCompte->vpn_historique as $vpnHistorique): ?>
            <tr>
                <td><?= h($vpnHistorique->id) ?></td>
                <td><?= h($vpnHistorique->time) ?></td>
                <td><?= h($vpnHistorique->action) ?></td>
                <td><?= h($vpnHistorique->real_ip) ?></td>
                <td><?= h($vpnHistorique->vpn_compte_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VpnHistorique', 'action' => 'view', $vpnHistorique->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'VpnHistorique', 'action' => 'edit', $vpnHistorique->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VpnHistorique', 'action' => 'delete', $vpnHistorique->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vpnHistorique->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
