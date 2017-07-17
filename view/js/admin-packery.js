// external js: packery.pkgd.js, draggabilly.pkgd.js
var list= new Array;
var select_count = 0;
var order= new Array;
var $grid = $('.grid').packery({
  itemSelector: '.grid-item',
  gutter: 12,
  columnWidth: 233
});

// make all grid-items draggable
$grid.find('.grid-item').each( function( i, gridItem ) {
  var draggie = new Draggabilly( gridItem );
  // bind drag events to Packery
  $grid.packery( 'bindDraggabillyEvents', draggie );
});

// show item order after layout
function orderItems() {
  var itemElems = $grid.packery('getItemElements');
  $( itemElems ).each( function( i, itemElem ) {
    $(itemElem).attr("id", i + 1);
      var img = $(itemElem).children("img").attr("src");
      order.push(img);
  });
}

$("#save_order").click(function() {
    orderItems();
    var update_order = $.ajax({
        type: 'post',
        url: '/update_order',
        data: {order: order}
    });
    update_order.done(function(data) {
        alert("order updated successfully");
    });
    update_order.fail(function(data){
        alert("couldn't save img order");
    });
});

$('#add_photos').click( function () {
    window.location.href = "/addPhotos";
});

$('.grid-item').dblclick(function() {
    var item = $(this).attr("class");
    var img_src = $(this).find('img:first').attr('src');
    if("grid-item" == item) {
        $(this).addClass("selected");
        list.push(img_src);
        select_count++;
    }
    else {
        $(this).removeClass("selected");
        var index = list.indexOf(img_src);
        if(index >= 0) {
            list.splice(index, 1);
        }
    }

    if(list.length == 1) {
        document.getElementById('make-cover-photo').style.display = "block";
        document.getElementById('delete_selected').style.display = "block";
    }
    if(list.length >= 2) {
        document.getElementById('make-cover-photo').style.display = "none";
    }
    if(list.length == 0) {
        document.getElementById('delete_selected').style.display = "none";
        document.getElementById('make-cover-photo').style.display = "none";
    }
    console.log(select_count);
});

$('#delete_selected').click(function() {
        if(list.length == 0){
            alert("no images selected for delete");
            return;
        }
        if(list.length > 50) {
            alert("to many images selected can only delete 50 images at a time");
            return;
        }
        if (!confirm('Are you sure you want to delete these images?')) {
            return;
        }
        $.ajax({
            type: 'post',
            url: 'delete_imgs.php',
            data: {img_delete: list},
            success: function (data) {
                alert(data);
                location.reload();
            },
            error: function(data){
                alert("error check network connection");
            }
        });
});
