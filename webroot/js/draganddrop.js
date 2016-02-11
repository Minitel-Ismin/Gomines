/************************************
 * Code du drag'n'drop utilisé pour *
 * l'upload de fichiers.            *
 *                                  *
 * Développé par Thomas TROUCHKINE  *
 * P2017                            *
 * thomas.trouchkine@gmail.com      *
 ************************************/

/*************/
/* VARIABLES */
/*************/

var dropper = $('#dropper');
var upload_progress = $('#upload_progress');
var message_info = $('#message');
var add_file = $('#add_file');
var extensions = ['avi','mkv','m4v','mp4','srt'];
var num_file = 0;

/**************************************/
/* FONCTION POUR RECUPERE L'EXTENSION */
/**************************************/

function getExtension(filename){
    var parts = filename.split(".");
    return (parts[(parts.length-1)]);
}  

/*********************/
/* FONCTION IN ARRAY */
/*********************/

function in_array(string, array){
    var result = false;
    for(i=0; i<array.length; i++){
        if(array[i] == string){
            result = true;
        }
    }
    return result;
}

/***************************************/
/* ON AUTORISE LE DROP DANS LE DROPPER */
/***************************************/

dropper.on('dragover', function(e) {
    e.preventDefault(); //annule l'interdiction de drop
});


/******************************************/
/* ON DEFINIT LA MANIERE DONT ON S'OCCUPE */
/* DE L'ELEMENT DROPPE                    */
/******************************************/
var test;
dropper.on('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    var files = [].slice.call(e.originalEvent.dataTransfer.files), //files est un tableau avec tous les fichiers dropés
        filesLen = files.length,
        filenames = "";
    var goodFiles = [];
    var data = new FormData();

    $.each(files, function(k, v){
        var ext = getExtension(v.name);
        //if(in_array(ext, extensions))
            goodFiles.push(v);
    });

    $.each(goodFiles, function(k, v){
        console.log("Envoi des fichiers");
        data.append(k, v);
    });
    test = data;
    $.ajax({
        url: "/upload/newFile",
        method: "POST",
        data: data,
        cache: false,
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
            }
            return myXhr;
        },
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function(data, textStatus, jxhr){
            if(typeof data.error == 'undefined'){
                message_info.html("Upload terminé avec succès, tu peux en relancer un !").attr("class","label label-success");
                $.each(goodFiles,function(k, v){
                    add_file.append($("<tr><td>"+v.name+"</td></tr>"));
                });
            }else{
                message_info.html("Erreur lors de l'upload !").attr("class","label label-danger");
            }
        }
    });
    
    //On remet le contour normal
    dropper.style.boxShadow = '0px 0px 10px rgb(150,150,150) inset';
    dropper.style.border = '2px solid rgb(200,200,200)';
});

/****************************************/
/* EFFET QUAND ON ENTRE/SORT DE LA ZONE */
/* DE DROP                              */
/****************************************/

dropper.on('dragenter', function() {
    dropper.style.boxShadow = '0px 0px 20px #29abe2 inset';
    dropper.style.border = '2px solid #29abe2';
});

dropper.on('dragleave', function() {
    dropper.style.boxShadow = '0px 0px 10px rgb(150,150,150) inset';
    dropper.style.border = '2px solid rgb(200,200,200)';
});

function progressHandlingFunction(e){
    if(e.lengthComputable){
        upload_progress.css("width", e.loaded/e.total*100+"%");
        console.log(e);
    }
}
