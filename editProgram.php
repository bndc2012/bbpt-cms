<?php

    //file required
 require_once("Includes/db.php");

?>
<!DOCTYPE html>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
          <link href="styles/programlist.css" type="text/css" rel="stylesheet" media="all" />
          <script src="scripts/programList.js"></script>
           <link href="styles/dashboard.css" type="text/css" rel="stylesheet" media="all" />
          

        <title>Edit Program</title>
        <style>
 /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}
</style>

    </head>
    <body>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Modal Header</h2>
    </div>
    <div class="modal-body">
    <div class="form" style="width: 700px" >

              <form class="login-form"  name="editProgram" id="editProgram" enctype="multipart/form-data" action="dashboard.php" method="POST" >
               
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
                
                
                <button type="submit" form="editProgram" value="Submit" name="Submit" id="Submit">Save A New Audio Program</button>
               
                                                    
              </form>
              </div>
              <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
            </div>
    
  

</div>



</body>
        
        
</html>