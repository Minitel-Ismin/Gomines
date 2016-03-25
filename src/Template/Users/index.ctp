<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Users') ?></h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('nom') ?></th>
                        <th><?= $this->Paginator->sort('prenom') ?></th>
        				<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Html->link(h($user->nom), ['action' => 'edit', $user->id]) ?></td>
                        <td><?= $this->Html->link(h($user->prenom), ['action' => 'edit', $user->id]) ?></td>
                        <td><?= $this->Html->link(__("Voir"), ['action' => 'edit', $user->id]) ?></td>
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
    </div>
</div>