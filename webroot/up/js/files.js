/************************************/
/* ON RECUPERE UN FICHIER ET ON LIT */
/* SO CONTENU                       */
/************************************/

var fileInput = document.querySelector("#file_dropper");

fileInput.addEventListener('change', function(){
    
    var reader = new FileReader();
    
    reader.addEventListener('load', function() { //Event 'load' : la lecture vient de se terminer avec succes
        alert('Contenu du fichier "' + fileInput.files[0].name + '" :\n\n' + reader.result);
    }, false);
    
    reader.readAsText(fileInput.files[0]); //lecture du fi
    
}, false);