<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Retour'), ['controller' => 'vpn', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3>Utilisateurs VPN</h3>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <table>
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
            <td><?= $this->Html->link("Réinitialiser quota journalier","http://www.google.com") ?></td>
    	</tr>
    <?php endforeach; ?>
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
