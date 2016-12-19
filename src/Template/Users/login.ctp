<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Login</h1>
        <?= $this->Form->create() ?>
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Email</span>
             <?= $this->Form->input('email', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Password</span>
             <?= $this->Form->input('password', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div>
        <?= $this->Html->link('Mot de passe oublié', ['controller'=>'users', 'action'=>'forgotPassword'])?><br>
        <?= $this->Form->checkbox('remember_me') ?> Connexion automatique<br><br>
        <?= $this->Form->button('Login', ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>