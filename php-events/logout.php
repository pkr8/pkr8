<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Blue Devil's Schedule</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-ui.js"></script>
    <style>
        .navA {
            color: white;
        }

        .dropDown-content {
            background-color: white;
            border-style: none;
            padding: 5px;
            color: black;
            margin-left: 10px;
            margin-right: 50px;
            cursor: pointer;
            font-family: 'Segoe UI Light';
        }

        .options {
            color: black;
            font-family: 'Segoe UI Light';
        }
    </style>
</head>
<body style="background: no-repeat center center fixed; background-color: black; background-image:url('photos/court.png'); back
ground-size: cover; overflow-x: hidden; padding: 0px; height: 100%; margin: 0px; width: 100%;">
    <?php
    session_start();
    session_unset();
    session_destroy();
    ?>

    <div align="center" style="position: absolute; top: 0px; width: 100%; ">
        <nav class="navbar navbar-default" style="background-color: #001A57; width: 100%; z-index: 1; opacity: .7;
box-shadow: 5px 5px 20px 5px #303030; border-style: none">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"
                            style="margin-right: 30px;">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="font-size: 14px; font-family: 'segoe ui light'; color: white; margin-left: 10px; ">Blue Devils Schedule</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right" valign="bottom" style="font-size: 14px; color: white; font-family: 'segoe ui light'">
                        <li><a style="color:white" href="index.php">Day View</a></li>
			<li><a style="color:white" href="groupView.php">Group View</a></li>
                        <li><a style="color:white" href="loginlogin.php">My Events</a></li>
                        <li><a style="color:white" href="loginlogin.php">Log In</a></li>
                        <li>
                    </ul>
                </div>
            </div>
        </nav>
        <div align="center" style="margin-top: -20px; min-width: 600px; box-shadow: 0px 0px 50px 10px #303030; background-color:
#E5E5E5; opacity: .8; index: 5;  width: 60%;">
            <div style="height: 40px;">
            </div>
            <div>
                <h1 id="errorMessage" style="color: black; font-family: 'Segoe UI light'">Logout</h1>
            </div>
            <table style="width: 100%; background-color: #666666;  margin-top: 40px">
                <tr valign="top" style="width: 100%;">
                    <td align="left" style="width: 50%; padding-bottom: 20px; "></td>
                </tr>
            </table>
            <table style="width: 100%; min-width: 600px;  margin-top: 50px;">
                <tr>
                    <td valign="bottom" align="center" style="width: 100%; ">
                        <h2 style="color:#001A57; font-size: 20px; font-family: 'Segoe Ui'; padding-bottom: 10px;">You have successfully logged out.</h2>
                </tr>
		<tr>
		     <td valign="middle" align="center"; style="padding-bottom:75px;  padding-top: 20px; height: 100%; width: 50%">
                        <img style="width: 20%; height: auto" src="photos/dukeD.png" />
                    </td>
                </tr>
            </table>
        </div>
</body>
</html>




