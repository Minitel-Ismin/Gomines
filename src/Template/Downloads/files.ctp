<div class="container">
	<div class="row">
		<?= $this->Html->link("Retour", ["controller" => "Downloads","action" => "display"]); ?>
	</div>
	<div class="row">
		<?php if($readme): ?>
		<div class="col-lg-8">
			<?php endif; ?>
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
		<?php if($readme): ?>
		</div>
		<code class="col-lg-4">
			<?= nl2br($readme) ?>
		</code>
		<?php endif; ?>
	</div>
</div>