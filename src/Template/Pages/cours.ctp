<?php
$title = "Cours";
?>
<div id="mainContent">
	<div class="whole">
		<div class="type annales">
			<p>Annales</p>
		</div>
		<div class="plan">
			<div class="header">
				<?=$this->Html->link($this->Html->image("/img/courses.png"), '/Annales', array('escape' => false)); ?>
			</div>
		</div>
	</div>
	<div class="whole">
		<div class="type moocs">
			<p>MOOCs</p>
		</div>
		<div class="plan">
			<div class="header">
				<?=$this->Html->link($this->Html->image("/img/moocs.png"), '/Moocs', array('escape' => false)); ?>
			</div>
		</div>
	</div>
</div>