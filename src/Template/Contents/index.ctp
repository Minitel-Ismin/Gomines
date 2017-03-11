<?= $this->element('datatable') ?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Contenu') ?></h2>
            <br>
            <table class="table table-striped" id="Table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Taille</th>
                        <th>à vérifier?</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contents as $cont): ?>
                    <tr>
                        <td><?= $cont->name ?></td>
                        <td><?= $cont->d_l_category->name ?></td>
                        <td><?= $cont->size	 ?></td>
						<td><span class="glyphicon glyphicon-<?php echo ($cont->to_verify)? 'remove':'ok'; ?>"></td>
                        
                        
                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link(__("Voir"), ['action' => 'edit', $cont->id], ["class" => "btn btn-default"]) ?> 
                            	<?= $this->Html->link(__("Supprimer"), ['action' => 'delete', $cont->id], ["class" => "btn btn-default"]) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>