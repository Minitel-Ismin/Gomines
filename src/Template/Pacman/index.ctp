<?php
$this->Html->script('modernizr-1.5.min.js', array('block' => 'script'));
$this->Html->script('pacman.js', array('block' => 'script'));
?>

<style type="text/css">
  @font-face {
      font-family: 'BDCartoonShoutRegular';
      src: url('webroot/fonts/BD_Cartoon_Shout-webfont.ttf') format('truetype');
      font-weight: normal;
      font-style: normal;
  }
  #pacman {
    height:450px;
    width:342px;
    margin:20px auto;
  }
  #shim { 
    font-family: BDCartoonShoutRegular; 
    position:absolute;
    visibility:hidden
  }
  h1 { font-family: BDCartoonShoutRegular; text-align:center; }
  
  a { text-decoration:none; }
</style>

<div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-4">
            <h1 class="text-center">Meilleurs scores</h1>
            <table class="table table-striped">
                <thead>
                    <th>Rang</th>
                    <th>Nom</th>
                    <th>Score</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mathieu Rousse</td>
                        <td>6235</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Thomas Trouchkine</td>
                        <td>6128</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Grégoire Rivière</td>
                        <td>5238</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Morgane Quilfen</td>
                        <td>5156</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Ludovic Chaix</td>
                        <td>5066</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div id="pacman"></div>
        </div>
        <div class="col-lg-4">
            <h1 class="text-center">Commandes</h1>
            <table class="table table-striped">
                <thead>
                    <th>Touche</th>
                    <th>Effet</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Flêches directionnelles</td>
                        <td>Se diriger</td>
                    </tr>
                    <tr>
                        <td>N</td>
                        <td>Nouvelle partie</td>
                    </tr>
                    <tr>
                        <td>P</td>
                        <td>Pause</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center">
            <a href="http://arandomurl.com/">Writeup</a> | Code on <a href="http://arandomurl.com/">Github</a>
        </div>
    </div>
    
</div>
<script>
    var el = document.getElementById("pacman");

    if (Modernizr.canvas && Modernizr.localstorage && 
        Modernizr.audio && (Modernizr.audio.ogg || Modernizr.audio.mp3)) {
      window.setTimeout(function () { PACMAN.init(el, "./"); }, 0);
    } else { 
      el.innerHTML = "Sorry, needs a decent browser<br /><small>" + 
        "(firefox 3.6+, Chrome 4+, Opera 10+ and Safari 4+)</small>";
    }
</script>