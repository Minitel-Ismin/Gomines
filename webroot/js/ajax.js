function handleAjax(e) {
    e.preventDefault();

    var
        $link = $(this),
        callUrl = $link.attr('href'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        onBefore = $link.data('onBefore'),
        ajaxRequest,
        data = [];

    onBefore_f = window[onBefore];
    // Assign before handler
    if (typeof onBefore_f === "function") {
        data = onBefore_f();
    }
 
    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: data
    });
 
    onDone_f = window[onDone];
    // Assign done handler
    if (typeof onDone_f === "function") {
        ajaxRequest.done(onDone_f);
    }
 
    onFail_f = window[onFail];
    // Assign fail handler
    if (typeof onFail_f === "function") {
        ajaxRequest.fail(onFail_f);
    }
 
    onAlways_f = window[onAlways];
    // Assign always handler
    if (typeof onAlways_f === "function") {
        ajaxRequest.always(onAlways_f);
    }
 
}

function askTitle(){
    titre = prompt("Veuillez saisir le titre du film");
    retour = {"title" : titre};
    return retour;
};

function metaLoad(e){
    var txt = $("<div>").attr("class","coverDialogMeta");
    $("#dialogMeta").html("");
    $("#dialogMeta").dialog({ width: "auto"});
    if(typeof e.dvd.id == 'string'){
        var tmp = e.dvd;
        e.dvd = [tmp];
    }
    $.each(e.dvd,function(i,el){
        elmt = $("<img>").attr("src", el.cover);
        elmt.click(function(){
            selectMeta(e.id,el);
            $("#dialogMeta").dialog("close");
        });
        txt.append(elmt);
    });
    $("#dialogMeta").append(txt);
};

function selectMeta(id, data){
    $.ajax({
        type: "post",
        url : "index.php?r=movies%2Fselectmetaajax&idFilm="+id,
        data : data
    }).done(function(e){
    });
};

$('.ajax').click(handleAjax);
