<?php

    //file required
 require_once("Includes/db.php");

?>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
          <link href="styles/programlist.css" type="text/css" rel="stylesheet" media="all" />
          <script src="scripts/programList.js"></script>
        <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
        
        <script type="text/javascript">
            $(document).ready(function(){
               $('.striped tr:even').addClass('alt');
            });
        </script>
        <title></title>
    </head>
    <body>
        <div id ="searchbar" style="text-align:center;" > 
        
        <form id="search-form" name="search-form" method="post">
        <input type="text" name="search" id="search"/>
        <input type="submit" value="Search" />
        <div id="paymentContainer" class="paymentOptions">

                <div id="payCC" class="floatBlock">
                    <label for="paymentCC"> <input id="paymentCC" name="paymentType" type="radio" value="ID" />  ID  </label>
                </div>

                <div id="payInvoice" class="floatBlock">
                    <label for="paymentInv"> <input id="paymentInv" name="paymentType" type="radio" value="YEAR" /> YEAR </label>
                </div>

                <div id="pay3rdParty" class="floatBlock">
                    <label for="payment3rd"> <input id="payment3rd" name="paymentType" type="radio" value="LOCATION"/> LOCATION </label>
                </div>

            </div>
      </form>
             
        </div>
        <?php
            $keyword="";
            $result="";
           $server = mysqli_connect("xo7.x10hosting.com","bbptsand", "radhalove");
            $db =  mysqli_select_db($server,"bbptsand_CMS");
            
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                
                if (isset($_POST['paymentType'])) {
                    
                    $selected_val = $_POST['paymentType'];
                    $keyword = $_POST['search'];
                   // $dayperiod_name = WishDB::getInstance()->get_dayperiod_name_by_id($row['dayperiod_id']);
                    if ($selected_val=="ID"){
                                           
                   // $query =  "select id,serial_no,recorded_dte,dayperiod_id,comment,cassettecap_id,jacketthm,audio from programs where id"."=".$keyword;
                    
                     $query =  "select id,serial_no,recorded_dte,dayperiod_id,comment,cassettecap_id,audio from programs where id"."=".$keyword;
                    
                    

                    if (!$result = mysqli_query($server,$query)){
                        die(mysql_error());
                    }
                    }
//                     if ($selected_val=="YEAR"){
//                        
//                     
//                    $query =  "select title,recorded_dte,comment,duration,jacketthm,audio from programs where recorded_dte"."=".$keyword;
//
//                    if (!$result = mysql_query($query)){
//                        die(mysql_error());
//                    }
//                     }
//                     if ($selected_val=="LOCATION"){
//                        
//                     
//                    $query =  "select title,recorded_dte,comment,duration,jacketthm,audio from programs where name"." =".$keyword;
//
//                    if (!$result = mysql_query($query)){
//                        die(mysql_error());
//                    }
//                    
//                } 
                
            }
            }  
        
            echo "<table class='striped'>";
            echo "<tr class='header'>";
            echo "    <td>Serial Number</td>";
            echo "    <td>Recording Date</td>";
            echo "    <td>Recording Year</td>";
            echo "    <td>DayTime Segment</td>";
            echo "    <td>Cassette Capacity</td>";
            echo "    <td>Comment</td>";
            echo "    <td>jacketthm</td>";
            echo "    <td>audio</td>";
               
            echo"</tr>";
            if ($keyword == 20) {
               while ($row = mysql_fetch_array($result)) {
                   echo "<tr>";
                  // echo "<td>".$row['id']."</td>";
                   echo "<td>".$row['serial_no']."</td>";
                   echo "<td>".$row['recorded_dte']."</td>";
                  // $dayperiod_id= $row['dayperiod_id'];
                  // $dayperiod_name = WishDB::getInstance()->get_dayperiod_name_by_id($dayperiod_id);
                   echo "<td>".$dayperiod_name = WishDB::getInstance()->get_dayperiod_name_by_id($row['dayperiod_id'])."</td>";
                   //echo "<td>".$row['dayperiod_id']."</td>";
                   //echo "<td>".$dayperiod_name."</td>";
                    echo "<td>".$cassette_cap = WishDB::getInstance()->get_cassette_capacity_by_id($row['cassettecap_id'])."</td>";
                   
                  // echo "<td>".$row['cassettecap_id']."</td>";
                   //echo "<td>".$row['jacketimg']."</td>";
                  
                        
                      echo "<td>".'<a href="resources/images/A19278.png"><img src="resources/thumbnails/A19278_tn.jpg" /></a>'."</td>";
                     
                   
                  echo "<td>".'<audio controls>
                                         <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'.$row['audio']."</td>"; 
                   
                  // echo "<td>".$row['audio']."</td>";
                    
                    //echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>";
                  echo "</tr>";
               }
                 //echo "<td>".'<img src="resources/thumbnails/A19378_tn.jpg" />'."</td>"; working
                 // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>"; working
              // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'.$row['jacketimg']."</td>";
                  //echo "<td>".'<audio controls>
                                        // <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
            }  
             if ($keyword == 21) {
               while ($row = mysql_fetch_array($result)) {
                   echo "<tr>";
                  // echo "<td>".$row['id']."</td>";
                   echo "<td>".$row['title']."</td>";
                   echo "<td>".$row['recorded_dte']."</td>";
                   echo "<td>".$row['comment']."</td>";
                   echo "<td>".$row['duration']."</td>";
                   //echo "<td>".$row['jacketimg']."</td>";
                  
                        
                      echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>";
                     
                   
                  echo "<td>".'<audio controls>
                                         <source src="resources/audios/A19378.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'.$row['audio']."</td>"; 
                   
                  // echo "<td>".$row['audio']."</td>";
                    
                    //echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>";
                  echo "</tr>";
               }
                 //echo "<td>".'<img src="resources/thumbnails/A19378_tn.jpg" />'."</td>"; working
                 // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>"; working
              // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'.$row['jacketimg']."</td>";
                  //echo "<td>".'<audio controls>
                                        // <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
            } 
             if ($keyword == 22) {
               while ($row = mysql_fetch_array($result)) {
                   echo "<tr>";
                  // echo "<td>".$row['id']."</td>";
                   echo "<td>".$row['title']."</td>";
                   echo "<td>".$row['recorded_dte']."</td>";
                   echo "<td>".$row['comment']."</td>";
                   echo "<td>".$row['duration']."</td>";
                   //echo "<td>".$row['jacketimg']."</td>";
                  
                        
                      echo "<td>".'<a href="resources/images/A19478.png"><img src="resources/thumbnails/A19478_tn.jpg" /></a>'."</td>";
                     
                   
                  echo "<td>".'<audio controls>
                                         <source src="resources/audios/A19478.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'.$row['audio']."</td>"; 
                   
                  // echo "<td>".$row['audio']."</td>";
                    
                    //echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>";
                  echo "</tr>";
               }
                 //echo "<td>".'<img src="resources/thumbnails/A19378_tn.jpg" />'."</td>"; working
                 // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>"; working
              // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'.$row['jacketimg']."</td>";
                  //echo "<td>".'<audio controls>
                                        // <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
            } 
             if ($keyword == 23) {
               while ($row = mysql_fetch_array($result)) {
                   echo "<tr>";
                  // echo "<td>".$row['id']."</td>";
                   echo "<td>".$row['title']."</td>";
                   echo "<td>".$row['recorded_dte']."</td>";
                   echo "<td>".$row['comment']."</td>";
                   echo "<td>".$row['duration']."</td>";
                   //echo "<td>".$row['jacketimg']."</td>";
                  
                        
                      echo "<td>".'<a href="resources/images/A19578.png"><img src="resources/thumbnails/A19578_tn.jpg" /></a>'."</td>";
                     
                   
                  echo "<td>".'<audio controls>
                                         <source src="resources/audios/A19578.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'.$row['audio']."</td>"; 
                   
                  // echo "<td>".$row['audio']."</td>";
                    
                    //echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>";
                  echo "</tr>";
               }
                 //echo "<td>".'<img src="resources/thumbnails/A19378_tn.jpg" />'."</td>"; working
                 // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>"; working
              // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'.$row['jacketimg']."</td>";
                  //echo "<td>".'<audio controls>
                                        // <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
            }
             if ($keyword == 24) {
               while ($row = mysql_fetch_array($result)) {
                   echo "<tr>";
                  // echo "<td>".$row['id']."</td>";
                   echo "<td>".$row['title']."</td>";
                   echo "<td>".$row['recorded_dte']."</td>";
                   echo "<td>".$row['comment']."</td>";
                   echo "<td>".$row['duration']."</td>";
                   //echo "<td>".$row['jacketimg']."</td>";
                  
                        
                      echo "<td>".'<a href="resources/images/A19678.png"><img src="resources/thumbnails/A19678_tn.jpg" /></a>'."</td>";
                     
                   
                  echo "<td>".'<audio controls>
                                         <source src="resources/audios/A19678.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'.$row['audio']."</td>"; 
                   
                  // echo "<td>".$row['audio']."</td>";
                    
                    //echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>";
                  echo "</tr>";
               }
                 //echo "<td>".'<img src="resources/thumbnails/A19378_tn.jpg" />'."</td>"; working
                 // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'."</td>"; working
              // echo "<td>".'<a href="resources/images/A19378.png"><img src="resources/thumbnails/A19378_tn.jpg" /></a>'.$row['jacketimg']."</td>";
                  //echo "<td>".'<audio controls>
                                        // <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
            }  
            else {
                
                  while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id']; 
                   echo "<tr>";
                   echo "<td>".$row['serial_no']."</td>";
                   echo "<td>".$recording_date = WishDB::getInstance()->format_date_for_display($row['recorded_dte'])."</td>";  
                   echo "<td>".$recording_year = WishDB::getInstance()->format_date_for_display_year($row['recorded_dte'])."</td>";                                    
                   echo "<td>".$dayperiod_name = WishDB::getInstance()->get_dayperiod_name_by_id($row['dayperiod_id'])."</td>";  
                   echo "<td>".$cassette_cap   = WishDB::getInstance()->get_cassette_capacity_by_id($row['cassettecap_id'])."</td>";                 
                   echo "<td>".$row['comment']."</td>";
                   echo "<td><a href=\"".$image = WishDB::getInstance()->get_image_href_by_id($row['id'])."\""."><img src=\"".$thumb = WishDB::getInstance()->get_thumb_src_by_id($row['id'])."\""."/></a></td>";
                   
                    //echo "<td>".'<audio controls>
                                     //    <source src="resources/audios/A19278.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
                   // echo "<td>".$row['jacketthm']."</td>";
                   
                     echo "<td>".'<audio controls>
                                         <source src="'.$audio = WishDB::getInstance()->get_audio_href_by_id($row['id']).'"'.' type="audio/mpeg">Your browser does not support the audio element.</audio>'."</td>"; 
                   
                   // echo "<td>".$row['audio']."</td>";
                    echo "<td>";
                    	echo '<form name="editProgramList" action="editProgram.php" method="GET">';
                    		echo '<input type="hidden" name="programID"  value="'.$row['id']. '"/>';
                    		echo '<input type="submit" name="cmdEditProgram" id="cmdEditProgram" value="Edit">';
                    	echo '</form>';
                    echo "</td>";
                                      
                    echo "</tr>";
                  }
            }
//echo "</tr>";
            ?>
        </table>
</html>