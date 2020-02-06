
var allowedKeysq = {// ok modif
    76: 'l',
    79: 'o',
    71: 'g',
    73: 'i',
    78: 'n',


};

// the 'official' Konami Code sequence
var konamiCodeq = ['l', 'o', 'g', 'i', 'n',];//ok modif

// a variable to remember the 'position' the user has reached so far.
var konamiCodePositionq = 0;//ok modif

// add keydown event listener
document.addEventListener('keydown', function(e) {
    // get the value of the key code from the key map
    var keyq = allowedKeysq[e.keyCode];//ok modif
    // get the value of the required key from the konami code
    var requiredKeyq = konamiCodeq[konamiCodePositionq];//ok modif

    // compare the key with the required key
    if (keyq == requiredKeyq) {

        // move to the next key in the konami code sequence
        konamiCodePositionq++;

        // if the last key is reached, activate cheats
        if (konamiCodePositionq == konamiCodeq.length) {
            login();
            konamiCodePositionq = 0;
        }
    } else {
        konamiCodePositionq = 0;
    }
});
function login() {
    //chose a faire apres le code
    k.classList.add('k') 
}