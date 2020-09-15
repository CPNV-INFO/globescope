/**Initialisation THREE JS */
var scene = new THREE.Scene();
var rendererW = window.innerWidth;
var rendererH = window.innerHeight;
var camera = new THREE.PerspectiveCamera(75, rendererW / rendererH, 0.1, 50000);
var camSpherical = new THREE.Spherical();
var camPos = new THREE.Vector3();
var renderer = new THREE.WebGLRenderer();
var controls = new THREE.OrbitControls(camera, renderer.domElement);
var raycaster = new THREE.Raycaster();
var mouse = new THREE.Vector2();
var data = [];

/*désactiver le déplacement pour le globe*/
controls.enablePan = false;
controls.enableDamping = true;
controls.minDistance = 2850;
controls.maxDistance = 5000;
controls.autoRotate = true;
/*Conteneur des détails de l'image recherchée //Onclick */
camera.position.z = 7000;

/*
var axisHelper = new THREE.AxisHelper( 10000 );
scene.add( axisHelper );
*/

/*Ajouer les élément principaux*/
renderer.setSize(rendererW, rendererH);

var geometry = new THREE.SphereGeometry(10000, 60, 40);

/*		SkyBox
    http://www.ianww.com/blog/2014/02/17/making-a-skydome-in-three-dot-js/
*/
var uniforms = {
    texture: {type: 't', value: THREE.ImageUtils.loadTexture('images/MilkyWay.jpg')}
};

var material = new THREE.ShaderMaterial({
    uniforms: uniforms,
    vertexShader: document.getElementById('sky-vertex').textContent,
    fragmentShader: document.getElementById('sky-fragment').textContent
});

skyBox = new THREE.Mesh(geometry, material);
skyBox.scale.set(-1, 1, 1);
skyBox.eulerOrder = 'XZY';
skyBox.renderDepth = 1000.0;
scene.add(skyBox);

/**Fin initialisation three JS */
var container = renderer.domElement;
container.id = "CanvContainer";
container.className = "canvas";
/**Tout les composant concernant la barre de recherche */
var showSearchButton = document.getElementById('showSearch');
showSearchButton.onload = showSearch;
showSearchButton.onclick = showSearch;

var SearchBox = document.getElementById('searchBar');
SearchBox.style.display = 'inline';

var xmlSearch;
var SearchTextBox = document.getElementById('searchText');


SearchTextBox.onfocus = function () {
    xmlSearch = new XMLHttpRequest();
}

var SearchButton = document.getElementById('searchButton');
var ReturnButton = document.getElementById('returnButton');
SearchButton.onclick = showSearchResults;
ReturnButton.onclick = showSearchResults;



var dynamicSearchResult = document.getElementById('onDynamicSearch');
dynamicSearchResult.style.display = 'none';

/**fin de la barre de recherche */

/**tout les composant concernant le sidebar */
var sideBar = document.getElementById('sideBar');
var closeSideBar = document.getElementById('closeSideBar');
var onClickDetails = document.getElementById('onClickDetails');
var onSearchDetails = document.getElementById('onSearchDetails');

var childImage = document.getElementById("childImage");
var childPseudo = document.getElementById("childPseudo");
var childCitation = document.getElementById("childCitation");
var childRight = document.getElementById("childRight");
var childEcole = document.getElementById("childEcole");
var childIDPlace = document.getElementById("childIDPlace");
var childEdit = document.getElementById("childEdit");
var childEquipe = document.getElementById("childEquipe");
var childVille = document.getElementById("childVille");
var childPays = document.getElementById("childPays");
var childMedia = document.getElementById("childMedia");
var childMedia2 = document.getElementById("childMedia2");
var childMedialink = document.getElementById("childMedialink");
var childAnneeprod = document.getElementById("childAnneeprod");
var childDesc = document.getElementById("childDesc");


childImage.onload = showOnClickDetails;
closeSideBar.onclick = hideSideBar;
sideBar.style.display = 'none';

