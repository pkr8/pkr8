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

<body style="background: no-repeat center center fixed; background-color: black; background-image:url('photos/court.png'); background-size: cover; overflow-x: hidden; padding: 0px; height: 100%; margin: 0px; width: 100%;">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    	if  (!isset($_POST['username'])  && !isset($_POST['password'])) {
    		die();
    	}
    session_start();
   
    $myuser = $_POST['username'];
    $mypassword= $_POST['password'];
    try{
    include("pdo-events.php");
    $dbh = dbconnect();
    }catch (PDOException $e) {
    print "Error connecting to the database: " . $e->getMessage() . "<br />";
    die();
    }
    try{
	$st = $dbh->prepare("SELECT * FROM  DukeUser WHERE netid=? and password=?");
        $st->execute(array($myuser, $mypassword));
        if (($myrow= $st->fetch())){
           $_SESSION['username'] = $myuser;
           header('Location:myevents.php');
           #header('Location: myevents.php?username='. $myuser); 
        }
        else{
        	$usernameErr= "Log-In Failed - Incorrect Username/Password";
        }
    } catch (PDOException $e) {
    print "Database error: " . $e->getMessage() . "<br />";
    die();
    }
    }

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
                        <li><a style="color:white" href="">My Events</a></li>
                        <li><a style="color:white" href="">Log In</a></li>
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
                <h1 id="errorMessage" style="color: black; font-family: 'Segoe UI light'">Login</h1>
            </div>
            <table style="width: 100%; background-color: #666666;  margin-top: 40px">
                <tr valign="top" style="width: 100%;">
                    <td align="left" style="width: 50%; padding-bottom: 20px; "></td>
                </tr>
            </table>
            <table style="width: 100%; min-width: 600px;  margin-top: 50px;">
                <tr>
                    <td valign="top" style="padding-left: 10%; ">
                        <h2 style="color:#001A57; font-size: 20px; font-family: 'Segoe Ui'; padding-bottom: 10px;">Not Registered? Sign Up <a href="login.php">Here</a></h2>
                        <p style="color: red">* required fields</p>
                        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>
                            " method="post" role="form" style="padding-bottom: 100px">
                            <h2 style="color: black; font-size: 16px; font-family: 'Segoe Ui'; ">Username: </h2>
                            <input type="text" name="username" value="<?php echo $myuser;?>" required />
                            <span style="color: red">* <?php echo $usernameErr;?></span>
                            <h2 style="color: black; font-size: 16px; font-family: 'Segoe Ui' ; ">Password: </h2>
                            <input type="password" name="password" required />
                            <span style="color: red">* <?php echo $passwordErr;?></span>
                            <h2></h2>
                            <input style="color: black; background-color: #666666; border-style: none; padding: 5px; padding-right: 10px; padding-left: 10px; font-family:'Segoe UI'; color: white" type="submit" name="submit" value="Log In" />

                        </form>
                    </td>
		    <td valign="top" align="center"; style="padding-right: 10%; padding-top:75px; height: 100%; width: 50%">
			<img style="width: 50%; height: auto" src="photos/dukeD.png"/>
		    </td>
                </tr>
            </table>
        </div>
</body>
</html>


