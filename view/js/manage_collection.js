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

function update(url){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     if(url.includes("/delete_album"))
        loadAlbumList(); //refresh album list on success
     if(url.includes("/set_collect_pass"))
        alert(this.responseText);
     if(url.includes("/add_album"))
        loadAlbumList(); //refresh album list on success
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function loadAlbumList(){
    //every time this loads number the items and store that number in id
   alert("refeshed album list");
}
// $('#add_collection.ejs').on('submit', function (e) {
//     e.preventDefault();
//     var cn = $('#collection_name').val();
//     var an = $('album_name').val();
//     if(cn == '') {
//         alert("Collection Name cannot be left blank.");
//         return;
//     }
//     if(an == '')
//         an.val() = "Proofs";
//
//     var formData = new FormData(this);
//     $.ajax({
//         type: 'POST',
//         url: $(this).attr('action'),
//         cache:false,
//         contentType: false,
//         processData: false,
//         data: formData,
//         success: function (data) {
//             document.getElementById('overlay').style.display = "none";
//             document.getElementById('overlay-form').style.display = "none";
//             document.getElementById('add_collection.ejs').reset();
//             window.location.href = "manage_collection.php";
// //                    alert(data);
//         },
//         error: function(data){
//             document.getElementById('overlay').style.display = "none";
//             document.getElementById('overlay-form').style.display = "none";
//             document.getElementById('add_collection.ejs').reset();
//             alert("an error occured: " + data);
//             window.location.href = "collections.php";
//         }
//     });
// });

function onLoad() {
    //event listeners
    document.querySelector(".trash").addEventListener("click", deleteAlbum);
    document.querySelector(".lock").addEventListener("click", setPassword);
    document.getElementById("add_album").addEventListener("click", addAlbum);
}
