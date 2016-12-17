<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Choisir un nouveau mot de passe</h1>
        <?= $this->Form->create() ?>
		<input type="hidden" name="reset_password_token" value=<?= $reset_password_token ?>>
        
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Password</span>
             <?= $this->Form->input('password', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>

        <?= $this->Form->button('Modifier', ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>