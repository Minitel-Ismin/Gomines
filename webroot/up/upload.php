<?php

$extension_allowed = ['avi', 'mkv', 'm4v', 'mp4', 'srt'];
$mail = "morgane.quilfen@etu.emse.fr";


foreach($_FILES as $file){
    $filename = $file['name'];
    $objet = "Upload de ".$filename." sur G*";
    $extension = strrchr($filename, '.');
    $extension = substr($extension, 1);
    $extension = strtolower($extension);
    
    if(in_array($extension, $extension_allowed)){   
        move_uploaded_file($file['tmp_name'], 'dl/' . $filename);
        mail($mail, $objet, "");
        $message = $filename." a bien été enregistré !";
    }
    else{
        $message = $filename." n'a pas été enregistré : extension non autorisée...";
    }
}

echo $message;

?>