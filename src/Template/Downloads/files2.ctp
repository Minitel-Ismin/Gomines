<div class="bg"></div>
<div class="container files-container">

    <div class="row">
        <div class="col-lg-12 path">
            
            	<?php  
            		echo '<ol class="breadcrumb">';

           			echo '<li>'.$this->Html->link("Accueil/".$virtFolder."/".$subFolder, '#').'</li>';
	           		/*foreach($folders as $folder):
		           		if($folder == $folders[count($folders)-1])
		                    echo '<li class="active">'.$folder.'</li>';
		                else
		                    echo '<li>'.$this->Html->link($folders, "#").'</li>';
	                endforeach;*/
	            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->Html->link("Telecharger ce dossier", '#', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

	<div class="row">
		

			<ul>
                <?php foreach ($content as $c): ?>
                 	<li class="files">
	                	<?php if($c->sub_folder):?>
	                		<span class="glyphicon glyphicon-folder-open"></span>
	                		<?= $this->Html->link($c->name, ['controller'=>'Downloads', 'action'=>'files2', $virtFolder."/".$subFolder."/".$c->name
	                		]) ?> 
		                  	
	                	<?php else:?>
		                   
		                    	<?php $icon = $this->File->makeIcon($c->name);?>
		                    	<?php echo '<span class="fa fa-file'.$icon['type'].'-o" style="color: '.$icon['color'].'"></span>'; ?>
		                        	
		                  			<?= $this->Html->link($c->name, ['controller' => 'Downloads', 'action' => 'dlFile', $c->id]) ?> 
		                  	
	                  	<?php endif;?>
                  	</li>
                <?php endforeach; ?>
			</ul>
		
	</div>
</div>
