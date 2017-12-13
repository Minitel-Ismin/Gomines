<?= $this->Html->css('jquery.dataTables')?>

<?= $this->Html->script('jquery.min'); ?>
<?= $this->Html->script('jquery.dataTables'); ?>
<script type="text/javascript">
jQuery.fn.dataTable.ext.type.order['file-size-pre'] = function ( data ) {
    var matches = data.match( /^(\d+(?:\.\d+)?)\s*([a-z]+)/i );
    var multipliers = {
        b:  1,
        bytes: 1,
        kb: 1000,
        kib: 1024,
        mb: 1000000,
        mib: 1048576,
        gb: 1000000000,
        gib: 1073741824,
        tb: 1000000000000,
        tib: 1099511627776,
        pb: 1000000000000000,
        pib: 1125899906842624
    };
 
    if (matches) {
        var multiplier = multipliers[matches[2].toLowerCase()];
        return parseFloat( matches[1] ) * multiplier;
    } else {
        return -1;
    };
};
	$(document).ready(function(){
		var table = $('#Table').DataTable({
	    	"language": {
                "url": "/js/french.json"
            },
            "order": [[ 2, "desc" ]],
            columnDefs: [
                         { type: 'file-size', targets: 1 }
                       ],
                       "pageLength": 25
	    });
	});


</script>

<div class="bg"></div>
<div class="container files-container">

	<div class="row">
		<div class="col-lg-12 path">
            
            	<?php
					echo '<ol class="breadcrumb">';
					
					echo '<li>' . $this->Html->link ( "Accueil", [ 
							"action" => "display" 
					] ) . '</li>';
					echo '<li>' . $this->Html->link ( $virtFolder, [ 
							'controller' => 'Downloads',
							'action' => 'files2',
							$virtFolder 
					] ) . '</li>';
					// echo '<li>'.$this->Html->link("Accueil/".$virtFolder."/".$subFolder, '#').'</li>';
					$subFolders = preg_split ( "#/#", $subFolder );
					$curVirtFolder = $virtFolder;
					foreach ( $subFolders as $key => $subFold ) {
						if ($key == count ( $subFolders ) - 1) {
							echo '<li class="active">' . $subFold . '</li>';
						} else {
							$curVirtFolder = $curVirtFolder . "/" . $subFold;
							echo '<li>' . $this->Html->link ( $subFold, [ 
									'controller' => 'Downloads',
									'action' => 'files2',
									$curVirtFolder 
							] ) . '</li>';
						}
					}
				?>
        </div>
	</div>

	
	<div class="alert alert-warning" role="alert"><b>Important:</b> Si vous ne parvenez pas à lire certains fichiers (Batman vs superman), alien covenant, etc..., merci d'installer la version 3.0 de vlc encore en beta mais qui fonctionne à merveille <a href="https://nightlies.videolan.org/">télécharger vlc</a></div>
	<?php if($endFolder && $subFolders[0]!=''):?>				
		<div class="row">
			<div class="col-lg-12">
				<?= 
					$this->Html->link ( "Télécharger ce dossier", [ 
									'controller' => 'Downloads',
									'action' => 'dlFolder',
									$curVirtFolder 
							], 
					['class' => 'btn btn-primary'] );
					
					?>
			</div>
		</div>
		<br>
	<?php endif; ?>
					 
	<div class="row">
		<table class="table table-striped" id="Table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Taille</th>
					<th>Ajouté le</th>
				</tr>
			</thead>
			<tbody>
                <?php foreach ($content as $c): ?>
                	<tr>
					<td>
		                	<?php if($c->sub_folder):?>
		                		<span class="glyphicon glyphicon-folder-open"></span>
		                		<?=$this->Html->link ( $c->name, [ 'controller' => 'Downloads','action' => 'files2',$virtFolder . "/" . $subFolder . "/" . $c->name ] )?> 
			                  	
		                	<?php else:?>
		                   
		                    	<?php $icon = $this->File->makeIcon($c->name);?>
		                    	<?php echo '<span class="fa fa-file'.$icon['type'].'-o" style="color: '.$icon['color'].'"></span>'; ?>
		                        	
		                  		<?= $this->Html->link($c->name, ['controller' => 'Downloads', 'action' => 'dlFile', $c->id]) ?> 
			                  	
		                  	<?php endif;?>
	                  	</td>
					<td>
	                  		<?= $this->FileSize->convertSize($c->size) ?>
	                  	</td>
					<td>
	                  		<?= $c->modified?>
	                  	</td>
				</tr>
                <?php endforeach; ?>
        	</tbody>
		</table>

	</div>
</div>
