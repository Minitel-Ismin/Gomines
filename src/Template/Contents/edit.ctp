<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-6">
            <h1><?= __('Valider le contenu') ?></h1>
            <?= $this->Form->create($content) ?>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">Nom</span>
                <?php
                echo $this->Form->input('name', ['label' => false, 'div' => false, 'class' => 'input-size-fixed form-control title']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">path</span>
                <?php
                echo $this->Form->input('path', ['label' => false, 'div' => false, 'class' => 'input-size-fixed form-control code']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">taille</span>
                <?php
                echo $this->Form->input('size', ['label' => false, 'div' => false, 'class' => 'form-control input-size-fixed']);
                ?>
            </div><br>
            <div class="input-group">
            <span class="input-group-addon addon-size-fixed">A verifier?</span>
            <?php
            echo $this->Form->checkbox('to_verify', ['hiddenField' => false,'label' => false, 'div' => false, 'class' => 'form-control input-size-fixed']);?>
            </div><br>
            <?= $this->Form->button(__('Enregistrer'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>