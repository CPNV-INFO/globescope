document.addEventListener("DOMContentLoaded", init);
function init() {
    UnlockallCMD.addEventListener('click',windowsconfirm);
    cmd_uploadway.addEventListener('click',upload)
}
function upload() {
    var o = confirm("Si vous continuer, les lien et titre déja présent du média seront écrasés. Voulez-vous vraiment continuer ?");
    if (o == true) {
        window.$_GET = location.search.substr(1).split("&").reduce((o,i)=>(u=decodeURIComponent,[k,v]=i.split("="),o[u(k)]=v&&u(v),o),{});
        var link ="index.php?action=uploadmedia&IDimage=";
        link+=$_GET['IDimage'];
        window.open(link);
        window.close();

    }

}
function windowsconfirm() {
    var r = confirm("Voulez vous vraiment activer la modification des options de positionnement de l'image ?");
    if (r == true) {
        unlock();
    }else{
        lock();
    }

}

function unlock() {
    meridien.disabled = false;
    latitude.disabled = false;
    longitude.disabled = false;
    idplace.disabled = false;
    idimage.disabled = false;
}
function lock() {
    meridien.disabled = true;
    latitude.disabled = true;
    longitude.disabled = true;
    idplace.disabled = true;
    idimage.disabled = true;
}

