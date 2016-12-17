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
            .navA{
                color:white;
            }
            .dropDown-content{
                background-color: white; 
                border-style: none; 
                padding: 5px; 
                color: black;
                margin-left: 10px; 
                margin-right: 50px; 
                cursor: pointer;
                font-family: 'Segoe UI Light'
            }
            .options{
                color: black; 
                font-family: 'Segoe UI Light'
            } 
            .ui-datepicker-next{
           	background-image: url("photos/next.png");
                width: 10px; 
                height: auto;
                background-repeat: no-repeat;
            }    
            .ui-datepicker-prev{
                background-image: url("photos/prev.png");
                background-repeat: no-repeat;
                width: 10px;
                height: auto; 
            }
        </style>
</head>

<body style="background: no-repeat center center fixed; background-color: black; background-image:url('photos/court.png'); background-size: cover; overflow-x: hidden; padding: 0px; height: 100%; margin: 0px; width: 100%;">
    <?php
 
    session_start();
    #$path=realpath('../db-events/load.sql');
    #$out=exec("../db-events/scrape.sh");
    #$out=system("psql -h localhost -d" .get_current_user()." -af". $path ."-devents", $return);
    if  (empty($_SESSION['username'])) {
        $login="loginlogin.php";
	$loginLink="loginlogin.php";
	$loginLinkText="Log In";
    }
    else{
    	$login="myevents.php";
	$loginLink="logout.php";
        $loginLinkText="Log out";
    }
   ?>
   <div align="center" style="position: absolute;  top: 0px; width: 100%; ">
        <nav class="navbar navbar-default" style="background-color: #001A57; width: 100%; z-index: 1; opacity: .7; box-shadow: 5px 5px 20px 5px #303030; border-style: none">
            <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="margin-right: 30px;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#" style="font-size: 14px; font-family: 'segoe ui light'; color: white; margin-left: 10px; ">Blue Devils Schedule</a> 
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right" valign="bottom" style="font-size: 14px; color: white; font-family: 'segoe ui light'">
                            <li><a style="color:white" href="index.php"><?php echo $return;?></a></li>
			    <li><a style="color:white" href="index.php">Day View</a><li>
                            <li><a style="color:white" href="">Group View</a><li>
			    <li><a style="color:white" href="<?php echo $login;?>">My Events</a><li>
                            <li><a style="color:white" href="<?php echo $loginLink;?>"><?php echo $loginLinkText;?></a><li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div align="center" style="margin-top: -20px; min-width: 600px; box-shadow: 0px 0px 50px 10px #303030; background-color: #E5E5E5; opacity: .8; index: 5;  width: 60%;" >
                <div style="height: 40px;">
                </div>
                <div> 
                    <h1 id='dateTitle' style="color: black; font-family: 'Segoe UI light'"></h1>
                </div>
                <table style="width: 100%; background-color: #666666; margin-top: 40px">
                    <tr valign="bottom" style="width: 100%;"> 
                        <td align="left" valign="bottom"  style="width: 35%; padding-top: 10px; margin-left: 10%;  padding-bottom: 10px">
 			<p style=" color: #E5E5E5; display: inline-block; margin-left: 50px; margin-top: 20px; font-size: 16px;  font-family: 'Segoe UI light'">Select All:
                            <input onclick="changeSelectAll()" type="checkbox" style="width: 50px; height: 25px; display: inline-block; vertical-align: bottom" name="selectAll" id="select"></input></p>
                        </td>
                        <td valign="top" style="width: 65%; padding-top: 10px; padding-bottom: 10px" >  
                            <div align="right">
                            <p id='dateTitle' style="color: #E5E5E5; display: inline-block; font-size: 14px;  font-family: 'Segoe UI light'" >Filter by:</p>
			    <div align="left" style="display:inline-block">
                                <fieldset valign="top" style="padding-bottom: 10px; padding-left: 10px;">
                                    <label class="radio-inline" style=" font-size: 12px; font-family: 'segoe ui light'; color: #e5e5e5">
 				    <input type="radio" name="group" id="group"  style="width: 10px;" value="group" onchange='changeFilter(this.value)' checked></input>Group
				    </label>
  				    <label class="radio-inline"  style="font-size: 12px; font-family: 'segoe ui light'; color: #e5e5e5"> 
				   <input type="radio" id="location" onchange="changeFilter(this.value)" name="group" style="width: 10px;" value="location"></input>Location 
				</label>
				</fieldset>

				<select class="dropDown-content" style="font-size: 12px;padding:2px; font-family: 'segoe ui' color: black;  max-width: 200px; height: 25px; min-width:100px"  id="groups" onchange="changeGroup(this.value)">
                                </select>
			     </div>
			    </div>
                        </td>
                    </tr>
                </table>
                <div align="left" style="width: 100%; background-color: pink;  font-family: 'Segoe Ui light'; color:  #E5E5E5;" >
    			<table id="eventList" style="width:100%">
		        </table>
                </div>
            
        </div>
   
