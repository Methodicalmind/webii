var sharp = require('sharp');
var fs = require('fs');
var uniqid = require('uniqid');
var bcrypt = require('bcrypt');
const {Pool} = require('pg');
const connectionString = "postgresql://taknodbgoebvpt:fffbe400853e7ca571a0c07a94e9e5036738722119095bd8ceabba2c50cfa7ab@ec2-50-17-217-166.compute-1.amazonaws.com:5432/d5hn8ij9iqfdpk";

const pool = new Pool({
    connectionString: connectionString
});

function queryDb(success, fail, queryString){
    pool.connect(function(err, client, done) {
        if (err) throw err;
        client.query(queryString, function(err, res) {
            done();
            if (err) {
                console.log(err.stack);
            } else {
                if(res) {
                    success(res);
                } else
                    fail();
            }
        });
    });
}

function updateImgOrder(req, res) {
    order = req.body.order;
    for(var i = 0; i < order.length; i++) {
        var file = order[i].split("/");
        console.log("file: " + file[3].substring(3));
        updateString = "UPDATE photo SET img_order = '" + i + "' WHERE file_name = '" + file[3].substring(3) + "';";
        queryDb(onSuccess, onFail, updateString);
    }
    res.send("completed");

    function onSuccess(data){
        //do nothing
    }
    function onFail(){
        res.send("failed to update order");
    }
}
function getAlbumList(successCallback, failCallback, collection) {
    var queryString = "SELECT a.name FROM album a JOIN collection c ON c.id = a.collection_id" +
                      " WHERE c.name = 'test_collection';";
    function onSuccess(res){
        successCallback(res.rows);
    }
    function onFail() { failCallback; }

    queryDb(onSuccess, onFail, queryString);
}

function getPhotosInAlbum (successCallback, failCallback, album) {
    var queryString = "SELECT p.file_name AS name FROM photo p JOIN album a ON a.id = p.album_id " +
        "WHERE a.name = '" + album + "' ORDER BY p.img_order;";
    // console.log(queryString);
    function onSuccess(res){
        successCallback(res.rows);
    }
    function onFail() { failCallback; }

    queryDb(onSuccess, onFail, queryString);
}
// function addAlbum() {
//     //add new album to collection being modified
// }
//
// function setPassword() {
//     //set a password on the selected collection
// }
//
// function deleteAlbum() {
//     //remove selected album from db
//     //remove images associated from high_res and from db
// }

function getCollectionList(successCallback, failCallback, username){
    queryString = "SELECT c.name FROM collection c " +
                    "JOIN \"user\" u ON c.user_id = u.id " +
                    "WHERE u.username = '" + username + "';";
    function success(res){
        console.log(res.rows);
        successCallback(res.rows);
    }
    function fail(){failCallback();}
    queryDb(success, fail, queryString);
}


//registration/login
function validate(successCallback, failedCallback, password, username){
    var queryString = 'SELECT salt FROM "user" WHERE username = \'' + username + '\';'
    function success(res){
        bcrypt.compare(password, res.rows[0].salt, function(err, res) {
            if(err) console.log(err);
            if (res) {
                successCallback();
            }
            else
                failedCallback();
        });
    }
    function fail() {
        failedCallback();
    }
    queryDb(success, fail, queryString)

}

function storeUser(success, fail, username, password){
    bcrypt.hash(password, 10, function(err, hash) {
        if(err) console.log(err);
        if(hash) {
            // Store hash in your password DB.
            // var insert = 'INSERT INTO "user" VALUES(' +
            //     'DEFAULT, \'' + username + '\',\'' + hash + '\');';
            var insert = 'SELECT * from "user"';
            queryDb(success, fail, insert);
        } else
            console.log("couldn't hash password");
    });
}

function checkName(username){
    //returns true if already exists or false if not
    var newName = true;
    var query = 'SELECT username FROM "user" WHERE username = \'' + username + '\';';
    return newName;
}

function createUserDir(req) {
    //create dir
    if (!fs.existsSync("../webii/img/" + req.session.userId)){
        fs.mkdirSync("../webii/img/" + req.session.userId);
    }
}
//end registration/login
//upload/image
function addPhotoToDB(successCallback, failCallback, filename, album){
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();

    var date = month + "-" + day + "-" + year;
    var file = filename.split('.');
    var newName = uniqid(file[0] + "_") + ".jpg";
    var queryString = "INSERT INTO photo VALUES (" +
                        "Default," +
                        "'" + filename + "'," +
                        "'" + newName + "'," +
                        "Default," +
                        "(SELECT id FROM album WHERE name = '" + album +"')," +
                        "'" + date + "'" +
                    ");";
    function onSuccess(res){
        successCallback(newName);
    }
    function onFail() { failCallback; }

    queryDb(onSuccess, onFail, queryString);
}
function convertImage(fileName, userId){
    console.log("file: " + fileName);
    console.log("id: " + userId);
    width(233, fileName, "sm_" + fileName, userId);
    width(360, fileName, "md_" + fileName, userId);
    width(1600, fileName, "lg_" + fileName, userId);
    console.log("completed - " + fileName);
}

function width(w, fileName, newName, userId) {
    var dir = "img/" + userId + "/" ;
    //convert image
    sharp(dir + fileName)
        .resize(w)
        .toFile(dir + newName)
}
//end upload image

module.exports = {
    convertImage: convertImage,
    validate: validate,
    storeUser: storeUser,
    checkName: checkName,
    createUserDir: createUserDir,
    getCollectionList: getCollectionList,
    getPhotosInAlbum: getPhotosInAlbum,
    getAlbumList: getAlbumList,
    addPhotoToDB: addPhotoToDB,
    updateImgOrder: updateImgOrder
};
