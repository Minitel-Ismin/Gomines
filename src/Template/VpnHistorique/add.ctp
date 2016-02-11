<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vpn Historique'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vpn Comptes'), ['controller' => 'VpnComptes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vpn Compte'), ['controller' => 'VpnComptes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vpnHistorique form large-9 medium-8 columns content">
    <?= $this->Form->create($vpnHistorique) ?>
    <fieldset>
        <legend><?= __('Add Vpn Historique') ?></legend>
        <?php
            echo $this->Form->input('time');
            echo $this->Form->input('action');
            echo $this->Form->input('real_ip');
            echo $this->Form->input('vpn_compte_id', ['options' => $vpnComptes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
