<?= $this->element('datatable') ?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Users') ?></h2>
            <table class="table table-striped" id="Table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
        				<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Html->link(h($user->nom), ['action' => 'edit', $user->id]) ?></td>
                        <td><?= $this->Html->link(h($user->prenom), ['action' => 'edit', $user->id]) ?></td>
                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link(__("Voir"), ['action' => 'edit', $user->id], ["class" => "btn btn-default"]) ?> 
								<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ["class" => "btn btn-default" ,'confirm' => __('êtes vous sûr? # {0}?', $user->id)]) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

