<div class="container-fluid">
	<div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-6">
			<h1><?= __('Créer une news') ?></h1>
            <?= $this->Form->create($news, [ 'novalidate' => true ])?>
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


<?php $this->start('footerscript'); ?>

    <?= $this->Html->script('tinymce/tinymce.min.js'); ?>
    <?= $this->Html->script('tinymce/jquery.tinymce.min.js'); ?>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code jbimages'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages',
            content_css: "/js/tinymce/js/tinymce/themes/modern/custom_content.css",
            theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
            font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
            language: "fr_FR",
            relative_urls: false,	
        });
    
    
    </script>

<?php $this->end(); ?>