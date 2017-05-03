<div class="row">
    <div class="col-lg-12" style="text-align: center;">
        <?php if($nom_fichier == "...")
                echo("Crétin ! Tu as oublié de rentrer le nom du fichier... Allez,on recommence !");
            else
                echo("L'upload du fichier <span style=\"font-weight:bold;\">".htmlspecialchars($nom_fichier)."</span> à été effectuer.");?>
    </div>
</div>
<div class="row">
    <p></p>
</div>
<div class="row">
    <div class="col-lg-12" style="padding: 20px 0px;">
        <form class="form-horizontal" method="post" action="index">
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton"></label>
            <div class="col-md-4 center-block">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary center-block">Nouvel Upload</button>
            </div>  
        </div>
    </div>
</div>

