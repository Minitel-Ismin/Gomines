<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Formulaire de demande</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="#">
					<fieldset>


						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="name">Nom &amp; prénom</label>
							<div class="col-md-8">
								<input id="name" name="name" type="text" placeholder=""
									class="form-control input-md" required="">

							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="email">Email</label>
							<div class="col-md-8">
								<input id="email" name="email" type="text" placeholder=""
									class="form-control input-md" required="">

							</div>
						</div>

						<!-- Select Basic -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="theme">Thème de ta
								demande</label>
							<div class="col-md-8">
								<select id="theme" name="theme" class="form-control">
									<option value="1">Option one</option>
									<option value="2">Option two</option>
								</select>
							</div>
						</div>

						<!-- Textarea -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="question">Description
								de ta demande</label>
							<div class="col-md-8">
								<textarea class="form-control" id="question" name="question">Merci d'être le plus précis possible
					
								</textarea>
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