/*Loader pour l'image*/
var imageLoader = document.getElementById("imageLoader");
imageLoader.className = "loader";
/**Fin des composant de la side Bar */

/* Div d'aide */
var helpDiv = document.getElementById('Help');
helpDiv.style.display = 'none';

var helpButton = document.getElementById('helpButton');
helpButton.style.display = 'block';
helpButton.onclick = showHelp;

/*Loader*/

window.addEventListener('resize', onWindowResize, false);
window.addEventListener("keydown", closeSideBarEsc);

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    container.onmousedown = onMouseDBClick;
} else {
    container.onmousedown = onMouseClick;
    container.onclick = onMouseDBClick;
}

container.onmousemove = onMouseMove;
document.body.onkeydown = checkEnter;
document.body.appendChild(container);

loadData(scene, container, controls);
animate();

//https://medium.com/@lachlantweedie/animation-in-three-js-using-tween-js-with-examples-c598a19b1263
function animateVector3(vectorToAnimate, target, options) {

    options = options || {};

    // get targets from options or set to defaults
    var to = target || THREE.Vector3(),
        easing = options.easing || TWEEN.Easing.Quadratic.In,
        duration = options.duration || 2000;

    // create the tween
    var tweenVector3 = new TWEEN.Tween(vectorToAnimate)
        .to({x: to.x, y: to.y, z: to.z,}, duration)
        .easing(easing)
        .onUpdate(function (d) {
            if (options.update) {
                options.update(d);
            }
        })
        .onComplete(function () {
            if (options.callback) options.callback();
        });

    // start the tween
    tweenVector3.start();

    // return the tween in case we want to manipulate it later on
    return tweenVector3;

}

function aideFr() {
    var credit = document.getElementById('creditBox');
    credit.style.display = 'none';
    var box = document.getElementById('box');
    box.style.display = 'flex';
    var deplacementSouris = document.getElementById('aideDeplacementSouris');
    deplacementSouris.textContent = "Faites tourner le globe en maintenant le clic gauche de la souris.";

    var aideZoom = document.getElementById('aideZoom');
    aideZoom.textContent = "Utilisez les touches +/- ou la molette de souris pour zoomer et dézoomer.";

    var aideAgrandirImage = document.getElementById('aideAgrandirImage');
    aideAgrandirImage.textContent = "Cliquez sur l’image pour l’agrandir et afficher ses informations.";

    var aideRecherche = document.getElementById('aideRecherche');
    aideRecherche.textContent = "Cherchez une photo et ses informations en insérant un mot-clé dans l’outil de recherche : pays, ville, droit, équipe, pseudo, école, enquête, classe…";
}


function credit() {
    var aide = document.getElementById('box');
    aide.style.display = 'none';

    var credit = document.getElementById('creditBox');
    credit.style.display = 'block';

    var groupeMembresContenu = document.getElementById('groupeMembresContenu');
    groupeMembresContenu.textContent = "Schneiter Raphael, Ristic Vojislav, Janssens Emmanuel, Bompard Corentin, Petit Maylis, Pittet Valentin, Houlmann Gildas, Herzig Melvyn, Gianinetti Lucas."
}

function closeSideBarEsc(e) {
    if (sideBar.style.display != 'none') {
        if (e.keyCode == 27) {
            hideSideBar();
        }
    }
    if (helpDiv.style.display != 'none') {
        if (e.keyCode == 27) {
            closeHelp();
        }
    }
}

function showSearch() {
    SearchBox.style.display = 'flex';
    showSearchButton.style.display = 'none';
    SearchBox.className = "GUI w3-animate-top";
    SearchTextBox.focus();
}

function hideSearch() {
    SearchBox.style.display = 'none';
    showSearchButton.style.display = 'block';
}

function showHelp() {
    helpDiv.style.display = 'block';
    helpDiv.className = "GUI w3-animate-left";

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        container.onmousedown = null;
        helpButton.style.display = 'none';
        showSearchButton.style.display = 'none';
    }
}

