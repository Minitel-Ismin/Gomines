<div class="container-fluid">
	<div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-6">
			<h1><?= __('Créer un thème') ?></h1>
            <?= $this->Form->create($ticketTheme)?>
            <div class="input-group">
				<span class="input-group-addon addon-size-fixed">Nom</span>
                <?php
																echo $this->Form->input ( 'name', [ 
																		'label' => false,
																		'div' => false,
																		'class' => 'input-size-fixed form-control title' 
																] );
																?>
            </div>
			
			
			<br>
            <?= $this->Form->button(__('Enregistrer'), ['class' => 'btn btn-primary'])?>
            <?= $this->Form->end()?>
        </div>
	</div>
</div>
