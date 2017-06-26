<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Wróblewski Piotr - GOG API test</title>
        <meta charset="utf-8">
        <META HTTP-EQUIV="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Wróblewski Piotr - GOG API test">
        <meta name="author" content="Wróblewski Piotr">
        <meta property="og:title" content="Wróblewski Piotr">
        <meta property="og:image" content="https://wroblewskipiotr.pl/blackboard/icon.png">
        <meta property="og:description" content="Wróblewski Piotr - GOG API test">
        <link rel="icon" href="./icon.png">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="maindiv">
            <h3>GOG API test: Game Details</h3>
            <div id = "spinner" class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
            <div id="contentDiv" class="animate-bottom">
            </div>  
        </div>
        
        <script>
            // LINK TO SUCCEED !!
            // https://api.trello.com/1/lists/idList/cards/?key=yourKey&token=yourToken
                
            var contentDiv = document.getElementById('contentDiv');
            var loaderDiv = document.getElementById('spinner');

            function launchIt() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        contentDiv.style.display = 'block';
                        loaderDiv.style.display = 'none';
                        contentDiv.innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("POST", "./getdata.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("task=clear");
            }
            
           document.addEventListener("DOMContentLoaded", function(event) {
             launchIt();  
           });
        </script>
    </body>
</html>
