<?= 

$this->start('footerscript');
//$this->Html->script("jquery.min.js"); 
?>
<script type="text/javascript">
	$(".allocine_check").click(function(){
		var film_name = $("input.code").val();
		$.ajax({
			method: "POST",
			url: "<?php  echo $this->Url->build(['controller' => 'Film','action' => 'filminfo']);?>",
			data: { title:film_name},
			success: function(data){
				$("div.allocine_btn").children().remove();
				$("div.allocine_btn").append('<div class="alert alert-success lert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Les info du film ont été cherchées sur allociné et complétées dans la base de donnée</div>');
			},
		});	
	});

</script>

<?= $this->end();?>

<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-6">
            <h1><?= __('Editer le film') ?></h1>
            <?= $this->Form->create($film) ?>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">Titre</span>
                <?php
                echo $this->Form->input('title', ['label' => false, 'div' => false, 'class' => 'input-size-fixed form-control title']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">Code allocine</span>
                <?php
                echo $this->Form->input('allocine_code', ['label' => false, 'div' => false, 'class' => 'input-size-fixed form-control code']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">Sous-titre</span>
                <?php
                echo $this->Form->input('subtitle', ['label' => false, 'div' => false, 'class' => 'form-control input-size-fixed']);
                ?>
            </div><br>
            <div class="input-group">
                <span class="input-group-addon addon-size-fixed">Langue</span>
                <?php
                echo $this->Form->input('language', ['label' => false, 'div' => false, 'class' => 'form-control input-size-fixed']);
                ?>
            </div><br>
            <div class="input-group">
            <span class="input-group-addon addon-size-fixed">A verifier?</span>
            <?php
            echo $this->Form->checkbox('to_verify', ['hiddenField' => false,'label' => false, 'div' => false, 'class' => 'form-control input-size-fixed']);?>
            </div><br>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class= "col-md-3 allocine_btn">
        	<a class="btn btn-default allocine_check">Revérifier les info sur allo-ciné</a>
        </div>
    </div>
</div>