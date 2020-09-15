
//Requete XMLHTTP pour récupéerer des détails d'un enfant
//en paramètre (x) l'ID de l'image recherché
function onImageClick(x)
{
    var obj, dbParam, xmlhttp, myObj;
    obj = { "ID":x};
    dbParam = JSON.stringify(obj);


    xmlhttp = new XMLHttpRequest();
    //Declaré dans index2.php
    showSideBar();
    onSearchDetails.innerHTML = "";

    //Quand la requête xml à été exécuté
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            if(this.responseText != "")
            {
                //convertit les données reçues depuis le fichier PHP correspondent (JsonEncode)
                myObj = JSON.parse(this.responseText);

                //Si l'image existe
                if(myObj.ImageOK != 0)
                {

                    //Ensuite remplir (le pseudo reste tout le temps)
                    var details =  document.getElementById("onClickDetails").childNodes;
                    childImage.src = "images/400-500/"+myObj.IDImage+".jpg";
                    childPseudo.textContent =myObj.Pseudo;

                    delLineTable("tbl_details", "Slogan");
                    delLineTable("tbl_details", "Droit");
                    delLineTable("tbl_details", "Equipe");
                    delLineTable("tbl_details", "Ecole");
                    delLineTable("tbl_details", "Pays");
                    delLineTable("tbl_details", "Ville");

                    if (myObj.Ville.length>1) addLineTable("tbl_details",1,"Ville",myObj.Ville);
                    //childVille.textContent =myObj.Ville;
                    if (myObj.Pays.length>1) addLineTable("tbl_details",1,"Pays",myObj.Pays);
                    //childPays.textContent = myObj.Pays;
                    if (myObj.ecole.length>1) addLineTable("tbl_details",1,"Ecole",myObj.ecole);
                    //childEcole.textContent = myObj.ecole;
                    if (myObj.Team.length>1) addLineTable("tbl_details",1,"Equipe",myObj.Team);
                    //childEquipe.textContent = myObj.Team;
                    if (myObj.Droit.length>1) addLineTable("tbl_details",1,"Droit",myObj.Droit);
                    //childRight.textContent = myObj.Droit;
                    if (myObj.Slogan.length>1) addLineTable("tbl_details",1,"Slogan",myObj.Slogan);
                   //childCitation.textContent =  myObj.Slogan;


                    childAnneeprod.textContent =  myObj.Anneeprod;
                    childMedia.textContent = myObj.Titre;
                    childDesc.textContent =  myObj.desc;
                    childMedia.href = myObj.Media;
                    childMedia2.textContent + myObj.Media;
                    childIDPlace.textContent = myObj.IDPlace;
                    childEdit.href = "?action=editchild&IDimage="+myObj.IDImage;

                }
            }
        }
    }

    //exécuter la requete en mode POST avec les paramètres voulus (x) => ID
    xmlhttp.open("POST", "index.php?action=GetData", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("x=" + dbParam +"&Mode=click");

}

function addLineTable(tableau, pos, v1, v2)
{ // Cette fonction insère 2 cellules comme une nouvelle ligne dans un tableau
    if (pos>=0){
        var newRow = document.getElementById(tableau).insertRow(pos);
    } else{
        var newRow = document.getElementById(tableau).insertRow();
    }
    var newCell = newRow.insertCell(0);
    newCell.innerHTML = v1;
    newCell = newRow.insertCell(1);
    newCell.innerHTML = v2;
}

function delLineTable(tableau, titre_ligne){
    //Cette fonction détruit une ligne d'après son nom (ex Pseudo)
    //D'abord vider le tableau
    //On renvoie la ligne détruite pour pouvoir la réintroduire
    var ligne=-1;
    var table = document.getElementById(tableau);
    var rowCount = table.rows.length;
    for (var i = 1; i < rowCount-2; i++) {
        if (table.rows[i].cells[0].textContent == titre_ligne) {
            ligne=i;
        }
    }
    if (ligne>0) {
        table.deleteRow(ligne);
       // alert("je détruis la ligne " + ligne + " " + titre_ligne);
    }
    return ligne;

}

