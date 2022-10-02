

    $("#formulaire_contact").keyup(function(event)
    {
//début de recupération des données du Serveur_et_formulaires
        var nom = document.formulaire_contact.nom.value;
        var prenom = document.formulaire_contact.prenom.value;
        var date = document.formulaire_contact.date.value;
        var cp = document.formulaire_contact.cp.value;
        var adresse = document.formulaire_contact.adresse.value;
        var ville = document.formulaire_contact.ville.value;
        var mescommandes = document.formulaire_contact.mescommandes.value;
        var email = document.formulaire_contact.email.value;
        var cgu = document.querySelector('#cgu:checked');
        var question = document.formulaire_contact.question.value;

        //regex de contrôle des données
        var verif 	= /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
        var ctrnom= /^[a-zA-Z]{2,}$/
        var ctrprenom = /^[a-zA-Z]{2,}$/
        var ctrcp = /^[0-9]{4,5}$/ 
        var ctrdate = /^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$/
        var ctrquestion = /[a-zA-Z\d]{5}/
        var ctradresse = /^[0-9]{1,}\s+[a-z]{2,}\s+[a-z]{2,}/
        //au minimum 1 caractére car il existe la ville Y nom le plus court code postal 80190
        var ctrville= /^[a-zA-Z]{1,}$/
        var testedate = date.split('-');
        var dateactuelle=new Date()
        var year = dateactuelle.getFullYear();
        var diffdate = year - 110;
        var dateenv = year - 15;
        var validy = false//valeur par défaut
        if(parseInt(testedate[0])<parseInt(dateenv)&&testedate[0]>diffdate){// on contrôle que la personne a entre 15 ans et 120 ans
        validy = true
        }
    if (verif.exec(email) == null)// si email ne contient pas des lettre point chiffre avant @ aprés arobase pareilhormis là le point est interdit etc
    {

        document.getElementById("demail").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">vous devez entrer une email correct</div>";//si c'est null on affiche box alerte
        document.getElementById("email").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controlmail = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {

        document.getElementById("email").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("demail").innerHTML="";//si c'est null on affiche rien
        var controlmail = true;//on retourne true pour cette variable

    } 

  
    if (ctradresse.exec(adresse) == null)// on contrôle l'entré
    {

        document.getElementById("dadresse").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">vous devez entrer une adresse correct</div>";//si c'est null on affiche box alerte
        document.getElementById("adresse").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controladresse = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {

        document.getElementById("adresse").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dadresse").innerHTML="";//si c'est null on affiche rien
        var controladresse = true;//on retourne true pour cette variable

    } 
    if (ctrville.exec(ville) == null)// on contrôle l'entré
    {

        document.getElementById("dville").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">vous devez entrer une ville correct</div>";//si c'est null on affiche box alerte
        document.getElementById("ville").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controlville= false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {

        document.getElementById("ville").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dville").innerHTML="";//si c'est null on affiche rien
        var controlville = true;//on retourne true pour cette variable

    } 
    if (ctrcp.exec(cp) == null)// si email ne contient pas des lettre point chiffre avant @ aprés arobase pareil hormis là le point est interdit etc
    {

        document.getElementById("dcp").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">vous devez entrer un code postal correct entre 4 à 5 chiffre suivant le pays</div>";//si c'est null on affiche box alerte
        document.getElementById("cp").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controlcp = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {

        document.getElementById("cp").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dcp").innerHTML="";//si c'est null on affiche rien
        var controlcp = true;//on retourne true pour cette variable

    } 

    if (ctrnom.exec(nom) == null)//si nom ne contient pas au moins deux lettre on sait jamais monsieur wu sa existe :D
    {
      
        document.getElementById("nom").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        document.getElementById("dnom").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Veuillez entrer correctement votre Nom</div>";//si c'est null on affiche box alerte
        var controlnom = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {

        document.getElementById("nom").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dnom").innerHTML="";//si c'est null on affiche rien
        var controlnom = true;//on retourne true pour cette variable
    }


    if (ctrprenom.exec(prenom) == null)// si prenom ne contient pas au moins deux caractére alphabétique pareil on rejette
    {

        document.getElementById("dprenom").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Veuillez entrer correctement votre Prénom</div>";//si c'est null on affiche box alerte
        document.getElementById("prenom").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controlprenom = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires
    
    }
    else
    {
        document.getElementById("prenom").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dprenom").innerHTML="";//si c'est null on affiche rien
        var controlprenom = true;//on retourne true pour cette variable
    }


    if (ctrdate.exec(date) == null||validy==false)//si la date ne ressemble pas à 0000-00-00 c'est que ce n'est pas correcte c'est se que retourne type date dans l'input
    {
        document.getElementById("ddate").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Veuillez entrer une date valide exemple 01/01/2020</div>";//si c'est null on affiche box alerte
        var controldate = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires
        document.getElementById("date").className = "form-control is-invalid";//on change la couleur de l'input en rouge
    }
    else
    {
        document.getElementById("date").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("ddate").innerHTML="";//si c'est null on affiche rien
        var controldate = true;//on retourne true pour cette variable
    }


    if (mescommandes == "")// si commande c'est vide c'est à dire rien n'a était séléctionné
    {
       
        document.getElementById("dmescommandes").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Vous devez séléctionner un sujet</div>";//si c'est null on affiche box alerte
        document.getElementById("mescommandes").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controlmescommandes = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires
   
    }
    else
    {
        document.getElementById("mescommandes").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dmescommandes").innerHTML="";//si c'est null on affiche rien
        var controlmescommandes = true; //on retourne true pour cette variable
    }


    if (ctrquestion.exec(question) == null)//si ya pas au moins 4 caractéres alpha numérique entré alors on refuse
    {
   
        document.getElementById("dquestion").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Vous devez nous indiquer votre question</div>";//si c'est null on affiche box alerte
        document.getElementById("question").className = "form-control is-invalid";//on change la couleur de l'input en rouge
        var controlquestion = false; //on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {
        document.getElementById("question").className = "form-control is-valid";//on change la couleur de l'input en vert
        document.getElementById("dquestion").innerHTML="";//si c'est null on affiche rien
        var controlquestion= true;//on retourne true pour cette variable
    }

        var input = document.getElementById('cgu');

        if (input.checked==false)//si cgu n'a pas était cocher alors on refuse
        {

  
        document.getElementById("dcgu").innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Vous devez accepter nos conditionns</div>";//si c'est null on affiche box alerte
        document.getElementById("cgu").className = "custom-control-input is-invalid";//on change la couleur de l'input en rouge
        var controlcgu = false;//on retourne false au form pour évité l'envoie du Serveur_et_formulaires

    }
    else
    {
        document.getElementById("cgu").className = "custom-control-input is-valid";//on change la couleur de l'input en vert
        document.getElementById("dcgu").innerHTML="";//si c'est null on affiche rien
        var controlcgu = true;//on retourne true pour cette variable
    }

        if(controlcp&&controlville&&controladresse&&controlnom&&controlprenom&&controlmail&&controldate&&controlmescommandes&&controlquestion&&controlcgu)//maintenant on s'assure que tout est valide 
        {
            return true;
        }
        else
        {
            //sinon on renvoi bien un false
            return false;
        }
    })

function limitingData(oEvent) {
  if(isNaN(this.dataset.maxlength) == false)
  { 
    let oDiv =  document.getElementById(this.name+"Error");
        if(oDiv)
        {
            let oCnt =  oDiv.children[0], 
            iLongueur = this.value.length,
            iLimit = parseInt(this.dataset.maxlength);  

            if(iLimit - iLongueur < 0) 
            {
                oCnt.classList.add("warning");
                document.getElementById(this.name).className = "form-control is-invalid";
                document.getElementById(this.name).value =  document.getElementById(this.name).value.substring(0, iLimit);
                oCnt.textContent = iLimit - iLongueur ;
            }
            else
            {
                oCnt.classList.remove("warning");
                document.getElementById(this.name).className = "form-control is-valid";
                oCnt.textContent = iLongueur ;
            }

        }
  }
}

// pro_libelle et pro_couleur
document.addEventListener('DOMContentLoaded',function()
{
    let aTextarea = document.getElementsByTagName('input');
    for(let oTextarea of aTextarea)
    {
        if(oTextarea.maxLength == -1 && oTextarea.dataset.maxlength != null)
        {

            oTextarea.addEventListener('input',limitingData); //appel de la fonction limitingdata
        }
    }
});

  //fonction de contrôle du textera
document.addEventListener('DOMContentLoaded',function()
{
  let aTextarea = document.getElementsByTagName('textarea');
  for(let oTextarea of aTextarea)
  {

    if(oTextarea.maxLength == -1 && oTextarea.dataset.maxlength != null){
      oTextarea.addEventListener('input',limitingData); //appel de la fonction limitingdata
    }
    
  }
});

$("#viewpassword").click(function(event) 
    {
        if($('#password').attr("type") == "text"){
            $('#password').attr('type', 'password');
            $('#eyepassword').addClass( "fa-eye-slash");
            $('#eyepassword').removeClass( "fa-eye" );
        }else if($('#password').attr("type") == "password"){
            $('#password').attr('type', 'text');
            $('#eyepassword').removeClass( "fa-eye-slash" );
            $('#eyepassword').addClass( "fa-eye" );
        }
    });

    $("#viewconfirpassword").click(function(event) 
    {
        if($('#confirpassword').attr("type") == "text"){
            $('#confirpassword').attr('type', 'password');
            $('#eyeconfirmpassword').addClass( "fa-eye-slash" );
            $('#eyeconfirmpassword').removeClass( "fa-eye" );
        }else if($('#confirpassword').attr("type") == "password"){
            $('#confirpassword').attr('type', 'text');
            $('#eyeconfirmpassword').removeClass( "fa-eye-slash" );
            $('#eyeconfirmpassword').addClass( "fa-eye" );
        }
    });

    $( "#confirpassword" ).keyup(function() {
        if($('#confirpassword').val() == $('#password').val()){
            $('#confirpassword').removeClass( "is-invalid");
            $('#confirpassword').addClass( "is-valid");
        }else{
            $('#confirpassword').addClass( "is-invalid");
            $('#confirpassword').addClass( "is-valid");
        }
      });



      // contrôle si password à bien un symbole majuscule et chiffre ainsi que 12 caractére




      // contrôle si password à bien un symbole majuscule et chiffre ainsi que 12 caractéres
      
      $("#register").keyup(function(event) 
    {
//déclaration des variables et leur valeur par defaut pour le contrôle final 
let nom = false
let prenom = false
let adresse = true
let cp = true
let ville = true
let tel = true
let email = false
let password = false
let confirpassword = false


           //contrôle nom 
       if($( "#nom" ).val().match(/^[a-zA-Z]{2,}$/))
       {
           $('#nom').removeClass( "is-invalid");
           $('#nom').addClass( "is-valid");
           $('#dnom').html("<div class=\"alert alert-success\" role=\"alert\">Nom correcte</div>");
           event.preventDefault(event);
           nom = true
       }
       else if($( "#nom" ).val().length>=1&&(!$( "#nom" ).val().match(/^[a-zA-Z]{2,}$/)))
       {
           $('#nom').removeClass( "is-valid");
           $('#nom').addClass( "is-invalid");
           $('#dnom').html("<div class=\"alert alert-danger\" role=\"alert\">Nom incorrecte</div>");
           event.preventDefault(event);
           nom = false
       }
       else
       {
           $('#nom').removeClass( "is-valid");
           $('#nom').removeClass( "is-invalid");
           $('#dnom').html("");
           event.preventDefault();
           nom = false
       }//fin contrôle de la nom



           //contrôle prenom 
           if($( "#prenom" ).val().match(/^[a-zA-Z]{2,}$/))
           {
               $('#prenom').removeClass( "is-invalid");
               $('#prenom').addClass( "is-valid");
               $('#dprenom').html("<div class=\"alert alert-success\" role=\"alert\">Prenom correcte</div>");
               event.preventDefault(event);
               prenom = true
           }
           else if($( "#prenom" ).val().length>=1&&(!$( "#prenom" ).val().match(/^[a-zA-Z]{2,}$/)))
           {
               $('#prenom').removeClass( "is-valid");
               $('#prenom').addClass( "is-invalid");
               $('#dprenom').html("<div class=\"alert alert-danger\" role=\"alert\">Prenom incorrecte</div>");
               event.preventDefault(event);
               prenom = false
           }
           else
           {
               $('#prenom').removeClass( "is-valid");
               $('#prenom').removeClass( "is-invalid");
               $('#dprenom').html("");
               event.preventDefault();
               prenom = false
           }//fin contrôle de la prenom
    
    

           //contrôle adresse 
           if($( "#adresse" ).val().match(/[0-9]{1,}\s+[a-z]{2,}\s+[a-z]{2,}/))
           {
               $('#adresse').removeClass( "is-invalid");
               $('#adresse').addClass( "is-valid");
               $('#dadresse').html("<div class=\"alert alert-success\" role=\"alert\">Adresse correcte</div>");
               event.preventDefault(event);
               adresse = true
           }
           else if($( "#adresse" ).val().length>=1&&(!$( "#adresse" ).val().match(/[0-9]{1,}\s+[a-z]{2,}\s+[a-z]{2,}/)))
           {
               $('#adresse').removeClass( "is-valid");
               $('#adresse').addClass( "is-invalid");
               $('#dadresse').html("<div class=\"alert alert-danger\" role=\"alert\">Adresse incorrecte</div>");
               event.preventDefault(event);
               adresse = false
           }
           else
           {
               $('#adresse').removeClass( "is-valid");
               $('#adresse').removeClass( "is-invalid");
               $('#dadresse').html("");
               event.preventDefault();
               adresse = true
           }//fin contrôle de adresse
    
    

       //contrôle ville il existe la ville Y 
       if($( "#ville" ).val().match(/^[a-zA-Z]{1,}$/))
       {
           $('#ville').removeClass( "is-invalid");
           $('#ville').addClass( "is-valid");
           $('#dville').html("<div class=\"alert alert-success\" role=\"alert\">Ville correcte</div>");
           event.preventDefault(event);
           ville = true
       }
       else if($( "#ville" ).val().length>=1&&(!$( "#ville" ).val().match(/^[a-zA-Z]{1,}$/)))
       {
           $('#ville').removeClass( "is-valid");
           $('#ville').addClass( "is-invalid");
           $('#dville').html("<div class=\"alert alert-danger\" role=\"alert\">Ville incorrecte</div>");
           event.preventDefault(event);
           ville = false
       }
       else
       {
           $('#ville').removeClass( "is-valid");
           $('#ville').removeClass( "is-invalid");
           $('#dville').html("");
           event.preventDefault();
           ville = true
       }//fin contrôle de la ville



        //début contrôle code postal
        if($( "#cp" ).val().match(/^[0-9]{4,5}$/))
        {
            $('#cp').removeClass( "is-invalid");
            $('#cp').addClass( "is-valid");
            $('#dcp').html("<div class=\"alert alert-success\" role=\"alert\">code postal correcte</div>");
            event.preventDefault();
            cp = true
        }
        else if($( "#cp" ).val().length>=1&&(!$( "#cp" ).val().match(/^[0-9]{4,5}$/)))
        {
            $('#cp').removeClass( "is-valid");
            $('#cp').addClass( "is-invalid");
            $('#dcp').html("<div class=\"alert alert-danger\" role=\"alert\">code postal incorrecte</div>");
            event.preventDefault();
            cp = false
        }else{
            $('#cp').removeClass( "is-valid");
            $('#cp').removeClass( "is-invalid");
            $('#dcp').html("");
            event.preventDefault();
            cp = true
        }//fin contrôle code postal


         //début contrôle téléphone
        if($( "#tel" ).val().match(/^[0-9]{10}$/))
        {
               $('#tel').removeClass( "is-invalid");
               $('#tel').addClass( "is-valid");
               $('#dtel').html("<div class=\"alert alert-success\" role=\"alert\">Numéro correcte</div>");
               event.preventDefault();
               tel = true
        }
        else if($( "#tel" ).val().length>=1&&(!$( "#tel" ).val().match(/^[0-9]{10}$/)))
        {
               $('#tel').removeClass( "is-valid");
               $('#tel').addClass( "is-invalid");
               $('#dtel').html("<div class=\"alert alert-danger\" role=\"alert\">Numéro incorrecte</div>");
               event.preventDefault();
               tel = false
        }else{
               $('#tel').removeClass( "is-valid");
               $('#tel').removeClass( "is-invalid");
               $('#dtel').html("");
               event.preventDefault();
               tel = true
        }//fin contrôle téléphone
   

                //debut contrôle email
        if ($( "#email" ).val().match( /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) 
        {
                    $('#email').removeClass( "is-invalid");
                    $('#email').addClass( "is-valid");
                    $('#demail').html("<div class=\"alert alert-success\" role=\"alert\">Adresse email correcte</div>");
                    event.preventDefault();
                    email = true
        }
        else if($( "#email" ).val().length>=1&&(!$( "#email" ).val().match(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)))
        {
                    $('#email').removeClass( "is-valid");
                    $('#email').addClass( "is-invalid");
                    $('#demail').html("<div class=\"alert alert-danger\" role=\"alert\">Adresse email incorrect</div>")
                    event.preventDefault();
                    email = false
        }
        else
        {
        
                    $('#email').removeClass( "is-valid");
                    $('#email').removeClass( "is-invalid");
                    $('#demail').html("");
                    event.preventDefault();
                    email = false

        }//contrôle email


               // contrôle de password
        if ($( "#password" ).val().match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!&#*?$%@/+($_)!])/)&&$( "#password" ).val().length>=12) 
        {
                $('#password').removeClass( "is-invalid");
                $('#password').addClass( "is-valid");
                $('#dpassword').html("<div class=\"alert alert-success\" role=\"alert\">Mot de passe fort</div>");
                $('#divconfirmmdp').css("display", "block");
                $('#confirpassword').attr('type', 'password');
                event.preventDefault();
                password = true
        }
        else if($( "#password" ).val().length>=1&&(!$( "#password" ).val().match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!&#*?$%@/+($_)!])/)))
        {
                $('#password').removeClass( "is-valid");
                $('#password').addClass( "is-invalid");
                $('#dpassword').html("<div class=\"alert alert-danger\" role=\"alert\">Mot de passe faible votre mot de passe doit contenir au minimum 12 caractéres dont une majuscule un chiffre et un symbole exemple ! & # * ? $ % @ / +</div>")
                $('#confirpassword').attr('type', 'hidden');
                $('#divconfirmmdp').css("display", "none");
                password = false
                event.preventDefault();
        }
        else
        {

                $('#password').removeClass( "is-valid");
                $('#password').removeClass( "is-invalid");
                $('#dpassword').html("");
                $('#dconfirpassword').html("");
                $('#divconfirmmdp').css("display", "none");
                event.preventDefault();
                password = false
        } // fin contrôle de password
        

        // contrôle de confirpassword
        if ($( "#confirpassword" ).val()==$( "#password" ).val()&&$( "#password" ).val().length>=12&&$( "#confirpassword" ).val().length>=12) 
        {
                $('#confirpassword').removeClass( "is-invalid");
                $('#confirpassword').addClass( "is-valid");
                $('#dconfirpassword').html("<div class=\"alert alert-success\" role=\"alert\">Le mot de passe correspond</div>")
                confirpassword = true

        }
        else if($( "#confirpassword" ).val().length>=1)
        {
               $('#confirpassword').removeClass( "is-valid");
               $('#confirpassword').addClass( "is-invalid");
                $('#dconfirpassword').html("<div class=\"alert alert-danger\" role=\"alert\">Le mot de passe ne correspond pas</div>")
                event.preventDefault();
                confirpassword = false
              
        }
         else
        {
   
                   $('#dconfirpassword').removeClass( "is-valid");
                   $('#dconfirpassword').removeClass( "is-invalid");
                   event.preventDefault();
                   confirpassword = false
        }
         // fin contrôle de confirpassword

         if(nom&&prenom&&adresse&&cp&&ville&&tel&&email&&password&&confirpassword)
       {
                $('#register').attr('onsubmit', 'return true');
       }
        else
       {
                $('#register').attr('onsubmit', 'return false');
      }
    });

$("#resetpassword").keyup(function(event)
    {
//déclaration des variables et leur valeur par defaut pour le contrôle final

let password = false
let confirpassword = false





               // contrôle de password
        if ($( "#password" ).val().match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!&#*?$%@/+($_)!])/)&&$( "#password" ).val().length>=12)
        {
                $('#password').removeClass( "is-invalid");
                $('#password').addClass( "is-valid");
                $('#dpassword').html("<div class=\"alert alert-success\" role=\"alert\">Mot de passe fort</div>");
                $('#divconfirmmdp').css("display", "block");
                $('#confirpassword').attr('type', 'password');
                event.preventDefault();
                password = true
        }
        else if($( "#password" ).val().length>=1&&(!$( "#password" ).val().match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!&#*?$%@/+($_)!])/)))
        {
                $('#password').removeClass( "is-valid");
                $('#password').addClass( "is-invalid");
                $('#dpassword').html("<div class=\"alert alert-danger\" role=\"alert\">Mot de passe faible votre mot de passe doit contenir au minimum 12 caractéres dont une majuscule un chiffre et un symbole exemple ! & # * ? $ % @ / +</div>")
                $('#confirpassword').attr('type', 'hidden');
                $('#divconfirmmdp').css("display", "none");
                password = false
                event.preventDefault();
        }
        else
        {

                $('#password').removeClass( "is-valid");
                $('#password').removeClass( "is-invalid");
                $('#dpassword').html("");
                $('#dconfirpassword').html("");
                $('#divconfirmmdp').css("display", "none");
                event.preventDefault();
                password = false
        } // fin contrôle de password


        // contrôle de confirpassword
        if ($( "#confirpassword" ).val()==$( "#password" ).val()&&$( "#password" ).val().length>=12&&$( "#confirpassword" ).val().length>=12)
        {
                $('#confirpassword').removeClass( "is-invalid");
                $('#confirpassword').addClass( "is-valid");
                $('#dconfirpassword').html("<div class=\"alert alert-success\" role=\"alert\">Le mot de passe correspond</div>")
                confirpassword = true

        }
        else if($( "#confirpassword" ).val().length>=1)
        {
               $('#confirpassword').removeClass( "is-valid");
               $('#confirpassword').addClass( "is-invalid");
                $('#dconfirpassword').html("<div class=\"alert alert-danger\" role=\"alert\">Le mot de passe ne correspond pas</div>")
                event.preventDefault();
                confirpassword = false

        }
         else
        {

                   $('#dconfirpassword').removeClass( "is-valid");
                   $('#dconfirpassword').removeClass( "is-invalid");
                   event.preventDefault();
                   confirpassword = false
        }
         // fin contrôle de confirpassword

         if(password&&confirpassword)
       {
                $('#resetpassword').attr('onsubmit', 'return true');
       }
        else
       {
                $('#resetpassword').attr('onsubmit', 'return false');
      }
    });



$("#lostpassword").keyup(function(event)
    {
//déclaration des variables et leur valeur par defaut pour le contrôle final

let password = false
let confirpassword = false


    //debut contrôle email
    if ($( "#email" ).val().match( /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/))
    {
        $('#email').removeClass( "is-invalid");
        $('#email').addClass( "is-valid");
        $('#demail').html("<div class=\"alert alert-success\" role=\"alert\">Adresse email correcte</div>");
        event.preventDefault();
        email = true
    }
    else if($( "#email" ).val().length>=1&&(!$( "#email" ).val().match(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)))
    {
        $('#email').removeClass( "is-valid");
        $('#email').addClass( "is-invalid");
        $('#demail').html("<div class=\"alert alert-danger\" role=\"alert\">Adresse email incorrect</div>")
        event.preventDefault();
        email = false
    }
    else
    {

        $('#email').removeClass( "is-valid");
        $('#email').removeClass( "is-invalid");
        $('#demail').html("");
        event.preventDefault();
        email = false

    }//contrôle email

         if(email)
       {
                $('#email').attr('onsubmit', 'return true');
       }
        else
       {
                $('#email').attr('onsubmit', 'return false');
      }
    });


 //empêche le copié coller de l'input email password et confirpassword


     $(document).ready(function () {
        $('#email').bind('paste', function (e) {
           e.preventDefault();
        });
        $('#password').bind('paste', function (e) {
            e.preventDefault();
         });
         $('#confirpassword').bind('paste', function (e) {
            e.preventDefault();
         });
         $('#email').attr('autocomplete','off');
         $('#password').attr('autocomplete','off');
         $('#confirpassword').attr('autocomplete','off');
         $('#divconfirmmdp').css("display", "none");
         $('#register').attr('onsubmit', 'return false');
     });


     //contrôle des entrés de connexion email et password
     $("#connexion").keyup(function(event) 
     {
                //debut contrôle email
                if ($( "#email" ).val().match( /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) 
                {
                            $('#email').removeClass( "is-invalid");
                            $('#email').addClass( "is-valid");
                            $('#demail').html("<div class=\"alert alert-success\" role=\"alert\">Adresse email correcte</div>");
                            event.preventDefault();
                            email = true
                }
                else if($( "#email" ).val().length>=1&&(!$( "#email" ).val().match(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)))
                {
                            $('#email').removeClass( "is-valid");
                            $('#email').addClass( "is-invalid");
                            $('#demail').html("<div class=\"alert alert-danger\" role=\"alert\">Adresse email incorrect</div>")
                            event.preventDefault();
                            email = false
                }
                else
                {
                
                            $('#email').removeClass( "is-valid");
                            $('#email').removeClass( "is-invalid");
                            $('#demail').html("");
                            event.preventDefault();
                            email = false
        
                }//contrôle email
        
        
                       // contrôle de password
                if ($( "#password" ).val().match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!&#*?$%@/+($_)!])/)&&$( "#password" ).val().length>=12) 
                {
                        $('#password').removeClass( "is-invalid");
                        $('#password').addClass( "is-valid");
                        $('#dpassword').html("<div class=\"alert alert-success\" role=\"alert\">Mot de passe bon</div>");
                        event.preventDefault();
                        password = true
                }
                else if($( "#password" ).val().length>=1&&(!$( "#password" ).val().match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!&#*?$%@/+($_)!])/)))
                {
                        $('#password').removeClass( "is-valid");
                        $('#password').addClass( "is-invalid");
                        $('#dpassword').html("<div class=\"alert alert-danger\" role=\"alert\">Mot de passe incorrect</div>")
                        password = false
                        event.preventDefault();
                }
                else
                {
        
                        $('#password').removeClass( "is-valid");
                        $('#password').removeClass( "is-invalid");
                        $('#dpassword').html("");
                        $('#dconfirpassword').html("");
                        $('#divconfirmmdp').css("display", "none");
                        event.preventDefault();
                        password = false
                } // fin contrôle de password
     });



     function add_fields() {
        var d = document.getElementById("img");
     
        d.innerHTML = '<br><input type="file" name="pro_photo" id="pro_photo" class="form-control-file" multiple>';
     }


     $('#modification_produit').click(function(){
        var input = document.getElementById('pro_bloque');
    
        if (input.checked==true) 
        {
            document.getElementById('pro_bloque').value = 1;
        } else {
            document.getElementById('pro_bloque').value = 0;
        }
    });

    //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[id='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('id');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
          let filenames = [];
          let files = document.getElementById("an_photo").files;
          if (files.length > 1) {
            filenames.push("Total Files (" + files.length + ")");
          } else {
            for (let i in files) {
              if (files.hasOwnProperty(i)) {
                filenames.push(files[i].name);
              }
            }
          }
          $(this)
            .next(".custom-file-label")
            .html(filenames.join(","));
        });
      });