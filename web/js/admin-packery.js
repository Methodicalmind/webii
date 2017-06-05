// external js: packery.pkgd.js, draggabilly.pkgd.js
var list=new Array;
var select_count = 0;
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
  });
}

$("#save_order").click(function() {
    orderItems();
    var img_order = [];

    //iterates through each input field and pushes the name to the array
//    $('div', $('.grid')).each(function() {
//
//    });


//    $.each( $('.grid'), function(i, grid) {
//       $('div', grid).each(function() {
//            console.log($(Object).attr('id'));
//            img_order.push(id);
//       });
//    });

});

$('#add_photos').click( function () {
    $.ajax({
        url: "upload_img.php",
        success: function (data) {
            $(".loaded_php").html(data);
        },
        error: function(data){
            alert("error file could not be loaded");
        }
    });
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
