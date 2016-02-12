<div class="container">
	<?= $this->Html->link("Retour", ["controller" => "Downloads","action" => "display"]); ?>
	<ul>
	<li class="files dir return"><?= $this->Html->link("Dossier Parent", ["action" => "files", $vpath, "../"]); ?></li>
	<?php
	foreach($files[0] as $d):
		?>
	<li class="files dir"><?= $this->Html->link($d, ["action" => "files", $vpath, $d]); ?></li>
	<?php
	endforeach;
	foreach($files[1] as $f):
		?>
	<li class="files"><?= $this->Html->link($f, ["action" => "files", $vpath, $f]); ?></li>
	<?php
	endforeach;
	?>
	</ul>
</div>
