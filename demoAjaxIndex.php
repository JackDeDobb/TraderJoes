<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pass Data to PHP using AJAX without Page Load</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script
      src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  </head>
  <body>
<div class="container">
<h2>Enter Some Data Pass to PHP File</h2>
  <div class="row">
    <div class="col-md-3">
      <form>
        <div class="form-group">

          <input type="text" id="pass_data" value="" onblur="passData();" class=" form-control">
          <br>
          <p id="message"></p>
        </div>

      </form>

    </div>

  </div>

</div>

</body>

<script type="text/javascript">

  function passData() {
var name = document.getElementById("pass_data").value;
var dataString = 'data_to_be_pass=' + name;
if (name == '') {
alert("Please Enter the Anything");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "pass-data.php",
data: dataString,
cache: false,
success: function(data) {
$("#message").html(data);
$("p").addClass("alert alert-success");
},
error: function(err) {
alert(err);
}
});
}
return false;
}

  </script>
</html>
