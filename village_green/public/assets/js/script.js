$(document).ready(function () {
    $('[data-toggle="popover"]').popover({trigger: "hover", container: 'body'});

    //console.log(panier)


    $("form").submit(function (event) {
        console.log(event.target.action)
        const regex = "/paniers/add";
        const found = event.target.action.match(regex);
        console.log(found);
        if (found) {
            event.preventDefault();

            // console.log(event.target.action)
            let formData = $(this).serialize();

            $.ajax({
                url: event.target.action + '/json',
                type: "POST",
                dataType: 'json',
                data: formData
            }).done(function (response) {
                let resultat = 0;
                let prix = 0;
                let temp = "";
                $.each(response, function (key, val) {
                    // console.log(val.qte);
                    resultat += parseInt(val.qte);
                    prix += parseFloat(val.prix) * parseInt(val.qte);
                    let teste = `<p><img height='50px' src='/assets/src/${val.photo}' alt='${val.name}'> ${val.name}</p>
<p>Quantité : <span class='text-success'>${val.qte}</span>  Prix : <span class='text-success'>${val.prix}€</span></p><hr>`
                    temp += teste;
                });
                let total = `<p>Total : <span class='text-success'>  ${prix} €</span> </p>
<p>   <a class="btn btn-success text-light" href="/paniers/">Voir le panier</a></p>`;
                temp = temp + total;
                // console.log(response);
                // console.log(prix);
                updateCountPanier(resultat)
                updatePanier(temp)


            });
        }
    });

});

function updateCountPanier(count) {
    let panier = document.getElementsByClassName('badge badge-pill badge-danger');
    //console.log(panier.length);
    if(panier.length>0){
        for (let i = 0; i < panier.length; i += 1) {

            // console.log(parseInt(panier[i].innerHTML))
            panier[i].innerHTML = count;
        }
    }else{

        let parentpanier = document.getElementsByClassName('fa-shopping-cart');

        for (let i = 0; i < parentpanier.length; i += 1) {

            // console.log(parseInt(panier[i].innerHTML))
            //   parentpanier[i].innerHTML = count;
            var newDiv = document.createElement("span");
            newDiv.className  ="badge badge-pill badge-danger";
            // et lui donne un peu de contenu
            var newContent = document.createTextNode(count);
            // ajoute le nœud texte au nouveau div créé
            newDiv.appendChild(newContent);


            // ajoute le nouvel élément créé et son contenu dans le DOM
            //   var currentDiv = document.getElementById('div1');
            parentpanier[i].parentNode.insertBefore(newDiv, parentpanier[i].nextSibling);



        }
    }
}

function updatePanier(newData) {
    let objpanier = document.getElementById('contenupanier');
    objpanier.innerHTML = newData;
}


function openNav() {
   // document.getElementById("sideNavigation").style.width = "30%";
    document.getElementById("sideNavigation").classList.add("widthcart");
}

function closeNav() {
    document.getElementById("sideNavigation").classList.remove("widthcart");
  //  document.getElementById("sideNavigation").style.width = "0";
}
function updateProduit(formproduitcc){

    //var dataToSend = document.querySelector("form").serialize();
    // console.log(event.target.action)
    const dataz = new FormData(formproduitcc);

 let formproduit = $(formproduitcc).serialize();


       // console.log(dataz);
     //   console.log(this.id);
       console.log(formproduitcc.elements.namedItem('id').value);
       const idprod = formproduitcc.elements.namedItem('id').value;
       const qteprod = parseInt(formproduitcc.elements.namedItem('qte['+idprod+']').value);
       console.log(formproduitcc.elements.namedItem('qte['+idprod+']').value);
    if(qteprod===0){
                        document.getElementById('prod'+idprod).remove();
                 }



    $.ajax({
        url: formproduitcc.action+'/json' ,
        type: "POST",
        dataType: 'json',
        data: formproduit
    }).done(function (response) {
        let resultat = 0;
        let prix = 0;
        let temp = "";
        $.each(response, function (key, val) {
            // console.log(val.qte);
            resultat += parseInt(val.qte);
            prix += parseFloat(val.prix) * parseInt(val.qte);
            let teste = `<p><img height='50px' src='/assets/src/${val.photo}' alt='${val.name}'> ${val.name}</p>
<p>Quantité : <span class='text-success'>${val.qte}</span>  Prix : <span class='text-success'>${val.prix}€</span></p><hr>`
            temp += teste;
        });
        let total = `<p>Total : <span class='text-success'>  ${prix} €</span> </p>
<p>   <a class="btn btn-success text-light" href="/paniers/">Voir le panier</a></p>`;
        temp = temp + total;
        // console.log(response);
        // console.log(prix);
        updateCountPanier(resultat)
        updatePanier(temp)

document.getElementById('totalpanier').innerHTML=prix+'€';

    });
}