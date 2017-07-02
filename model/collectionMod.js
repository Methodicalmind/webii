var sharp = require('sharp');

function addAlbum() {
    //add new album to collection being modified
}

function setPassword() {
    //set a password on the selected collection
}

function deleteAlbum() {
    //remove selected album from db
    //remove images associated from high_res and from db
}



function convertImage(fileName){
    width(233, fileName);
    width(360, fileName);
    width(1600, fileName);
    console.log("completed - " + fileName);
}

function width(w, fileName) {
    var dir = "/img" + session.userId + "/" ;
    var newName;
    if(w == 1600)
        newName = "lg_" + fileName; //fullscreen
    else if(w == 360)
        newName = "med_" + fileName; //client view grid
    else
        newName = "sm_" + filename; //admin re-arrange/sort

    //convert image
    sharp(dir + fileName)
        .resize(w)
        .toFile(dir + newName)
}

module.exports = {
    convertImage: convertImage
};
