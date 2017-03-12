<?= $this->element('datatable') ?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Catégories de téléchargements') ?></h2>
            <?= $this->Html->link(__("Ajouter une catégorie"), ['action' => 'add'], ["class" => "btn btn-default", "style"=>"margin-bottom:50px;"]) ?>
            <br>
            <table class="table table-striped" id="Table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Dossiers</th>
                        <th>couleurs</th>
                        <th>icône</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dLCategory as $cat): ?>
                    <tr>
                        <td><?= $cat->name ?></td>
                        <td><?php if(is_array($cat->folders)):?>
                        		<ul>
                        			<?php foreach($cat->folders as $folder): ?>
                        			<li><?php echo $folder->path ;?></li>
                        			<?php endforeach;?>
                        		</ul>
                        <?php else:?>
                        	<?php echo $cat->folders[0];?>
                        <?php endif;?></td>
                        <td><?= $cat->color ?></td>
                        <td><?= $cat->icon ?></td>
                        
                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link(__("Voir"), ['action' => 'edit', $cat->id], ["class" => "btn btn-default"]) ?> 
								<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $cat->id], ['confirm' => __('êtes vous sûr? # {0}?', $cat->id)]) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>