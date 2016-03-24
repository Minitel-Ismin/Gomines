<div class="container">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-9">
            <h1><?= __('Editer l\'utilisateur') ?></h1>
            <?= $this->Form->create($user) ?>
            <div class="input-group">
                <span class="input-group-addon">Nom</span>
                <?php
                echo $this->Form->input('nom', ['label' => false, 'div' => false, 'class' => 'form-control']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Prénom</span>
                <?php
                echo $this->Form->input('prenom', ['label' => false, 'div' => false, 'class' => 'form-control']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">E-Mail</span>
                <?php
                echo $this->Form->input('email', ['label' => false, 'div' => false, 'class' => 'form-control']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon">Mot de Passe</span>
                <?php
                echo $this->Form->input('password', ['label' => false, 'div' => false, 'class' => 'form-control']);
                ?>
            </div><br>
                <?php
                foreach($droits as $d => $v){
                    echo $this->Form->input($d, ['value'=>$v, 'type' => 'checkbox', 'checked' => $uDroits[$d]]);
                }
            ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>