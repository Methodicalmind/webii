var collectionMod = require('../model/collectionMod.js');
var fs = require('fs');
var formidable = require('formidable');


//login

function handleLogin(req, res) {
    var username = req.body.username;
    var password = req.body.pass;
    function successLogin(){
        req.session.user = username;
        setUserId(req);
        res.redirect('/view_collect');
    }
    function failedLogin(){
        res.json('failed login');
    }

    collectionMod.validate(successLogin, failedLogin, password, username);
}
//end login
//registration
function handleUsernameAvailability(req, res){
    var username = req.body.username;
    if(!collectionMod.checkName(username)) {
        res.json("name taken");
        return;
    }
}

function setUserId (req){
    var username = req.session.user;
    username.toUpperCase();
    var sum = 0;
    for(var i = 0; i < username.length; i++){
        sum += username.charCodeAt(i);
    }
    req.session.userId = Math.pow(sum,2);
}

function handleRegistration(req, res) {
    var username = req.body.username;
    var password = req.body.pass;

    if(!collectionMod.checkName(username)) {
        res.json("name taken");
        return;
    }

    function successRegister(){
        req.session.username = username;
        setUserId(req);
        //make a folder of the username
        collectionMod.createUserDir(req);
        loadCollectionList(req, res);
    }
    function failedRegister(){
        res.json("failed to registered")
    }
    //salt the password
    //add user to database
    collectionMod.storeUser(successRegister, failedRegister, username, password);
}
function handleViewCollection(req, res){

    console.log(req.session.user);
    function onSuccess(collectionList) {
        console.log("collection List: " + collectionList);
        var data = {
            u: req.session.user,
            c: collectionList
        }
        res.render('admin/view_collect', data);
    }
    function onFail(){
        res.json("failed to load collections");
    }
    collectionMod.getCollectionList(onSuccess, onFail, req.session.user);
}
//end registration

//manage selected album
function handleSelectedAlbum(req, res) {
    var selectedAlbum = req.params.album;

    function photoSuccess(fileList) {
        req.session.aName = selectedAlbum;
        var data = {
            photos: fileList
        };
        res.render('partials/album_sort.ejs', data);
    }

    function onFail() {
        res.redirect('/manage_collection/' + req.session.cName);
        console.log("failed to load " + selectedAlbum);
    }

    collectionMod.getPhotosInAlbum(photoSuccess, onFail, selectedAlbum);
}
//end manage selected album

//manage selected collection
function handleSelectedCollection(req, res) {
    var selectedAlbum;
    var albumList;
    var photoList;
    var collect = req.params.collection;
    req.session.cName = collect;
    // console.log("userId: " + req.session.userId);
    function albumSuccess(returnedList){
        albumList = returnedList;
        selectedAlbum = albumList[0].name;
        collectionMod.getPhotosInAlbum(photoSuccess, onFail, selectedAlbum);
    }
    function photoSuccess(fileList) {
        photoList = fileList;
        req.session.aName = selectedAlbum;
        var data = {
            u: req.session.user,
            uid: req.session.userId,
            c: collect,
            selectedAlbum: selectedAlbum,
            aList: albumList,
            photos: photoList,
        };
        res.render('admin/manage_album', data);
        console.log(photoList);
        console.log(albumList);
    }
    function onFail() {
        res.redirect('/view_collect');
    }

    collectionMod.getAlbumList(albumSuccess, onFail, collect);
}

function handleAlbumDelete(req, res) {
//    var album_name = req.params.id;
//    var status = imgMod.deleteAlbum();
}

function handleCollectionPassword() {
//    imgMod.setPassword(req, res);
}

function handleNewAlbum(req, res) {
    // collectionMod.addAlbum(req, res);
}

function handleAddPhotos(req, res){
    function albumSuccess(returnedList) {
        var albumList = returnedList;
        var data = {
            u: req.session.user,
            uid: req.session.userId,
            selectedAlbum: req.session.aName,
            aList: albumList,
            c: req.session.cName
        }
        res.render('admin/upload_img', data);
    }
    function onFail() {
        res.redirect('/manage_collection/' + req.session.cName);
    }

    collectionMod.getAlbumList(albumSuccess, onFail, req.session.cName);
}

function handleImgUpload(req, res) {
    // creates form object to grab client image form object
    var form = new formidable.IncomingForm();

    // specify that we want to allow the user to upload multiple files in a single request
    form.multiples = true;

    // store all uploads in the following directory
    form.uploadDir = 'img/' + req.session.userId;

    // every time a file has been uploaded successfully,
    // rename it to random uniqueid with the leading filename
    form.on('file', function(field, file) {
        function onSuccess(newName) {
            fs.rename(file.path, form.uploadDir + "/" + newName, function() {
                collectionMod.convertImage(newName, req.session.userId);
            });
        }
        function onFail(){
            console.log("couldn't insert to db.")
        }
        collectionMod.addPhotoToDB(onSuccess, onFail, file.name, req.session.aName);
    });

    // log any errors that occur
    form.on('error', function(err) {
        console.log('An error has occured: \n' + err);
    });

    // once all the files have been uploaded, send a response to the client
    form.on('end', function() {
        res.end('success');
    });

    // parse the incoming request containing the form data
    form.parse(req);
}

module.exports = {
    handleImgUpload: handleImgUpload,
    handleAlbumDelete: handleAlbumDelete,
    handleNewAlbum: handleNewAlbum,
    handleCollectionPassword: handleCollectionPassword,
    handleLogin: handleLogin,
    handleRegistration: handleRegistration,
    handleSelectedCollection: handleSelectedCollection,
    handleViewCollection: handleViewCollection,
    handleAddPhotos: handleAddPhotos,
    handleSelectedAlbum: handleSelectedAlbum
};