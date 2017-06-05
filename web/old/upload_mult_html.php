<html lang="en">
<head>
  <meta charset="UTF-8" />
    <script src="../js/jquery.min.js"></script>
    <style>
        #drop_zone {
            border: 2px dashed #bbb;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            padding: 25px;
            text-align: center;
            font: 20pt bold 'Vollkorn';
            color: #bbb;
        }
        #img_preview img {
            height: 100px;
            width: auto;
        }
    </style>
</head>
<body>
    <div id="drop_zone">Drop files here</div>
    <div class="progress progress-striped active" role="progressbar"
        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
      <div class="progress-bar progress-bar-success" style="width:0%;"></div>
    </div><br/>
    <table id="img_preview"></table>


    <!-- jQuery Library-->
    <script type="text/javascript" src="../js/jquery.min.js"></script>

    <!-- jQuery Form Plug in -->
    <script type="text/javascript" src="../js/jquery.form.min.js"></script>

    <!-- our main javascript file -->
    <script>
        $(document).ready(function() {
          /* variables */
          var preview = $('img');
          var status = $('.status');
          var percent = $('.percent');
          var bar = $('.bar');
            $('#submit_upload').ajaxForm({
                /* set data type json */
                dataType:  'json',
                /* reset before submitting */
                beforeSend: function() {
                  document.querySelector(".progress-bar").style.width = 0 + '%';
                },
                /* progress bar call back*/
                uploadProgress: function(event, position, total, percentComplete) {
                  var pVel = percentComplete + '%';
                  document.querySelector(".progress-bar").style.width = pVal;
                },
                /* complete call back */
                complete: function(data) {
                  preview.fadeOut(800);
                  status.html(data.responseJSON.status).fadeIn();
                }

            });
        });
    </script>
    <script>
      function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        for (var i = 0; i < files.length ; i++) {
            var fr = new FileReader();
            var file = files[i];
            fr.onload = (function(e) {
                   alert(file.fileName);
//                 $("#img_preview").append('<div class="dataurl"><strong>' + file.fileName + '</strong>' + e.target.result + '</div>')
               };
            })(file);
            fileReader.readAsDataURL(file);
        });
//        var files = evt.dataTransfer.files; // FileList object.

//        for (var i = 0; i < files.length ; i++) {
//            var fr = new FileReader();
//            var build = '"></td><td>' + files[i].name + '</td><td>' +
//            '<button class="btn btn-danger" id="remove">remove</button></td></tr>';
//            fr.readAsDataURL(files[i]);
//            fr.onload = (function(i) {
//               return function(e) {
//                 body.append('<div class="dataurl"><strong>' + i.fileName + '</strong>' + e.target.result + '</div>')
//               };
//            })(file);
//            fr.onload = function(e) {
//                alert(e.target.result);
//            }
//        }
        // files is a FileList of File objects. List some properties.
//        var output = [];
//        for (var i = 0, f; f = files[i]; i++) {
//          output.push('<div>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
//                      f.size, ' bytes, last modified: ',
//                      f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
//                      '</li>');
//        }
//        document.getElementById('list').innerHTML = '<table>' + output.join('') + '</table>';
      }

      function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
      }

      // Setup the dnd listeners.
      var dropZone = document.getElementById('drop_zone');
      dropZone.addEventListener('dragover', handleDragOver, false);
      dropZone.addEventListener('drop', handleFileSelect, false);
    </script>
</body>
</html>
