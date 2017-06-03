<script type='text/javascript'>
var url = '<?= $this->Url->build(array(
	    "controller" => "FileManager",
	    "action" => "target"
	));?>';
var direcSrc = '<?php echo $directory; ?>';
var destination;
var sendBtn = document.getElementById("sendButton");
var fileSrc = document.getElementById(0);
var bgColor = "rgb(230,230,230)";
var boxShadow = "0px 0px 5px rgb(0,0,200)";
var responseMess = document.getElementById("response");
var success = '<div class="row"><div class="col-lg-12"><p class="label label-success" style="font-size: 15px">Le fichier a été déplacé</p></div></div>';
var failure = '<div class="row"><div class="col-lg-12"><p class="label label-danger" style="font-size: 15px">Echec dans le déplacement du fichier</p></div></div>';

fileSrc.style.backgroundColor = bgColor;
fileSrc.style.color = "black";

// function choixDestination(){
// 	$('#destFolder').each(function(index)){
// 		console.log(index);
// 		if($(this).children().
// 	});
// 	return destination;
// }

//ajoute l'event listener sur tous les fichers
for (var i = 0; i < nbFichier; i++) {
	var file = document.getElementById(i);
	file.addEventListener('click', function(e) {
		e.preventDefault();
        if(this != fileSrc){
            this.style.backgroundColor = bgColor;
            fileSrc.style.color = this.style.color;
            this.style.color = "black";
            fileSrc.style.backgroundColor = "white";
            fileSrc = this;
        }
	}, false);
}

sendBtn.addEventListener('click', function(e) {
	e.preventDefault();
    if(document.getElementById("newName").value == ""){
        var newname = fileSrc.textContent;
    }
    else{
	   var newname = document.getElementById("newName").value;
    }
// 	var destination = choixDestination();
	
	$.ajax({
		url : url,
		type : 'POST',
		dataType : 'html',
        data : "&source="+fileSrc.textContent.replace("&","%26")+"&srcfolder="+direcSrc+"&destination="+destination+"&nouveauNom="+newname,
        success : function(msg){
            if(msg == "success"){
                responseMess.innerHTML = success;
                fileSrc.style.display = "none";
            }
            else{
                responseMess.innerHTML = failure;
            }
        }
	});
}, false)

$(document).ready(function(){
	$( "input[type=radio]" ).on( "click", function(){
		destination=$(this).val();
	});
});


</script>