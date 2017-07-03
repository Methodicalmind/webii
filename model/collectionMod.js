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

function validate(password){
    var queryString = 'SELECT salt FROM "user" WHERE name = "' + userName + '";'
    pool.connect((err, client, done) => {
        if (err) throw err
        client.query(queryString (err, res) => {
        done();
        if (err) {
            console.log(err.stack);
        } else {
            console.log(res.rows[0]);
        }
        });
    });
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
        newName = "sm_" + fileName; //admin re-arrange/sort

    //convert image
    sharp(dir + fileName)
        .resize(w)
        .toFile(dir + newName)
}

module.exports = {
    convertImage: convertImage
};
