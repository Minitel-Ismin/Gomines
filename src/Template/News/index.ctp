

<?= $this->Html->css('jquery.dataTables') ?>

<?= $this->Html->script('jquery.min'); ?>
<?= $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#Table').DataTable({
			
	    	"language": {
                "url": "/js/french.json"
            },
            "columns": [
	                    { "data": "Titre" },
	                    { "data": "Redacteur"},
	                    { "data": "Texte" },
	                ]
	    });
	});
</script>


<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9 col-md-4">
            <h2 class="text-center"><?= __('Contenu') ?></h2>
            
            
            <?= $this->Html->link(__('Créer une news'), ['controller' => 'News', 'action' => 'add'], ['class'=>'btn btn-default']) ?> 

            <br>
            <br>    
            <table class="table table-striped" id="Table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Redacteur</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($news as $new): ?>
                        <tr>
                            <td><?= $new->title ?></td>
                            <td><?= $new->user['nom']?> <?= $new->user['prenom']?></td>
                            
                            <td>
                                <div class="btn-group">
                                    <?= $this->Html->link(__("Voir"), ['action' => 'edit', $new->id], ["class" => "btn btn-default"]) ?> 
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $new->id], [ "class" => "btn btn-default" , 'confirm' => __('êtes vous sûr? # {0}?', $new->id)]) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<?php $this->start('footerscript'); ?>

    <?= $this->Html->script('tinymce/tinymce.min.js'); ?>
    <?= $this->Html->script('tinymce/jquery.tinymce.min.js'); ?>
    <script>tinymce.init({ selector:'textarea' });</script>

<?php $this->end(); ?>