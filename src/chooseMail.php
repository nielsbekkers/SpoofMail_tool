<?php

$_SESSION["gmail"] = $_POST['gmail'];
$_SESSION['password'] = $_POST['wachtwoordGmail'];

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/mainAction.css">
</head>
<body onload="myFunction()">
	<div id="loader"></div>
</body>
<script>
        var myVar;

        function myFunction() {
            myVar = setTimeout(show, 1000);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }

        function show(){
        	window.location = "http://localhost/spoofmail_tool/src/spoofemailtool.html";
        }
    </script>
</html>