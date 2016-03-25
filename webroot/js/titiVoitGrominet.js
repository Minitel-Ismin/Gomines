$(document).ready(function(){
    soundManager.url = "swf/";
    soundManager.debugMode = true;
    
    var etat = 0;
    
    $(document).keydown(function(e){
        switch(etat){
            case 0:
                if(e.which == 38){
                    etat = 1;
                }
                else
                    etat = 0;
                break;
            case 1:
                if(e.which == 38){
                    etat = 2;
                }
                else
                    etat = 0;
                break;
            case 2:
                if(e.which == 40){
                    etat = 3;
                }
                else
                    etat = 0;
                break;
            case 3:
                if(e.which == 40){
                    etat = 4;
                }
                else
                    etat = 0;
                break;
            case 4:
                if(e.which == 37){
                    etat = 5;
                }
                else
                    etat = 0;
                break;
            case 5:
                if(e.which == 39){
                    etat = 6;
                }
                else
                    etat = 0;
                break;
            case 6:
                if(e.which == 37){
                    etat = 7;
                }
                else
                    etat = 0;
                break;
            case 7:
                if(e.which == 39){
                    etat = 8;
                }
                else
                    etat = 0;
                break;
            case 8:
                if(e.which == 66){
                    etat = 9;
                }
                else
                    etat = 0;
                break;
            case 9:
                if(e.which == 65){
                    soundManager.play("titiGrominet", 'audio/titiVoitGrominet.mp3');
                }
                else
                    etat = 0;
                break;
            default:
                etat = 0;
        }
    });
});