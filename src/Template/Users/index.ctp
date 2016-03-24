<div class="container">
    <h2 class="text-center"><?= __('Users') ?></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('nom') ?></th>
                <th><?= $this->Paginator->sort('prenom') ?></th>
				<th>Actif</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Html->link(h($user->nom), ['action' => 'view', $user->id]) ?></td>
                <td><?= $this->Html->link(h($user->prenom), ['action' => 'view', $user->id]) ?></td>
                <td><?= ($user->droits > 0) ? __("Actif") : $this->Html->link(__("Activer"), ['action' => 'activate', $user->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
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
