<?= $this->Html->css('jquery.dataTables') ?>

<?= $this->Html->script('jquery.min'); ?>
<?= $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#Table').DataTable({
	    	"language": {
                "url": "/js/french.json"
            },
            "order": [[ 1, "desc" ]]
	    });
	});
</script>

<div class="bg"></div>
<div class="container files-container">

    <div class="row">
        <div class="col-lg-12 path">
            
            	<?php  
            		echo '<ol class="breadcrumb">';
					
            		echo '<li>'.$this->Html->link("Accueil", ["action" => "display"]).'</li>';
            		echo '<li>'.$this->Html->link($virtFolder, ['controller'=>'Downloads', 'action'=>'files2', $virtFolder]).'</li>';
//            			echo '<li>'.$this->Html->link("Accueil/".$virtFolder."/".$subFolder, '#').'</li>';
	           		$subFolders = preg_split("#/#",$subFolder);
	           		$curVirtFolder = $virtFolder;
	           		foreach ($subFolders as $key => $subFold){
	           			if($key == count($subFolders)-1){
	           				echo '<li class="active">'.$subFold.'</li>';
	           			}else{
	           				$curVirtFolder = $curVirtFolder."/".$subFold;
	           				echo '<li>'.$this->Html->link($subFold, ['controller'=>'Downloads', 'action'=>'files2', $curVirtFolder]).'</li>';
	           			}
	           		}
	            ?>
        </div>
    </div>
    	<?php /*
	    <div class="row">
	        <div class="col-lg-12">
	            <?= $this->Html->link("Telecharger ce dossier", ['controller'=>'Downloads', 'action'=>'dlFolder', $curVirtFolder], ['class' => 'btn btn-primary']) ?>
	        </div>
	    </div>*/ ?>
	
	<div class="row">
		<table class="table table-striped" id="Table">
			<thead>
	            <tr>
		            <th>Nom</th>
		            <th>Ajouté le</th>
	            </tr>
            </thead>
			<tbody>
                <?php foreach ($content as $c): ?>
                	<tr>
                		<td>
		                	<?php if($c->sub_folder):?>
		                		<span class="glyphicon glyphicon-folder-open"></span>
		                		<?= $this->Html->link($c->name, ['controller'=>'Downloads', 'action'=>'files2', $virtFolder."/".$subFolder."/".$c->name
		                		]) ?> 
			                  	
		                	<?php else:?>
		                   
		                    	<?php $icon = $this->File->makeIcon($c->name);?>
		                    	<?php echo '<span class="fa fa-file'.$icon['type'].'-o" style="color: '.$icon['color'].'"></span>'; ?>
		                        	
		                  		<?= $this->Html->link($c->name, ['controller' => 'Downloads', 'action' => 'dlFile', $c->id]) ?> 
			                  	
		                  	<?php endif;?>
	                  	</td>
	                  	<td>
	                  		<?= $c->modified ?>
	                  	</td>
	                  </tr>
                <?php endforeach; ?>
        	</tbody>
		</table>
		
	</div>
</div>
