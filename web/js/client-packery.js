// overwrite Packery methods
var __resetLayout = Packery.prototype._resetLayout;
Packery.prototype._resetLayout = function() {
  __resetLayout.call( this );
  // reset packer
  var parentSize = getSize( this.element.parentNode );
  var colW = this.columnWidth + this.gutter;
  this.fitWidth = Math.floor( ( parentSize.innerWidth + this.gutter ) / colW ) * colW;
  console.log( colW, this.fitWidth )
  this.packer.width = this.fitWidth;
  this.packer.height = Number.POSITIVE_INFINITY;
  this.packer.reset();
};


Packery.prototype._getContainerSize = function() {
  // remove empty space from fit width
  var emptyWidth = 0;
  for ( var i=0, len = this.packer.spaces.length; i < len; i++ ) {
    var space = this.packer.spaces[i];
    if ( space.y === 0 && space.height === Number.POSITIVE_INFINITY ) {
      emptyWidth += space.width;
    }
  }

  return {
    width: this.fitWidth - this.gutter,
    height: this.maxY - this.gutter
  };
};

// always resize
Packery.prototype.resize = function() {
  this.layout();
};

var $grid = $('.grid-client').packery({
  itemSelector: '.grid-item-client',
  gutter: 8,
  columnWidth: 360
});

$(".close").click(function(){
    document.getElementById("fullscreen").style.display = "none";
});

$("li").click(function(){
    $(this).siblings().removeClass("active");
    $(this).addClass("active");
    var a_id = $(this).attr("album-id");
    selectAlbum(a_id);
});

$("img").click(function(){
//    var img = e.getAttribute("src");
    var img = $(this).attr("src");
    document.getElementById("fill_img").setAttribute("src",img);
    document.getElementById("fullscreen").style.display = "block";
});
