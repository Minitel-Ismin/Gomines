<?php
$activerLienCSS = array();
$genererLienCSS = array();
if(!empty($user['vpn_compte']) & $user['vpn_compte']['actif'] == 1)
	$activerLienCSS = ['onclick' => 'return false', 'class' => 'desactive'];
else
	$genererLienCSS = ['onclick' => 'return false', 'class' => 'desactive'];
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Html->link(__('Activer le VPN'), ['controller' => 'vpn', 'action' => 'activateVPN', $user->id],$activerLienCSS) ?> </li>
        <li><?= $this->Html->link(__('Générer configuration VPN'), ['controller' => 'vpn', 'action' => 'generateVPN', $user->id],$genererLienCSS) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('Retour'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->email) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nom') ?></th>
            <td><?= h($user->nom) ?></td>
        </tr>
        <tr>
            <th><?= __('Prenom') ?></th>
            <td><?= h($user->prenom) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
</div>
