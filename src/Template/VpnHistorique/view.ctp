<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vpn Historique'), ['action' => 'edit', $vpnHistorique->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vpn Historique'), ['action' => 'delete', $vpnHistorique->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vpnHistorique->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vpn Historique'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vpn Historique'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vpn Comptes'), ['controller' => 'VpnComptes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vpn Compte'), ['controller' => 'VpnComptes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vpnHistorique view large-9 medium-8 columns content">
    <h3><?= h($vpnHistorique->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($vpnHistorique->action) ?></td>
        </tr>
        <tr>
            <th><?= __('Real Ip') ?></th>
            <td><?= h($vpnHistorique->real_ip) ?></td>
        </tr>
        <tr>
            <th><?= __('Vpn Compte') ?></th>
            <td><?= $vpnHistorique->has('vpn_compte') ? $this->Html->link($vpnHistorique->vpn_compte->id, ['controller' => 'VpnComptes', 'action' => 'view', $vpnHistorique->vpn_compte->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($vpnHistorique->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Time') ?></th>
            <td><?= $this->Number->format($vpnHistorique->time) ?></td>
        </tr>
    </table>
</div>
