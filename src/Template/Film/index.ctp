<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Films') ?></h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('size') ?></th>
        				<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($film as $f): ?>
                    <tr>
                        <td><?= $f->title ?></td>
                        <td><?=$f->size ?></td>
                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link(__("Voir"), ['action' => 'edit', $f->id], ["class" => "btn btn-default"]) ?> 
                            <?= $this->Html->link(__("Supprimer"), ['action' => 'delete', $f->id], ["class" => "btn btn-default"]) ?>
                            </div>
                        </td>
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