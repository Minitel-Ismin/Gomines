<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vpn Comptes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vpn Historique'), ['controller' => 'VpnHistorique', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vpn Historique'), ['controller' => 'VpnHistorique', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vpnComptes form large-9 medium-8 columns content">
    <?= $this->Form->create($vpnCompte) ?>
    <fieldset>
        <legend><?= __('Add Vpn Compte') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('bp_used');
            echo $this->Form->input('actif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
