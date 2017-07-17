var collectionCon = require('./controller/collectionCon.js');
var collectionMod = require('./model/collectionMod.js');
var path = require('path');
var session = require('express-session');
var express = require('express');
var app = express();
var bodyParser = require('body-parser');
const connectionString = "postgres://rsaqunjelkvsdo:7648ee0b4db9272f92569ecd81990d9914d10a26d525178126955c0c4f84325f@ec2-54-163-254-143.compute-1.amazonaws.com:5432/dbsuudb0akljb5";
var pg = require('pg');
var pgSession = require('connect-pg-simple')(session);
const ejsLint = require('ejs-lint');

const pgPool = new pg.Pool({
    connectionString: connectionString
});

//use
app.use(express.static(__dirname + '/view'));
app.use(bodyParser.json());       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
}));
app.use(session({
    store: new pgSession({
        pool : pgPool,                // Connection pool
    }),
    secret:'jokes on you',
    resave: false,
    saveUninitialized: false,
    cookie: { secure: false, maxAge: 30 * 24 * 60 * 60 * 1000 }
}));

//set
// views is directory for all template files
app.set('views', __dirname + '/view/pages');
app.set('view engine', 'ejs');
app.set('port', (process.env.PORT || 5000));


//route
app.get('/', function(req, res){
  res.sendFile(__dirname + '/view/upload.html');
});

app.post('/upload', collectionCon.handleImgUpload);
app.post('/login', collectionCon.handleLogin);
app.post('/register', collectionCon.handleRegistration);
// app.post('/add_collection', collectionCon.handleAddingCollection);
app.get('/manage_collection/:collection',collectionCon.handleSelectedCollection);
app.get('/view_collect', collectionCon.handleViewCollection);
app.get('/addPhotos', collectionCon.handleAddPhotos);
app.get('/uploadImg', collectionCon.handleImgUpload);
app.post('/update_order', collectionMod.updateImgOrder);
app.get('/album_sorting/:album', collectionCon.handleSelectedAlbum);



//listen
app.listen(app.get('port'), function(){
  console.log('Server listening on port ' + app.get('port'));
});
