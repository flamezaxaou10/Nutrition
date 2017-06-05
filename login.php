<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>โรงพยาบาลเจ้าหระยาอภัยภูเบศร</title>
    <link rel="stylesheet" type="text/css" href="css/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/new2.css">
            
</head>
<body class="bgcolor">

    
    <nav class="navbar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
        </div>
    </nav>

    <div style="text-align: center">
        <img  src="img/logo_1.png" width="450px" height="300px" class="img-responsive img-thumbnail" id="logoindex" alt="Logo Index">
    </div>
    <div id="loginbox" class="mainbox">
        <div class="panel panel-info panel-info2">
            <div style="padding-top:15px" class="panel-body panel-info" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form class="form-horizontal" role="form" method="post" action="log.php">
                    <input type="hidden" name="_token" value="1BlZ9ddJeOo2ktGspTicThVwkIOtfHjtigmKp91g">
                    <h1>Login</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

</body>

<footer style="color: rgb(255,255,255);font-size: 100%;text-align: center;margin-top: 300px;">
</footer>

</html>