</div>    
    
</body>
<script>
    var listOfEvents=[];
    var countGoing=0;
    xmlhttp=new XMLHttpRequest();
    url="all-groups.php";
    $("#dateTitle").text("All");
    xmlhttp.onreadystatechange=function() {
        if (this.readyState == 4 && this.status == 200) {
            loadGroups(this.responseText);
            changeGroup("All");
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    
        
    function addEvent(event){

        if ("<?php echo $_SESSION['username'];?>"==""){
           window.open("loginlogin.php","_self");
        }
	else{
        var xmlhttp2 = new XMLHttpRequest();
        var url2 = "addEvent.php?eventid="+event;
        xmlhttp2.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                   $("#"+event).attr('src','photos/skip.jpg');
		   $("#"+event).attr('onclick', 'deleteEvent("'+event+'")');
                   countGoing+=1;
                   if (countGoing==listOfEvents.length){
                        $("#select").prop("checked", true);
                   }
                   else{
                        $("#select").prop("checked", false);
                    }
                }
        };
        xmlhttp2.open("GET", url2, true);
        xmlhttp2.send();
        } 
    }
    function changeSelectAll(){
         if ("<?php echo $_SESSION['username'];?>"==""){
           window.open("loginlogin.php","_self");
        }
        else{
         if ($("#select").is(":checked")){
             selectAll();
         }
         else{
             deleteAll();
         }
	}
    }
    function selectAll(){
        countGoing=0;
                     
        $("#select").prop("checked", true);
    	for (event in listOfEvents){
        	addAll(listOfEvents[event].Id);
	}
        
    }
    function addAll(event){
        var xmlhttp2 = new XMLHttpRequest();
        var url2 = "addEvent.php?eventid="+event;
        xmlhttp2.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                   $("#"+event).attr('src','photos/skip.jpg');
                   $("#"+event).attr('onclick', 'deleteEvent("'+event+'")');
                   countGoing+=1;
                }   
        };
        xmlhttp2.open("GET", url2, true);
        xmlhttp2.send();
        
    } 

    function deleteAll(){
        countGoing=listOfEvents.length;
        $("#select").prop("checked", false);
        for (event in listOfEvents){
            
           delAll(listOfEvents[event].Id); 
        }
    }    
    function delAll(event){
       var xmlhttp2 = new XMLHttpRequest();
        var url2 = "deleteEvent.php?eventid="+event;
        xmlhttp2.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                   $("#"+event).attr('src','photos/going.jpeg.jpg');
                   $("#"+event).attr('onclick', 'addEvent("'+event+'")');
                   countGoing-=1;
                }
        };
        xmlhttp2.open("GET", url2, true);
        xmlhttp2.send();
    } 

    function deleteEvent(event){
        if ("<?php echo $_SESSION['username'];?>"==""){
           window.open("loginlogin.php", "_self");
        }
        else{
        var xmlhttp2 = new XMLHttpRequest();
        var url2 = "deleteEvent.php?eventid="+event;
        xmlhttp2.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                   $("#"+event).attr('src','photos/going.jpeg.jpg');
		   $("#"+event).attr('onclick', 'addEvent("'+event+'")');
                   countGoing-=1;
		   if (countGoing==listOfEvents.length){
           		$("#select").prop("checked", true);
        	   }
                   else{
           		$("#select").prop("checked", false);
        	    }
                }
        };
        xmlhttp2.open("GET", url2, true);
        xmlhttp2.send();
        } 
    }
    function displayEventsForDay (response){
        var fixedResponse=response.replace("[^\\p{Alpha}\\p{Digit}]+","");
	listOfEvents=JSON.parse(fixedResponse);
        $("#eventList").empty();
        numCount=0;
        countGoing=0;
        var message="Sorry, there are no events in our database for that particular filter.";
        var newDate=new Date();
        newDate.setMilliseconds(0);
        newDate.setHours(0);
        newDate.setMinutes(0);
        newDate.setSeconds(0);
        
	
	if (listOfEvents.length==0){
	   var noEvents="<tr style='color: white; background-color: #e5e5e5; width:100%'>"
                                +"<td align='center' valign='bottom' style='padding-top: 100px; padding-bottom: 100px; width:100%;'>"
			        +'<h2 style=" color: #001a57; font-size: 20px; font-family: "Segoe Ui"; padding-bottom: 10px;">'
                                +message+'</h2>'
				+'</td></tr>';
            $("#eventList").append(noEvents); 
	}

        for (event in listOfEvents){
                var tempDate=new Date(listOfEvents[event].Time);
 	   	var newD=new Date(Date());
                newD.setHours(0);
                newD.setMinutes(0);
            	newD.setSeconds(0);
            	newD.setMilliseconds(0);
            	if(newD.getTime() <= tempDate.getTime()){

                var tempDate=new Date(listOfEvents[event].Time);
                colors="color: white; background-color: #001A57;"
                if (numCount%2==0){
                    colors="color: #001A57; background-color: #E5E5E5;"; 
                }
	        var midnight="AM";
                var hours=tempDate.getHours()%12;
                if (hours==0){
                   hours=12;
                }
                if (tempDate.getHours()>=12){
                   midnight="PM";
                }
                var minutes=tempDate.getMinutes();
                if (minutes<10){
                   minutes="0"+minutes;
		}
                var going="going.jpeg.jpg";
                var goingFunction="addEvent";
                if (listOfEvents[event].Going){
		   going="skip.jpg";
		   goingFunction="deleteEvent";
                   countGoing+=1;
                }
                var eventDiv="<tr style='"+colors+"width:100%'>"
                                +"<td style='padding-top: 20px; padding-bottom: 20px; width:80%; padding-left: 100px'>" 
                                    +"<h1 style='font-size: 28px' >"+listOfEvents[event].Name+"</h1>"
                eventDiv+="<p style='font-size: 20px'>"+tempDate.toDateString()+" " +hours+":"+minutes+" "+midnight+"</h1>"
                                        +"<p style='font-size:20px'>"+listOfEvents[event].Location+"</h1>"
                                        +"<p style='font-size:20px'>"+listOfEvents[event].HostUrl+"</h1>"
                            + "</td>"
                            +"<td align='left' valign='middle' style=' margin-top: 5px; width: 100%; margin-right: 100px;'>"
                                +"<img id='"+listOfEvents[event].Id+"' style='width:75px; cursor: pointer; height: auto'  onclick='"+goingFunction+"("+listOfEvents[event].Id+")' src='photos/"+going+"'>"
				 +"</td>"
                            +"</tr>";
                $("#eventList").append(eventDiv);
                numCount+=1;
                }
        }
        if (listOfEvents.length!=0 && numCount==0){
           var noEvents="<tr style='color: white; background-color: #e5e5e5; width:100%'>"
                                +"<td align='center' valign='bottom' style='padding-top: 100px; padding-bottom: 100px; width:100%;'>"
                                +'<h2 style=" color: #001a57; font-size: 20px; font-family: "Segoe Ui"; padding-bottom: 10px;">'
                                +'Sorry, these events are in the past. Please search for another day.</h2>'
                                +'</td></tr>';
            $("#eventList").append(noEvents); 
        
        }
        if (countGoing==listOfEvents.length){
           $("#select").prop("checked", true);
        }
        else{
	   $("#select").prop("checked", false);
        }
    }
    function loadGroups(response){
    	listOfGroups=JSON.parse(response);
        $("#groups").empty();
        var quote='"';
        group="<option class='options' style='font-size:12px; color: black; font-family:'segoe ui' value='All'>All</option>";
        $("#groups").append(group);
        for (g in listOfGroups){
            group="<option class='options' style='color: black; font-size:12px; font-family:'segoe ui' value='"+listOfGroups[g].Name+"'>"+listOfGroups[g].Name+"</option>";
            $("#groups").append(group);
	}
        
        
    }
    function changeFilter(filter){
       if ($("#group").is(":checked")){
          xmlhttp=new XMLHttpRequest();
    	  url="all-groups.php";
          xmlhttp.onreadystatechange=function() {
       		if (this.readyState == 4 && this.status == 200) {
            	loadGroups(this.responseText);
                changeGroup("All");
      		}
    	  };
    	  xmlhttp.open("GET", url, true);
    	  xmlhttp.send();
       }
       if ($("#location").is(":checked")){
          xmlhttp=new XMLHttpRequest();
          url="all-locations.php";
          xmlhttp.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                	loadGroups(this.responseText);
                        changeGroup("All");
                }
          };
          xmlhttp.open("GET", url, true);
          xmlhttp.send();
       } 
    }
    function changeGroup(group){
        var url2="";
        $("#dateTitle").text(group);
        if ($("#group").is(":checked")){
           url2 = "changeGroupViewGroup.php?mygroup="+group;
	}
        else{
           url2 = "changeGroupViewLocation.php?mylocation="+group;
        }
       
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange=function() {
        	if (this.readyState == 4 && this.status == 200) {
            		displayEventsForDay(this.responseText);
        	}
    	};
    	xmlhttp2.open("GET", url2, true);
    	xmlhttp2.send();
    }  
 

</script>
</html>

