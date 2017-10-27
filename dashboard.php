<?php
//error_reporting();//putting zero will turn the reporting off
error_reporting(E_ALL|E_STRICT|E_ERROR);
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
//display_errors = On;
ini_set('display_errors', 1);
session_start();
//file required
 require_once("Includes/db.php");
            
      // update values of business rules variables when form is  if ($_POST['host_id'] == "") {
            
    if ($_SERVER['REQUEST_METHOD'] == "POST"){ 
 
        if (isset($_POST['Submit'])){ 
            
        if (isset($_POST['serial_no'])){
            // Now check to make sure that the "serial_no" field is not empty.
            if($_POST['serial_no'] != '') {
            $serial_no = $_POST['serial_no'];
             echo $serial_no;
            }
            else{
                echo 'no serial number inserted';
            }
        }
         if (isset($_POST['recorded_dte'])){
             
             // Now check to make sure that the "recorded_dte" field is not empty.
            if($_POST['recorded_dte'] != '') {
            $recorded_dte = $_POST['recorded_dte'];
             echo $recorded_dte;
            }
            else{
                echo 'no recorded date inserted';
            }
        }
          if (isset($_POST['dayperiod_id'])){
              
            $dayperiod_id= $_POST['dayperiod_id'];
        }
          if (isset($_POST['cassettecap_id'])){
              
            $cassettecap_id= $_POST['cassettecap_id'];
        }
          if (isset($_FILES['audio']['name'])) {  
              
             $uploaddir = 'resources/audios/';
             $uploadaudfile = $uploaddir . basename($_FILES['audio']['name']);
     
             echo '<pre>';
            if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadaudfile)) {
                echo "File is valid, and was successfully uploaded.\n";
                                                
            } 
            else {
                                                
                  echo "Possible file upload attack!\n";
            }

                //echo 'Here is some more debugging info:';
                print_r($_FILES);

            print "</pre>";
         }
         
         if (isset($_POST['eventloc_id'])){
             
            $eventloc_id= $_POST['eventloc_id'];
        }
         if (isset($_POST['archiveloc_id'])){
             
            $archiveloc_id= $_POST['archiveloc_id'];
        }
        if (isset($_FILES['jacketthm']['name'])) {
            
                //$targetfolder = "D:/xampp/htdocs/wishlist_1/resources/thumbnails/";
                $targetfolder = "resources/thumbnails/";


                //Usage of basename() function

                $uploadthmfile = $targetfolder . basename( $_FILES['jacketthm']['name']) ;

                if(move_uploaded_file($_FILES['jacketthm']['tmp_name'], $uploadthmfile))

                {

                echo "The file ". basename( $_FILES['jacketthm']['name']). " is uploaded";

                }

                else {

                echo "Problem uploading file";
                }        
        }
 
        if (isset($_FILES['jacketimg']['name'])) {   
                                                 // Instructions if $_POST['value'] exist    
                                                //$uploaddir = 'D:/xampp/htdocs/wishlist_1/resources/images/'; //working tested path
                                                 $uploaddir = 'resources/images/'; //working tested path
                                                // if (file_exists($uploaddir)) {
//                                                    echo "The file". $uploaddir . "exists -if";
//                                                } else {
//                                                    echo "The file". $uploaddir . "does not exist -if";
//                                                }

                                                $uploadimgfile = $uploaddir . basename($_FILES['jacketimg']['name']);
                                                echo $uploadimgfile;

                                                echo '<pre>';
                                                if (move_uploaded_file($_FILES['jacketimg']['tmp_name'], $uploadimgfile)) {
                                                    echo "File is valid, and was successfully uploaded.\n";
                                                } else {
                                                    echo "Possible file upload attack!\n";
                                                }
                                             
                                               
                                                     
                                                  
                                                
                                                echo 'Here is some more debugging info:';
                                                print_r($_FILES);

                                               print "</pre>";
                                            }
      
         if (isset($_POST['comment'])){
             
            $comment= htmlentities($_POST['comment']);
        }
        //if all business rules variables are filled then submit data to database
        WishDB::getInstance()->insert_program($serial_no,$recorded_dte,$dayperiod_id,$cassettecap_id,$uploadaudfile,$eventloc_id,$archiveloc_id,$uploadimgfile,$uploadthmfile,$comment);
        
        //return to same page
        //header('Location: dashboard.php' );
          //  exit;
        }
    }
    //check if this piece of code is working
if (!array_key_exists("username", $_SESSION)) {
    header('Location: index.php');
    exit;
}

 $comment ="";//necessary otherwise a notice displayed in the textarea field


?>

<!DOCTYPE html>
<html>
    <head>

         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <Title> BBPT | Content Management System (CMS) </title>
         <link href="styles/dashboard.css" type="text/css" rel="stylesheet" media="all" />
         <script src="scripts/dashboard.js"></script>
         <script src="scripts/jquery/lookups.js"></script><!--not needed for now-->
         <script src="scripts/jquery/jquery.js"></script><!--not needed for now-->

    </head>

