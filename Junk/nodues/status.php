<?php
 error_reporting(0);
 session_start();
//on session creation
if(isset($_SESSION['id']) && $_SESSION['id'] != "")
    {$_SESSION['logged_in'] = "true";}
    ?>


<html>
    <head><link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            No Dues Portal
        </title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Prociono">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Fertigo">
        <script src="js/jquery-3.0.0.js"></script>
         <link href="css/mystyles2.css" rel="stylesheet">
        
        
    </head>
    
    <body>
     
        
        
        <nav class="navbar navbar-inverse navbar-fixed-top" role=navigation>
    
    <div class="container">
        
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img id="intro_image" src="images/IIT_Delhi_logo.png" height="50px" width="50px"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            
            <li><a href="/admn/welcome_page.php">Home </a></li>
            <li><a href="http://www.iitd.ac.in">IITD Home</a></li>
            </ul>
            
           
            <ul class="nav navbar-nav navbar-right" style="position:relative; top:-6px;">
                <li><a href="/nodues/logout.php"><button id="logout_button" class="btn btn-danger">Logout</button></a> </li>
            
            </ul>
       
            
        </div>  
        </div>
            
            
            
            
    </nav>
        
        
        <div id="wrapper">
        
    
        
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       Hidden
                    </a>
                </li>
                <li >
                    <a href="#">IITD Home</a>
                </li>
                <li>
                    <a href="/admn/welcome.php">Home</a>
                </li>
                
                
                
               
                <li>
                    <a href="#">Contact</a>
                </li>
                
                <li>
                    <a href="/admn/logout.php">Logout</a>
                </li>
                
            </ul>
        </nav>    
             
            </div>
        
        <?php
        $id=$_SESSION['id'];
        require 'dbconnection.php';
        
        
        
        ?>
       
        
        
        
        
        
        
        <div class="jumbotron">
           <div class="row">
               <div class="col-sm-5 col-sm-5 col-sm-offset-2 col-xs-offset-2">
                   <p id='file'><?php echo $depname;?></p>
                  
               </div>
               <div class="col-sm-5 col-sm-5">
                  
                   <p id='file'><?php echo $place;?></p>
               </div>
           </div>
           </div>
        
        
        
        
        
        
        
        
        
       <div class="container" style="padding-top:50px; margin-left:250px;">
           
           
           
           
    <div class="row">
        <div class="col-xs-12 col-sm-12" >
            <p id='file'>You have successfully initiated NoDues Clearance process. </p>
            <p style="font-family:Prociono; font-size:1.5em;">You can track your status here. </p>
        </div>
        </div>
        <div class=row>
        <div class="col-sm-6-col-xs-12">
            
            
            
            
            
            <a href="track.php"><button class="btn btn-primary">Track Status</button></a>

            
            
            
            
            
            
            </div>
        </div>
    </div>
        
        
        
        
        
        
        
        
    
        
        
        
    
        
        <footer class="row-footer" style="position:absolute; bottom:0px; width:100%;">
        <div class="container">
            <div class="row">  
                
                <div class="col-xs-5 col-sm-6 col-sm-offset-4">
                    <h4><p id ="loginstate" style="color:blue" style="font-family:Fertigo;"> You are currently logged in (<?php echo $_SESSION['id']  ?>) </p></h4>
                    
                </div>
                
          
                
                
            </div>
                
                
        </div>
    </footer>

        
    </body>
</html>