function closeHelp() {
    helpDiv.style.display = 'none';
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

        container.onmousedown = onMouseDBClick;
        helpButton.style.display = 'block';
        showSearchButton.style.display = 'block';
    }
}



function showSearchResults() {

    if (SearchTextBox.value != "") {
        searchChild(camera, scene);
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            showSearchButton.style.display = 'none';
            helpButton.style.display = 'none';
        } else {
            showSearchButton.style.display = 'block';
        }

        onClickDetails.style.display = 'none';
        onSearchDetails.style.display = 'flex';

        imageLoader.style.display = 'none';
        var nodes = onSearchDetails.childNodes;
        var i = 0;
        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].style != null)
                nodes[i].style.display = "block";
        }
    }else{

            alert("Vous n'avez pas fait de recherche...")

    }
}

function showOnClickDetails() {
    onSearchDetails.style.display = 'none';
    onClickDetails.style.display = 'flex';

    imageLoader.style.display = 'none';
    var nodes = onClickDetails.childNodes;
    var i = 0;
    for (i = 0; i < nodes.length; i++) {
        if (nodes[i].style != null)
            nodes[i].style.display = "flex";
    }
}

function hideSideBar() {
    sideBar.style.display = 'none';
    sideBar.className = "";
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        container.onmousedown = onMouseDBClick;
        helpButton.style.display = 'block';
        showSearchButton.style.display = 'block';
    }
}

function showSideBar() {
    imageLoader.style.display = 'block';


    sideBar.className = "GUI w3-animate-right";
    sideBar.style.display = 'block';

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        if (helpDiv.style.display != "none") {
            helpDiv.style.display = "none";
        }
        container.onmousedown = null;
        helpButton.style.display = 'none';
        showSearchButton.style.display = 'none';

    }


}

function checkEnter(e) {
    if (SearchBox.style.display != "none") {
        if (e.keyCode == 13) {
            showSearchResults();
        }
    }
}

function onWindowResize() {
    rendererW = window.innerWidth;
    rendererH = window.innerHeight;
    camera.aspect = rendererW / rendererH;
    camera.updateProjectionMatrix();
    renderer.setSize(rendererW, rendererH);
}

function onMouseMove(event) {

    mouse.x = (event.clientX / rendererW) * 2 - 1;
    mouse.y = -(event.clientY / rendererH) * 2 + 1;
}

function onMouseClick(event) {
    if (controls.autoRotate) {
        controls.autoRotate = false;
    }
}

function onMouseDBClick(event) {

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        if (controls.autoRotate) {
            controls.autoRotate = false;
        }
    }
    mouse.x = (event.clientX / rendererW) * 2 - 1;
    mouse.y = -(event.clientY / rendererH) * 2 + 1;
    switch (event.button) {
        case 0:
            // update the picking ray with the camera and mouse position
            raycaster.setFromCamera(mouse, camera);

            // calculate objects intersecting the picking ray
            var intersects = raycaster.intersectObjects(scene.children);

            if (intersects.length > 0) {
                if (intersects[0].object.type == "VRAI") {

                    onImageClick(intersects[0].object.name);
                }
            }
            break;
        case 2:
            break;
        default:
            break;
    }
}

function distanceVector(v1, v2) {
    var dx = v1.x - v2.x;
    var dy = v1.y - v2.y;
    var dz = v1.z - v2.z;

    return Math.sqrt(dx * dx + dy * dy + dz * dz);
}

function animate() {
    setTimeout(function () {
        requestAnimationFrame(animate);
        TWEEN.update();
        controls.update();
    }, 1000 / 30);

    render();
}

function render() {
    controls.rotateSpeed = 0.1 / (10000 / distanceVector(camera.position, new THREE.Vector3(0, 0, 0)));
    // update the picking ray with the camera and mouse position
    raycaster.setFromCamera(mouse, camera);
    // calculate objects intersecting the picking ray
    var intersects = raycaster.intersectObjects(scene.children);
    if (intersects.length > 0) {
        container.style.cursor = "pointer";
    } else {
        container.style.cursor = "default";
    }
    renderer.render(scene, camera);
}

