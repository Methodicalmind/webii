var sharp = require('sharp');

function convertImage(fileName){
    width(233, fileName);
    width(360, fileName);
    width(1600, fileName);
    console.log("completed - " + fileName);
}

function width(w, fileName) {
    var dir;
    if(w == 1600)
        dir = __dirname + "/fs/"; //fullscreen
    else if(w == 360)
        dir = __dirname + "/grid/"; //client view grid
    else
        dir = __dirname + "/sort/"; //admin re-arrange/sort

    //convert image
    sharp(__dirname + "/high_res/" + fileName)
        .resize(w)
        .toFile(dir + fileName)
}

module.exports = {
    convertImage: convertImage
};
