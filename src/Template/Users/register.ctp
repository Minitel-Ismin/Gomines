<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>S'inscrire</h1>
        <?= $this->Form->create() ?>
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Nom</span>
             <?= $this->Form->input('nom', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Prénom</span>
             <?= $this->Form->input('prenom', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>
        
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Email</span>
             <?= $this->Form->input('email', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>
        
        <div class="input-group">
             <span class="input-group-addon addon-size-fixed">Password</span>
             <?= $this->Form->input('password', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
        </div><br>

        <?= $this->Form->button('Login', ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>