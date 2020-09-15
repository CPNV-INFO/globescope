window.onload = function () {
 actualiser();
}

/**
 * actualise les boutons s'identifier/télécharger ainsi que les fichiers téléchargable en cliquant sur les liens
 */
function actualiser(){
 var identifiant = document.getElementById("identifiant").value;
 if (identifiant == "") {
  document.getElementById("bouton_poster_meridiens").innerHTML = '<div class="bouton_download_poster" onclick="posterFormulaire()"><a href="#" class="bouton_download_poster_p">Télécharger</a></div>';
  document.getElementById("bouton_poster_ellipse").innerHTML = '<div class="bouton_download_poster" onclick="posterFormulaire()"><a href="#" class="bouton_download_poster_p">Télécharger</a></div>';
  document.getElementById("bouton_poster_perso").innerHTML = '<div class="bouton_download_poster" onclick="posterFormulaire()"><a href="#" class="bouton_download_poster_p_souvenir">Télécharger</a></div>';
 } else {
  var lien_meri="poster_download_pictures/meridien/"+document.getElementById("choix_poster_meridien_date").value+"/"+document.getElementById("choix_poster_meridien_taille").value+".pdf";
  var lien_elip="poster_download_pictures/ellipse/"+document.getElementById("choix_poster_ellipse_date").value+"/"+document.getElementById("choix_poster_ellipse_taille").value+".pdf";
  document.getElementById("bouton_poster_meridiens").innerHTML = '<div class="bouton_download_poster"><a class="bouton_download_poster_p" href='+lien_meri+' '+'download>Télécharger</a></div>';
  document.getElementById("bouton_poster_ellipse").innerHTML = '<div class="bouton_download_poster"><a class="bouton_download_poster_p" href='+lien_elip+' '+'download>Télécharger</a></div>';
  document.getElementById("bouton_poster_perso").innerHTML = '<div class="bouton_download_poster"><input type="submit" class="bouton_download_poster_p_souvenir" value="Générer"></div>';
  document.getElementById("input_id_souvenir").disabled = false;
 }
}

/**
 * crée un formulaire qui demande de renseigner ses coordonnées à l'utilisateur
 */
