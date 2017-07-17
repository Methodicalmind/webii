function deleteAlbum() {
    //confirm dialog box
    if (!confirm('This will remove all Images and Album. Are you sure?'))
        return;
    //grab id stored in album clicked then server side make the call and match the album up
    var id = this.getAttribute("album_id");
    update("/delete_album/" + id);
}

function setPassword() {
    //set collection password grab the id which is the order of displayed
    //grab the order server side and get the album that way
    var id = this.getAttribute("id");
    update("/set_collect_pass/" + id);
}

function addAlbum() {
    var name = document.getElementById("add_album").value;
    update("/add_album/" + name);
}

function getAlbumList(){
    update("/getAlbumList");
}

function getAlbumPhotos() {
    update("/getAlbumPhotos");
}
function addPhotos(){
    window.location.href("/upload");
}

function update(url){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // if(url.includes("/delete_album"))
            //  loadAlbumList(); //refresh album list on success
            // if(url.includes("/set_collect_pass"))
            //     alert(this.responseText);
            // if(url.includes("/add_album"))
            //     loadAlbumList(); //refresh album list on success
            // if(url.startsWith("getAlbumList";
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function displayAlbum(e) {
    var album = e.getAttribute("aname");
    window.location.href = "/album_sorting/" + album;
}

function onLoad() {
    //event listeners
    document.querySelector(".trash").addEventListener("click", deleteAlbum);
    document.querySelector(".lock").addEventListener("click", setPassword);
    document.getElementById("add_album").addEventListener("click", addAlbum);
}
