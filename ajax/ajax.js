function loading(button) {
  document.getElementById(button).innerHTML =
    "<button type='button' class='btn btn-success disabled'><i class='fa fa-circle-notch fa-spin fa-1x'></i></span> Loading, please wait...</button>";
}

function reload(response, action) {
  $(document).ready(function() {
    setInterval(function() {
      $("#" + response).load(action);
    }, 2000);
  });
}

function form_process(form, action, response) {
  $(document).ready(function(e) {
    $("#" + form).on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: action,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          $("#" + response).html(data);
        },
        error: function() {}
      });
    });
  });
}
// preview of image and video
function preview_img(input, preview, txt_preview, response, type) {
  if (input.files && input.files[0]) {
    if (type == "image") {
      var reader = new FileReader();
      reader.onload = function(e) {
        $("#" + preview).attr("src", e.target.result);
        $("#" + response).show();
        document.getElementById(txt_preview).innerHTML = input.files[0].name;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
}

function preview_imgs(input, preview, response) {
  if (input.files) {
    var inputlength = input.files.length;

    for (var i = 0; i < inputlength; i++) {
      var reader = new FileReader();
      reader.onload = function(event) {
        $($.parseHTML('<img class="img-responsive img-rounded margin-bottom">'))
          .attr("src", event.target.result)
          .appendTo(response);
      };
    }
    reader.readAsDataURL(input.files[i]);
  }
}

function preview_vid(input, txt_preview, response, type) {
  if (input.files && input.files[0]) {
    if (type == "video") {
      $("#" + response).show();
      document.getElementById(txt_preview).innerHTML = input.files[0].name;
    }
  }
}
// cancel preview of image and video
function close_preview(input, container) {
  document.getElementById(input).value = "";
  document.getElementById(container).style = "display:none";
}
// response immediately
function load_process(response, action) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById(response).innerHTML = xmlhttp.responseText;
    }
  };
  xmlhttp.open("GET", action, true);
  xmlhttp.send();
}