function posterFormulaire(){
var formulaire = '<div class="masque_formulaire_poster"></div>\
<div id="formulaire_poster">\
	<div id="zone">\
		<h1>Entrez vos coordonnées</h1>\
		<h2>Pour télécharger le poster</h2>\
		<a href="https://www.edm.ch/fr/protection-donnees/">Protection des données</a>\
		<br>\
		<b id="champ_necessaire"><label class="asterisque">*</label>Champs nécessaires</b>\
			<form action="index.php" method="post">\
				<table border="0" cellspacing="0" cellpadding="0" align="center">\
				<tr>\
					<td>\
					<label>Titre</label>\
					<label class="asterisque">*</label>\
					</td>\
					<td class="radio">\
						<input type="radio" value="Monsieur" name="GENRE" required="required" id="mce-GENRE-0"><label>&nbsp;Monsieur</label>\
					</td>\
				</tr>\
				<tr>\
					<td colspan="1"></td>\
					<td>\
					<input type="radio" value="Madame" name="GENRE" required="required" id="mce-GENRE-1"><label>&nbsp;Madame</label>\
					</td>\
				</tr>\
				<tr>\
					<td colspan="1"></td>\
					<td>\
					<input type="radio" value="Autre" name="GENRE" required="required" id="mce-GENRE-2"><label>&nbsp;Autre</label>\
					</td>\
				</tr>\
				<tr>\
					<td class="label">\
					<label>Nom</label>\
					<label class="asterisque"></label>\
					</td>\
					<td colspan="3" class="champ">\
					<input type="text" value="" name="NOM" required="required" id="Nom" class="zone_champ">\
					</td>\
				</tr>\
				<tr>\
					<td>\
					<label>Prénom</label>\
					<label class="asterisque"></label>\
					</td>\
					<td colspan="3" class="champ">\
					<input type="text" value="" name="PRENOM" required="required" id="mce-PRENOM" class="zone_champ">\
					</td>\
				</tr>\
				<tr>\
					<td>\
					<label>Email</label>\
					<label class="asterisque">*</label>\
					</td>\
					<td colspan="3" class="champ">\
					<input type="email" value="" name="EMAIL" required="required" id="mce-EMAIL" class="zone_champ">\
					</td>\
				</tr>\
				<tr>\
					<td>\
					<label>Pays</label>\
					<label class="asterisque"></label>\
					</td>\
					<td colspan="3" class="champ">\
					<select name="PAYS" required="required" id="mce-PAYS" class="zone_champ">\
						<option value=""></option>\
						<option value="Afghanistan">Afghanistan </option>\
						<option value="Afrique_Centrale">Afrique Centrale </option>\
						<option value="Afrique_du_sud">Afrique du Sud </option>\
						<option value="Albanie">Albanie </option>\
						<option value="Algerie">Algerie </option>\
						<option value="Allemagne">Allemagne </option>\
						<option value="Andorre">Andorre </option>\
						<option value="Angola">Angola </option>\
						<option value="Anguilla">Anguilla </option>\
						<option value="Arabie_Saoudite">Arabie Saoudite </option>\
						<option value="Argentine">Argentine </option>\
						<option value="Armenie">Armenie </option>\
						<option value="Australie">Australie </option>\
						<option value="Autriche">Autriche </option>\
						<option value="Azerbaidjan">Azerbaidjan </option>\
						<option value="Bahamas">Bahamas </option>\
						<option value="Bangladesh">Bangladesh </option>\
						<option value="Barbade">Barbade </option>\
						<option value="Bahrein">Bahrein </option>\
						<option value="Belgique">Belgique </option>\
						<option value="Belize">Belize </option>\
						<option value="Benin">Benin </option>\
						<option value="Bermudes">Bermudes </option>\
						<option value="Bielorussie">Bielorussie </option>\
						<option value="Bolivie">Bolivie </option>\
						<option value="Botswana">Botswana </option>\
						<option value="Bhoutan">Bhoutan </option>\
						<option value="Boznie_Herzegovine">Boznie Herzegovine </option>\
						<option value="Bresil">Bresil </option>\
						<option value="Brunei">Brunei </option>\
						<option value="Bulgarie">Bulgarie </option>\
						<option value="Burkina_Faso">Burkina Faso </option>\
						<option value="Burundi">Burundi </option>\
						<option value="Caiman">Caiman </option>\
						<option value="Cambodge">Cambodge </option>\
						<option value="Cameroun">Cameroun </option>\
						<option value="Canada">Canada </option>\
						<option value="Canaries">Canaries </option>\
						<option value="Cap_vert">Cap Vert </option>\
						<option value="Chili">Chili </option>\
						<option value="Chine">Chine </option>\
						<option value="Chypre">Chypre </option>\
						<option value="Colombie">Colombie </option>\
						<option value="Comores">Colombie </option>\
						<option value="Congo">Congo </option>\
						<option value="Congo_democratique">Congo democratique </option>\
						<option value="Cook">Cook </option>\
						<option value="Coree_du_Nord">Coree du Nord </option>\
						<option value="Coree_du_Sud">Coree du Sud </option>\
						<option value="Costa_Rica">Costa Rica </option>\
						<option value="Cote_d_Ivoire">Côte d'+"'"+'Ivoire </option>\
						<option value="Croatie">Croatie </option>\
						<option value="Cuba">Cuba </option>\
						<option value="Danemark">Danemark </option>\
						<option value="Djibouti">Djibouti </option>\
						<option value="Dominique">Dominique </option>\
						<option value="Egypte">Egypte </option>\
						<option value="Emirats Arabes Unis">Emirats Arabes Unis </option>\
						<option value="Equateur">Equateur </option>\
						<option value="Erythree">Erythree </option>\
						<option value="Espagne">Espagne </option>\
						<option value="Estonie">Estonie </option>\
						<option value="Etats_Unis">Etats Unis </option>\
						<option value="Ethiopie">Ethiopie </option>\
						<option value="Falkland">Falkland </option>\
						<option value="Feroe">Feroe </option>\
						<option value="Fidji">Fidji </option>\
						<option value="Finlande">Finlande </option>\
						<option value="France">France </option>\
						<option value="Gabon">Gabon </option>\
						<option value="Gambie">Gambie </option>\
						<option value="Georgie">Georgie </option>\
						<option value="Ghana">Ghana </option>\
						<option value="Gibraltar">Gibraltar </option>\
						<option value="Grece">Grece </option>\
						<option value="Grenade">Grenade </option>\
						<option value="Groenland">Groenland </option>\
						<option value="Guadeloupe">Guadeloupe </option>\
						<option value="Guam">Guam </option>\
						<option value="Guatemala">Guatemala</option>\
						<option value="Guernesey">Guernesey </option>\
						<option value="Guinee">Guinee </option>\
						<option value="Guinee_Bissau">Guinee Bissau </option>\
						<option value="Guinee equatoriale">Guinee Equatoriale </option>\
						<option value="Guyana">Guyana </option>\
						<option value="Guyane_Francaise ">Guyane Francaise </option>\
						<option value="Haiti">Haiti </option>\
						<option value="Hawaii">Hawaii </option>\
						<option value="Honduras">Honduras </option>\
						<option value="Hong_Kong">Hong Kong </option>\
						<option value="Hongrie">Hongrie </option>\
						<option value="Inde">Inde </option>\
						<option value="Indonesie">Indonesie </option>\
						<option value="Iran">Iran </option>\
						<option value="Iraq">Iraq </option>\
						<option value="Irlande">Irlande </option>\
						<option value="Islande">Islande </option>\
						<option value="Israel">Israel </option>\
						<option value="Italie">italie </option>\
						<option value="Jamaique">Jamaique </option>\
						<option value="Jan Mayen">Jan Mayen </option>\
						<option value="Japon">Japon </option>\
						<option value="Jersey">Jersey </option>\
						<option value="Jordanie">Jordanie </option>\
						<option value="Kazakhstan">Kazakhstan </option>\
						<option value="Kenya">Kenya </option>\
						<option value="Kirghizstan">Kirghizistan </option>\
						<option value="Kiribati">Kiribati </option>\
						<option value="Koweit">Koweit </option>\
						<option value="Laos">Laos </option>\
						<option value="Lesotho">Lesotho </option>\
						<option value="Lettonie">Lettonie </option>\
						<option value="Liban">Liban </option>\
						<option value="Liberia">Liberia </option>\
						<option value="Liechtenstein">Liechtenstein </option>\
						<option value="Lituanie">Lituanie </option>\
						<option value="Luxembourg">Luxembourg </option>\
						<option value="Lybie">Lybie </option>\
						<option value="Macao">Macao </option>\
						<option value="Macedoine">Macedoine </option>\
						<option value="Madagascar">Madagascar </option>\
						<option value="Madère">Madère </option>\
						<option value="Malaisie">Malaisie </option>\
						<option value="Malawi">Malawi </option>\
						<option value="Maldives">Maldives </option>\
						<option value="Mali">Mali </option>\
						<option value="Malte">Malte </option>\
						<option value="Man">Man </option>\
						<option value="Mariannes du Nord">Mariannes du Nord </option>\
						<option value="Maroc">Maroc </option>\
						<option value="Marshall">Marshall </option>\
						<option value="Martinique">Martinique </option>\
						<option value="Maurice">Maurice </option>\
						<option value="Mauritanie">Mauritanie </option>\
						<option value="Mayotte">Mayotte </option>\
						<option value="Mexique">Mexique </option>\
						<option value="Micronesie">Micronesie </option>\
						<option value="Midway">Midway </option>\
						<option value="Moldavie">Moldavie </option>\
						<option value="Monaco">Monaco </option>\
						<option value="Mongolie">Mongolie </option>\
						<option value="Montserrat">Montserrat </option>\
						<option value="Mozambique">Mozambique </option>\
						<option value="Namibie">Namibie </option>\
						<option value="Nauru">Nauru </option>\
						<option value="Nepal">Nepal </option>\
						<option value="Nicaragua">Nicaragua </option>\
						<option value="Niger">Niger </option>\
						<option value="Nigeria">Nigeria </option>\
						<option value="Niue">Niue </option>\
						<option value="Norfolk">Norfolk </option>\
						<option value="Norvege">Norvege </option>\
						<option value="Nouvelle_Caledonie">Nouvelle Caledonie </option>\
						<option value="Nouvelle_Zelande">Nouvelle Zelande </option>\
						<option value="Oman">Oman </option>\
						<option value="Ouganda">Ouganda </option>\
						<option value="Ouzbekistan">Ouzbekistan </option>\
						<option value="Pakistan">Pakistan </option>\
						<option value="Palau">Palau </option>\
						<option value="Palestine">Palestine </option>\
						<option value="Panama">Panama </option>\
						<option value="Papouasie_Nouvelle_Guinee">Papouasie Nouvelle Guinee </option>\
						<option value="Paraguay">Paraguay </option>\
						<option value="Pays_Bas">Pays_Bas </option>\
						<option value="Perou">Perou </option>\
						<option value="Philippines">Philippines </option>\
						<option value="Pologne">Pologne </option>\
						<option value="Polynesie">Polynesie </option>\
						<option value="Porto_Rico">Porto_Rico </option>\
						<option value="Portugal">Portugal </option>\
						<option value="Qatar">Qatar </option>\
						<option value="Republique_Dominicaine">Republique Dominicaine </option>\
						<option value="Republique_Tcheque">Republique Tcheque </option>\
						<option value="Reunion">Reunion </option>\
						<option value="Roumanie">Roumanie </option>\
						<option value="Royaume_Uni">Royaume_Uni </option>\
						<option value="Russie">Russie </option>\
						<option value="Rwanda">Rwanda </option>\
						<option value="Sahara Occidental">Sahara Occidental </option>\
						<option value="Sainte_Lucie">Sainte_Lucie </option>\
						<option value="Saint_Marin">Saint_Marin </option>\
						<option value="Salomon">Salomon </option>\
						<option value="Salvador">Salvador </option>\
						<option value="Samoa_Occidentales">Samoa Occidentales</option>\
						<option value="Samoa_Americaine">Samoa Americaine </option>\
						<option value="Sao_Tome_et_Principe">Sao Tome et Principe </option>\
						<option value="Senegal">Senegal </option>\
						<option value="Seychelles">Seychelles </option>\
						<option value="Sierra Leone">Sierra Leone </option>\
						<option value="Singapour">Singapour </option>\
						<option value="Slovaquie">Slovaquie </option>\
						<option value="Slovenie">Slovenie</option>\
						<option value="Somalie">Somalie </option>\
						<option value="Soudan">Soudan </option>\
						<option value="Sri_Lanka">Sri Lanka </option>\
						<option value="Suede">Suede </option>\
						<option value="Suisse">Suisse </option>\
						<option value="Surinam">Surinam </option>\
						<option value="Swaziland">Swaziland </option>\
						<option value="Syrie">Syrie </option>\
						<option value="Tadjikistan">Tadjikistan </option>\
						<option value="Taiwan">Taiwan </option>\
						<option value="Tonga">Tonga </option>\
						<option value="Tanzanie">Tanzanie </option>\
						<option value="Tchad">Tchad </option>\
						<option value="Thailande">Thailande </option>\
						<option value="Tibet">Tibet </option>\
						<option value="Timor_Oriental">Timor Oriental </option>\
						<option value="Togo">Togo </option>\
						<option value="Trinite_et_Tobago">Trinite et Tobago </option>\
						<option value="Tristan da cunha">Tristan de cuncha </option>\
						<option value="Tunisie">Tunisie </option>\
						<option value="Turkmenistan">Turmenistan </option>\
						<option value="Turquie">Turquie </option>\
						<option value="Ukraine">Ukraine </option>\
						<option value="Uruguay">Uruguay </option>\
						<option value="Vanuatu">Vanuatu </option>\
						<option value="Vatican">Vatican </option>\
						<option value="Venezuela">Venezuela </option>\
						<option value="Vierges_Americaines">Vierges Americaines </option>\
						<option value="Vierges_Britanniques">Vierges Britanniques </option>\
						<option value="Vietnam">Vietnam </option>\
						<option value="Wake">Wake </option>\
						<option value="Wallis et Futuma">Wallis et Futuma </option>\
						<option value="Yemen">Yemen </option>\
						<option value="Yougoslavie">Yougoslavie </option>\
						<option value="Zambie">Zambie </option>\
						<option value="Zimbabwe">Zimbabwe </option>\
					</select>\
					</td>\
				</tr>\
				<tr>\
					<td id="checkbox_newletter">\
						<input type="checkbox" id="" name="NEWSLETTER" value="yes">\
					</td>\
					<td>\
						<label>Je souhaite recevoir la newsletter d\'Enfants du Monde </label>\
					<td>\
				</tr>\
				</table>\
				<button id="compte_existant" onclick="compteExistant()">Je suis déjà inscrit</button>\
				<br>\
				<div id="button">\
					<input type="submit" name="submit"  class="button" value="Valider">  \
					<input type="button" value="Annuler" class="button" onclick="annulerPosterFormulaire()">\
				</div>\
			</form>\
	</div>\
</div>';
 document.getElementById("nouveauFormulaire").innerHTML=formulaire;
}

/**
 * vide la div qui contient un formulaire
 */
function annulerPosterFormulaire(){
document.getElementById("nouveauFormulaire").innerHTML="";
}

/**
 * crée un formulaire qui demande de renseigner son mail, lorsque l'utilisateur à déjà un "compte"
 */
function compteExistant(){
var formulaire = '<div class="masque_formulaire_poster"></div>\
<div id="formulaire_poster">\
	<div id="zone">\
		<h1>Identifiez vous :</h1>\
			<form action="index.php" method="post">\
				<table border="0" cellspacing="0" cellpadding="0" align="center">\
				<tr>\
					<td>\
					<label>Email&nbsp;&nbsp;</label>\
					</td>\
					<td colspan="3" class="champ">\
					<input type="email" value="" name="EMAIL" required="required" id="mce-EMAIL" class="zone_champ">\
					</td>\
				</tr>\
				</table>\
				<br>\
				<div id="button">\
					<input type="submit" value="Valider" class="button">\
					<input type="button" value="Annuler" class="button" onclick="annulerPosterFormulaire()">\
				</div>\
			</form>\
	</div>\
</div>';
document.getElementById("nouveauFormulaire").innerHTML=formulaire;
}
