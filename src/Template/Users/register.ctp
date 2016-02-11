<div class="col-md-4 col-md-offset-4">
	<h1>S'inscrire</h1>
	<?= $this->Form->create() ?>
	<?= $this->Form->input('nom') ?>
	<?= $this->Form->input('prenom') ?>
	<?= $this->Form->input('email') ?>
	<?= $this->Form->input('password') ?>
	<?= $this->Form->button('Login') ?>
	<?= $this->Form->end() ?>
</div>