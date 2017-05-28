<html>
    <head>
        <title>FireLogic</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="command.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            tr:hover {background-color: #f5f5f5}
            th {
                background-color: #e5e5e5;
                color: black;
           }
            body {
                background-color: #efe8e8;
            }
            .container-fluid{
              background-color: #c90202;
            }
            a {
              color: white !important;
            }

        </style>
        <script>
            function get(name){
                if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
                return decodeURIComponent(name[1]);
            }
            function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}
            function init() {
                var department = get("dept");
                var incident = get("incident");
                if (incident == 0) {
                    document.getElementById("fire_people").style.display = "none";
                }
                else {
                    document.getElementById("startinc").disabled = true;
                    document.getElementById("endinc").disabled = false;
                    alert("YOU HAVE AN INCIDENT ACTIVE. DO NOT LEAVE THIS PAGE UNTIL YOU HAVE CLOSED THE INCIDENT.");
                    
                }
            }
            
            function startincident() {
                var department = get("dept");
                post("server/startincident.php", {"department_id": department});
            }
            
            function endincident() {
                var department = get("dept");
                var incident = get("incident");
                post("server/endincident.php", {"department_id": department, "incident_id": incident});
            }
        </script>
    </head>
    <body onload="init()">

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
FireLogic</a>
        </div>
      </div>
      </nav>
        <button class="btn btn-danger btn-lg" id="startinc" onclick="startincident()">Start Incident</button>
        <table class="table" id="fire_people">
  <thead>
    <tr>
      <th>Name</th>
      <th>In Time</th>
      <th>Out</th>
      <th>Rehab</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      
      ?>
    <tr>
      <th scope="row">User 1</th>
      <td><button class="btn btn-warning">In </button></td>
      <td><button class="btn btn-warning">Out</button></td>
        <td><i class="material-icons" style="color: red;">&#xE5CD;</i></td>
    </tr>
    <tr>
      <th scope="row">User 2</th>
      <td><button class="btn btn-warning">In </button></td>
      <td><button class="btn btn-warning">Out</button></td>
        <td><i class="material-icons" style="color: green;">&#xE876;</i></td>
    </tr>

  </tbody>
</table>


<button id="endinc" class="btn btn-danger btn-lg" disabled onclick="endincident()">End Incident</button>



    </body>
</html>
