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
            Les formats que tu peux uploader sont : avi, mkv, m4v, mp4, srt
        </div>
        <div class="col-lg-6 alert alert-info">
            Navigateur supporté : Firefox
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