<body>

<ul>
  <li><a href="#home">Home</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Audio</a>
    <div class="dropdown-content">
      <a href="programList.php" onclick="">Listen To Audio Program</a>
      <a href="dashboard.php#addProgramDiv" onclick="showDivAdd()">Add New Audio Program</a>
      <a href="editProgramList.php" onclick="">Modify An Existing Program</a>
    </div>
  </li>
  <li><a href="#contact">Print</a></li>
  <li><a href="#contact">Inventory</a></li>
   <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Reporting</a>
    <div class="dropdown-content">
      <a href="#">Write Report</a>
      <a href="#">View Report</a>
      <a href="#">Submit Weekly Timesheet</a>
    </div>
  </li>
    <li class="dropdow">
    <a href="javascript:void(0)" class="dropbtn">Tools</a>
    <div class="dropdown-content">
      <a href="tools.php">Upload Resources</a>
    </div>
  </li>
  <li style="float:right"><a class="active" href="index.php">Logout</a></li>
</ul>
    <div id="message_stream">
    Hello <?php echo $_SESSION['username']; ?><br/> 
    </div>
   
    <div class="column" id="left">
        <p>for admin menus </p>
        <br/>
        <?php
    	$ini_val = ini_get('upload_tmp_dir');
	$upload_tmp_dir = $ini_val ? $ini_val : sys_get_temp_dir();
	echo $upload_tmp_dir;
	echo '\n';
	print "\"PHP maximum upload file size\" is ==>" . ini_get('upload_max_filesize') . "<==";
    	?>
    </div>
    <div class="column" id="centre">
        
        <p>for main active menu item to display </p>
        
        <div class="login-page" style="display: none;" id="addProgramDiv">
            
            <div class="form" style="width: 700px" >

              <form class="login-form"  name="addProgram" id="addProgram" enctype="multipart/form-data" action="dashboard.php" method="POST" >
               
                Serial Number:           <input type="text" name="serial_no" id="serial_no" size="5" value="" />
            
                Recording Date:          <input type="date" name="recorded_dte" id="recorded_dte" value="" />
                                                                             
                    <br />
                Cassette Capacity:        <select name="cassettecap_id" id="cassettecap_id" size="1">
                                            <?php                   
                                                 $result = WishDB::getInstance()->getAllCassetteCap();
                                                 while ($row = mysqli_fetch_array($result)){
                                                 echo "<option value=".$row['id'].">" . $row['name']. "</option>";
                                                 }
                                            ?>
                                        </select>
                    <br />
                Program Time Segment:    <select name="dayperiod_id" id="dayperiod_id" size="1">             
                                            <?php                   
                                                $result = WishDB::getInstance()->getAllEventTime();
                                               while ($row = mysqli_fetch_array($result)){
                                                echo "<option value=".$row['id'].">" . $row['time_period']. "</option>";
                                                }
                                            ?>
                                        </select>
                    <br />
                Program Jacket (Cover):  <input type="file" name="jacketimg" id="jacketimg" />
                                                        
                Program Jacket (Thumb):  <input type="file" name="jacketthm" id="jacketthm" />
                                          
                Program Audio:           <input type="file" name="audio"     id="audio" />

                Program Location:   <select name="eventloc_id" id="eventloc_id" size="1"> 
                                        <?php                   
                                            $result = WishDB::getInstance()->getAllEventLocations();
                                           while ($row = mysqli_fetch_array($result)){
                                            echo "<option value=".$row['id'].">" . $row['name']. "</option>";
                                            }
                                        ?>
                                    </select>
                <br />
                Program Archive:    <select name="archiveloc_id" id="archiveloc_id" size="1"> 
            
                                        <?php                   
                                            $result = WishDB::getInstance()->getAllArchiveLocations();
                                           while ($row = mysqli_fetch_array($result)){
                                            echo "<option value=".$row['id'].">" . $row['name']. "</option>";
                                            }
                                        ?>
                                    </select>
                <br />
                Program Comment:         <textarea name="comment" id="comment"><?php echo $comment;?></textarea>    
                
                
                <button type="submit" form="addProgram" value="Submit" name="Submit" id="Submit">Save A New Audio Program</button>
               
                                                    
              </form>
            </div>
        </div>
    </div>
    <div class="column" id="right">
        <p>for not sure yet... </p>
        <?php
                        
                        print_r($_POST); 
                        echo '<br />';
                        echo var_dump($_REQUEST);
                        echo '<br />';
                        echo $_SERVER['REQUEST_METHOD']; 
                        echo '<br />';
                        print_r($_FILES);
        ?>
    </div>   
</body>
</html>