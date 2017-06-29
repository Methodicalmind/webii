function handleImgUpload(req, res) {
  // creates form object to grab client image form object
  var form = new formidable.IncomingForm();

  // specify that we want to allow the user to upload multiple files in a single request
  form.multiples = true;

  // store all uploads in the following directory
  form.uploadDir = 'model/high_res';

  // every time a file has been uploaded successfully,
  // rename it to it's orignal name
  form.on('file', function(field, file) {
    fs.rename(file.path, path.join(form.uploadDir, file.name));
    imgMod.convertImage(file.name);
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

function handleAlbumDelete(req, res) {
    var album_name = req.params.id;

    var status = imgMod.deleteAlbum();
}

function handleCollectionPassword() {
    imgMod.setPassword(req, res);
}

function handleNewAlbum(req, res) {
    imgMod.addAlbum(req, res);
}

module.exports = {
	handleImgUpload: handleImgUpload,
    handleAlbumDelete: handleAlbumDelete,
    handleNewAlbum: handleNewAlbum,
    handleCollectionPassword: handleCollectionPassword
};
