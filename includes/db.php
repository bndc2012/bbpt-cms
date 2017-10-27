<?php
//display_errors = Off;
class WishDB extends mysqli {


    // single instance of self shared among all instances
    private static $instance = null;


    // db connection config vars for server-x10hosting
    private $user = "bbptsand";
    private $pass = "radhalove";
    private $dbName = "bbptsand_CMS";// 
    private $dbHost = "xo7.x10hosting.com";
    
     // db connection config vars for localhost-mamp-imac
//    private $user = "bbptsand";
//    private $pass = "radhalove";
//    private $dbName = "bbptsand_CMS";// 
//    private $dbHost = "xo7.x10hosting.com";
    
     // db connection config vars for locaholhost-xampp-netbook
//    private $user = "bbptsand";
//    private $pass = "radhalove";
//    private $dbName = "bbptsand_CMS";// 
//    private $dbHost = "xo7.x10hosting.com";
    
     //This method must be static, and must return an instance of the object if the object
 //does not already exist.
 public static function getInstance() {
   if (!self::$instance instanceof self) {
     self::$instance = new self;
   }
   return self::$instance;
 }

 // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
 // thus eliminating the possibility of duplicate objects.
 public function __clone() {
   trigger_error('Clone is not allowed.', E_USER_ERROR);
 }
 public function __wakeup() {
   trigger_error('Deserializing is not allowed.', E_USER_ERROR);
 }
 
 // private constructor
private function __construct() {
    parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
    if (mysqli_connect_error()) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    parent::set_charset('utf-8');
}
public function get_dayperiod_name_by_id($id) {

   // $name = $this->real_escape_string($name);

    $result= $this->query("SELECT time_period FROM event_time WHERE id =". $id);
  if ($result->num_rows > 0){
        $row = $result->fetch_row();
        return $row[0];
    } else
        return null;
    
}
public function get_image_href_by_id($id) {

   // $name = $this->real_escape_string($name);

    $result= $this->query("SELECT jacketimg FROM programs WHERE id =". $id);
  if ($result->num_rows > 0){
        $row = $result->fetch_row();
        return $row[0];
    } else
        return null;
    
}
public function get_thumb_src_by_id($id) {

   // $name = $this->real_escape_string($name);

    $result= $this->query("SELECT jacketthm FROM programs WHERE id =". $id);
  if ($result->num_rows > 0){
        $row = $result->fetch_row();
        return $row[0];
    } else
        return null;
    
}
public function get_audio_href_by_id($id) {

   // $name = $this->real_escape_string($name);

    $result= $this->query("SELECT audio FROM programs WHERE id =". $id);
  if ($result->num_rows > 0){
        $row = $result->fetch_row();
        return $row[0];
    } else
        return null;
    
}

public function get_cassette_capacity_by_id($id) {

   // $name = $this->real_escape_string($name);

    $result= $this->query("SELECT name FROM cassette_capacity WHERE id =". $id);
  if ($result->num_rows > 0){
        $row = $result->fetch_row();
        return $row[0];
    } else
        return null;
    
}
public function get_dayperiod_id_by_name($name) {

    $name = $this->real_escape_string($name);

   // $dayperiod = $this->query("SELECT id FROM event_time WHERE name = '";

         //   . $name . "'");
    if ($dayperiod->num_rows > 0){
        $row = $dayperiod->fetch_row();
        return $row[0];
    } else
        return null;
}
public function get_eveloc_id_by_name($name) {

    $name = $this->real_escape_string($name);

    $eventloc = $this->query("SELECT id FROM event_locations WHERE name = '"

            . $name . "'");
    if ($eventloc->num_rows > 0){
        $row = $eventloc->fetch_row();
        return $row[0];
    } else
        return null;
}

public function getAllEventLocations() {

    return $this->query("SELECT id, name FROM event_locations");
}

public function getAllArchiveLocations() {

    return $this->query("SELECT id, name FROM archive_locations");
}

public function getAllCassetteCap() {

    return $this->query("SELECT id, name FROM cassette_capacity");
}
public function getAllEventTime() {

    return $this->query("SELECT id, time_period FROM event_time");
}
public function getAllPeople() {


    return $this->query("SELECT id, first_name,last_name FROM people");


//return $query->result_array();
//return $query->row;
}
public function get_wishes_by_wisher_id($wisherID) {
    return $this->query("SELECT id, description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
}

public function create_wisher ($name, $password){
    $name = $this->real_escape_string($name);
    $password = $this->real_escape_string($password);
    $this->query("INSERT INTO wishers (name, password) VALUES ('" . $name . "', '" . $password . "')");
}

public function verify_wisher_credentials ($first_name, $password){
   $first_name = $this->real_escape_string($first_name);

   $password = $this->real_escape_string($password);
   $result = $this->query("SELECT 1 FROM people
 	           WHERE first_name = '" . $first_name . "' AND password = '" . $password . "'");
   return $result->data_seek(0);
}
function insert_wish($wisherID, $description, $duedate){
    $description = $this->real_escape_string($description);
    if ($this->format_date_for_sql($duedate)==null){
        $this->query("INSERT INTO wishes (wisher_id, description)" .
             " VALUES (" . $wisherID . ", '" . $description . "')");
    } else
    $this->query("INSERT INTO wishes (wisher_id, description, due_date)" . 
                       " VALUES (" . $wisherID . ", '" . $description . "', " 
                       . $this->format_date_for_sql($duedate) . ")");
}//make sure that parameters are one-to-one matchw with the passing arguments here-otherwise mistmached will occur in database
function insert_program($serial_no,$recorded_dte,$dayperiod_id,$cassettecap_id,$audio,$eventloc_id,$archiveloc_id,$jacketimg,$jacketthm,$comment){
 
                           
               
    $comment = $this->real_escape_string($comment);
    $this->query("INSERT INTO programs(serial_no,recorded_dte,dayperiod_id,cassettecap_id,audio,eventloc_id,archiveloc_id,jacketimg,jacketthm,comment)VALUES('{$serial_no}','{$recorded_dte}','{$dayperiod_id}','{$cassettecap_id}','{$audio}','{$eventloc_id}','{$archiveloc_id}','{$jacketimg}','{$jacketthm}','{$comment}')");
                                        
}

//todo: create function that includes the user_id when inserting a program
function format_date_for_sql($date){
    if ($date == "")
        return null;
    else {
        $dateParts = date_parse($date);
        return $dateParts["year"]*10000 + $dateParts["month"]*100 + $dateParts["day"];
   }

}
function format_date_for_display_year($date){
    
        $y = date('Y',strtotime($date));
        $yy = substr($y,2);
        return $yy;
   

}

function format_date_for_display($date){
    
        $day = date('D', strtotime( $date));
        $datefrm=substr($date,5);
        return $day." ". $datefrm;
}

public function update_wish($wishID, $description, $duedate){
    $description = $this->real_escape_string($description);
    if ($duedate==''){
        $this->query("UPDATE wishes SET description = '" . $description . "',
             due_date = NULL WHERE id = " . $wishID);
    } else
        $this->query("UPDATE wishes SET description = '" . $description .
            "', due_date = " . $this->format_date_for_sql($duedate)
            . " WHERE id = " . $wishID);
} 
public function get_wish_by_wish_id ($wishID) {
    return $this->query("SELECT id, description, due_date FROM wishes WHERE id = " . $wishID);
}

function delete_wish ($wishID){
    $this->query("DELETE FROM wishes WHERE id = " . $wishID);
}
}