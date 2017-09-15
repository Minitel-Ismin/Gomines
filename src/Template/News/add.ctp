<div class="container-fluid">
	<div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-6">
			<h1><?= __('Créer une news') ?></h1>
            <?= $this->Form->create($news)?>
            <div class="input-group">
				<span class="input-group-addon addon-size-fixed">Titre</span>
                <?php
                    echo $this->Form->input ( 'title', [ 
                            'label' => false,
                            'div' => false,
                            'class' => 'input-size-fixed form-control title' 
                    ] );
                ?>
            </div>
			<br>
            <span class="input-group-addon addon-size-fixed">Texte de la news</span>
			<div class="input-group">
				
                <?php
                echo $this->Form->textarea ( 'text', [ 
                        'label' => false,
                        'div' => false,
                        'class' => 'input-size-fixed form-control code' 
                ] );
                ?>
            </div>
			<br>
            <?= $this->Form->button(__('Enregistrer'), ['class' => 'btn btn-primary'])?>
            <?= $this->Form->end()?>
        </div>
	</div>
</div>
