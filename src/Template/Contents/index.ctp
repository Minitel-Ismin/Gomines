<?= $this->Html->css('jquery.dataTables') ?>

<?= $this->Html->script('jquery.min'); ?>
<?= $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#Table').DataTable({
			serverSide: true,
		    ajax: {
		        url: '/contents/data-source',
		        type: 'POST'
		    },
	    	"language": {
                "url": "/js/french.json"
            },
            "columns": [
	                    { "data": "name" },
	                    { "data": function(row){ return row.d_l_category.name}},
	                    { "data": "size" },
	                    { "data": function(row){
								var verify = '<span class="glyphicon glyphicon-';
								if(row.to_verify){
									verify += 'ok';
								}else{
									verify+='remove';
								}
								verify += '"></td>';
								return verify;
		                    }
                    		
	                    },
	                    { "data": function( row){
	                    	var actions = '<div class="btn-group"><a href="/contents/view/'+row.id+'" class="btn btn-default">Voir</a><form name="azertyuiop'+row.id+'" style="display:none;" method="post" action="/contents/delete/'+row.id+'"><input type="hidden" name="_method" value="POST"></form><a href="#" class="btn btn-default" onclick="if (confirm(&quot;\u00eates vous s\u00fbr? # '+row.id+'?&quot;)) { document.azertyuiop'+row.id+'.submit(); } event.returnValue = false; return false;">Supprimer</a></div></td>';
							return actions;
	                    }}
	                 
	                ]
	    });
	});
</script>
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
                
                    <?php /*foreach ($contents as $cont): ?>
                    <tr>
                        <td><?= $cont->name ?></td>
                        <td><?= $cont->d_l_category->name ?></td>
                        <td><?= $cont->size	 ?></td>
						<td><span class="glyphicon glyphicon-<?php echo ($cont->to_verify)? 'remove':'ok'; ?>"></td>
                        
                        
                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link(__("Voir"), ['action' => 'edit', $cont->id], ["class" => "btn btn-default"]) ?> 
                            	<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $cont->id], [ "class" => "btn btn-default" , 'confirm' => __('êtes vous sûr? # {0}?', $cont->id)]) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;*/ ?>
            </table>
            
        </div>
    </div>
</div>