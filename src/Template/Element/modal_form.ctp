<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Formulaire de demande</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" accept-charset="utf-8" method="post" action="<?= $this->Url->build(['controller' => 'Ticket','action' => 'add']);?>">
					<?php if($authUser):?>
						<input type="hidden" name="Ticket[user_id]" value="<?= $authUser['id'];?>">
					<?php endif;?>
					<fieldset>


						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="name">Nom &amp; prénom</label>
							<div class="col-md-8">
								<input id="name" name="Ticket[asker]" type="text" placeholder=""
									class="form-control input-md" required="" <?php if($authUser): echo 'value="'.$authUser['nom'].' ' .$authUser['prenom'].'" disabled'; endif; ?>>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-8">
								<input id="email" name="Ticket[email]" type="email" placeholder=""
									class="form-control input-md" required <?php if($authUser): echo 'value="'.$authUser['email'].'" disabled'; endif; ?>>

							</div>
						</div>

						<!-- Select Basic -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="theme">Thème de ta
								demande</label>
							<div class="col-md-8">
								<select id="theme" name="Ticket[ticket_theme_id]" class="form-control">
									<?php foreach($ticketThemes as $ticketTheme):?>
										<option <?php if($ticketTheme->name=="autre"): echo 'class="editable" value="autre"'; else: echo 'value='.$ticketTheme->id; endif;?>><?= $ticketTheme->name ?></option>
									<?php endforeach;?>
								</select>
								<input class="editOption" style="display:none;" name="Ticket[theme]" value=""></input>
							</div>
						</div>

						<!-- Textarea -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="question">Description
								de ta demande</label>
							<div class="col-md-8">
								<textarea class="form-control" id="question" name="Ticket[question]" placeholder="Merci d'être le plus précis possible"></textarea>
							</div>
						</div>

						<!-- Button -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="send"></label>
							<div class="col-md-4">
								<button id="send" name="send" class="btn btn-primary">Envoyer la
									demande</button>
							</div>
						</div>

					</fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>

	</div>
</div>

<?php //$this->start('footerscript');?>
<script type="text/javascript">
$(document).ready(function(){
	var initialText = $('.editable').val();
	$('.editOption').val(initialText);

	$('#theme').change(function(){
		console.log("coucou");
		var selected = $('option:selected', this).attr('class');
		var optionText = $('.editable').text();
		
		if(selected == "editable"){
		  $('.editOption').show();
		
		  
		  $('.editOption').keyup(function(){
		      var editText = $('.editOption').val();
// 		      $('.editable').val(editText);
		      $('.editable').html(editText);
		  });
		
		}else{
		  $('.editOption').hide();
		}
	});
});

</script>
<?php //$this->end(); ?>