<div class="col-md-4 col-md-offset-4">
	<h1>Login</h1>
	<?= $this->Form->create() ?>
	<?= $this->Form->input('email') ?>
	<?= $this->Form->input('password') ?>
	<?= $this->Form->checkbox('remember_me') ?> Connexion automatique<br/>
	<?= $this->Form->button('Login') ?>
	<?= $this->Form->end() ?>
</div>
