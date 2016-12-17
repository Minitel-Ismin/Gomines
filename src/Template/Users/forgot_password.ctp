<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Mot de passe oublié</h1>
        <?= $this->Form->create() ?>
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Email</span>
             <?= $this->Form->input('email', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>
        <?= $this->Form->button('Envoyer', ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>