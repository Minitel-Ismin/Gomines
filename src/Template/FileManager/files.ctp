<!-- 
        File management interface by Arnaud PASQUELIN and Thomas TROUCHKINE 
        Modifié par Guillaume ANDRES
        Version 1.2 : 01/10/2016
        Modifications :
            - Conservation de l'extension du fichier déplacé
            - Correction d'un bug qui empêchait d'écrire dans les dossiers "Annales" et "Moocs"
            - Prise en charge des dossiers mutliple pour une catégorie
-->
<?php
//$this->Html->script('fileManager.js', array('block' => 'footerscript'));

?>
<div class="container-fluid">
    <div class="row">
        <?= $this->element('AdminMenu'); ?>
        <div class="col-lg-8 col-md-8 column content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">
                    Tri de fichier
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-center">
                <h3>Fichiers du dossier</h3>
                <ul class="list-group file-list">
                    <?php 
                    $id = 0;
                    foreach ($files[1] as $nomFichier) {
                        echo '<a class="list-group-item" id="'.$id.'">'.$nomFichier.'</a>';
                        $id++;
                    }
                    ?>
                </ul>
            </div>

            <div class="col-lg-3 text-center">
                <h3>Destination</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <ul class="list-group" id="destFolder">
                        <?php 
                        foreach($folders as $folder){
                            echo '<li class="list-group-item"><input type= "radio" name="categorie" value="'.$folder->id.'"> '.$folder->path.'</li>';
                            
                        }
                        ?>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-5 text-center">
                <h3>Outils</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon addon-size-fixed" id="basic-addon3">Nouveau nom</span>
                          <input type="text" class="form-control" id="newName" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>  
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                          <span class="input-group-addon addon-size-fixed" id="basic-addon3">RegEx</span>
                          <input type="text" class="form-control" id="newName" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <input class="btn btn-default" type="submit" id="sendButton" value="Faire la copie">
                        </div>
                    </div>
                </div>
                <br>
                <div id="response"></div>
            </div> 
        </div>       
    </div>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript">
        var nbFichier = '<?php echo $id;?>';
    </script>
    <?= $this->element('FileManager/fileManagerJS'); ?>