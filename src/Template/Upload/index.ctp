<?php
$this->Html->script('draganddrop.js', array('block' => 'footerscript'));
$this->Html->script('previsualisation_image.js', array('block' => 'footerscript'));
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div id="title"><h1>Upload de fichiers</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 alert alert-info">
            Les formats que tu peux uploadés sont : avi, mkv, m4v, mp4, srt
        </div>
        <div class="col-lg-6 alert alert-info">
            Navigateurs supportés : Firefox
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 alert alert-info">
            L'upload est également possible en FTP avec les identifiants :<br/>
            <strong>Host : </strong>upload.gomines.rez ou ip: 172.17.0.11<br/>
            <strong>User : </strong><?= $username ?><br/>
            <strong>Pass : </strong><?= $pass ?><br/>
            Les fichiers seront ensuite triés et mis dans la liste principale.
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

         
        <form class="form-horizontal"> 
            <fieldset> 
 
            <!-- Form Name --> 
            <legend>Formulaire d'Upload</legend> 
 
            <!-- Text input--> 
            <div class="form-group"> 
            <label class="col-md-4 control-label" for="dgid">Nom Du Fichier</label>   
            <div class="col-md-4"> 
            <input id="dgid" name="dgid" type="text" placeholder="Nom Du Fichier" class="form-control input-md"> 
                 
            </div> 
            </div> 
 
            <!-- Text input--> 
            <div class="form-group"> 
            <label class="col-md-4 control-label" for="token">Année De Sortie</label>   
            <div class="col-md-4"> 
            <input id="token" name="token" type="text" placeholder="2016" class="form-control input-md"> 
                 
            </div> 
            </div> 
 
            <!-- Text input--> 
            <div class="form-group"> 
            <label class="col-md-4 control-label" for="email">Qualité</label>   
            <div class="col-md-4"> 
                <input type="radio" name="qualite" value="inconnue" id="inconnue" /> <label for="inconnue">Inconnue</label><br /> 
                <input type="radio" name="qualite" value="1080p" id="1080p" /> <label for="1080p">1080p</label><br /> 
                <input type="radio" name="qualite" value="720p" id="720p" /> <label for="720p">720p</label><br /> 
                <input type="radio" name="qualite" value="480p" id="480p" /> <label for="480p">480p</label><br /> 
 
                 
            </div> 
            </div> 
 
            <!-- Text input--> 
            <div class="form-group"> 
            <label class="col-md-4 control-label" for="abal">Type</label>   
            <div class="col-md-4"> 
                <input type="radio" name="type" value="Film" id="Film" /><label for="Film">Film</label> &emsp;&emsp;&nbsp; 
                <input type="radio" name="type" value="Blu-Ray" id="Blu-Ray" /> <label for="Blu-Ray">Blu-Ray</label><br /> 
                <input type="radio" name="type" value="Serie" id="Serie" /> <label for="Serie">Serie</label>&emsp;&emsp; 
                <input type="radio" name="type" value="Logiciel" id="Logiciel" /> <label for="Logiciel">Logiciel</label><br /> 
                <input type="radio" name="type" value="Jeux" id="Jeux" /> <label for="Jeux">Jeux</label>&emsp;&emsp;&nbsp; 
                <input type="radio" name="type" value="Cours" id="Cours" /> <label for="Film">Cours</label><br /> 
                <input type="radio" name="type" value="NSFW" id="NSFW" /> <label for="Film">NSFW</label>&emsp;&emsp; 
                <input type="radio" name="type" value="Manga" id="Manga" /> <label for="Manga">Manga</label><br /> 
                <input type="radio" name="type" value="Autre" id="Autre" /> <label for="Autre">Autre</label><br /> 
                     
            </div> 
            </div> 
 
            </form> 
            
            <!-- DROPPER -->
            <div class="row">
                <div class="col-lg-12">
                    <div id="dropper"><p>Dépose tes fichiers ici</p></div>
                </div>
            </div>
            
            <!-- PROGRESS BAR -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="progress">
                        <div id="upload_progress" class="progress-bar" role="progressbar"><span class="sr-only"></span></div>
                    </div>
                </div>
            </div>
            
            <!-- MESSAGE -->
            <div class="row">
                <div class="col-lg-12">    
                    <div class="label label-info">Tu peux lancer un upload</div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Récapitulatif des fichiers uploadés</h2>
                </div>
            </div>
            <div class="row">
                <div id="recap" class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <tbody id="add_file">
                                    <!-- Ici on rajoute les fichiers qu'on upload -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
