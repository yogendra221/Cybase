<?php
class course
{
  private $conn;
  function __construct() {
    $servername = "localhost";
    $dbname = "cybase";
    $username = "root";
    $password = "";


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
      $this->conn=$conn;  
    }

  }


  public function course_list(){

    $sql = "SELECT * FROM course";

    if(isset($_POST['sort'])) { 

      $by_provider = $_POST['provider_filter'];
      $by_domain = $_POST['domain_filter'];
      if($by_provider!='select' && $by_domain!='select'){
        $sql.= " where provider_name='$by_provider' and domain_name='$by_domain'";
      }
      elseif($by_provider!='select') {
        $sql.= " where provider_name='$by_provider'";
      }
      elseif($by_domain!='select') {
        $sql .= " where domain_name='$by_domain'";
      }
      if($_POST['sort'] == 'name_asc') {
        $sql = $sql." ORDER BY course_name ASC ";
      }
      elseif($_POST['sort'] == 'name_des') {
        $sql =$sql." ORDER BY course_name DESC";
      }
      elseif($_POST['sort'] == 'review_asc') {
        $sql =$sql." ORDER BY avg_rate ASC";
      }
      elseif($_POST['sort'] == 'review_des') {
        $sql =$sql." ORDER BY  avg_rate DESC";
      }
    }
    $result=  $this->conn->query($sql);
    return $result;  
  }

  public function provider_list(){

    $sql = "SELECT * FROM provider ORDER BY provider_name ASC";
    $result=  $this->conn->query($sql);
    return $result;  
  }

  public function domain_list(){

    $sql = "SELECT domain_name FROM domain ORDER BY domain_name ASC";
    $result=  $this->conn->query($sql);
    return $result;  
  }
  public function course_desc($course_id){
    $sql = "SELECT * FROM course where course_id='$course_id'";
    $result=  $this->conn->query($sql);
    return $result;  
  }
  public function domain_desc($course_id){
    $sql = "SELECT * FROM domain where domain_name=(select domain_name from course where course_id='$course_id')";
    $result=  $this->conn->query($sql);
    return $result;  
  }
  public function domain_description($domain_name){
    $sql = "SELECT * FROM domain where domain_name='$domain_name'";
    $result=  $this->conn->query($sql);
    return $result;  
  }
  public function provider_description($provider_name){
    $sql = "SELECT * FROM provider where provider_name='$provider_name'";
    $result=  $this->conn->query($sql);
    return $result;  
  }
  public function create_new_course($post_data=array()){

    if(isset($post_data['addcourse'])){
      $course_name= mysqli_real_escape_string($this->conn,trim($post_data['course_name']));
      $duration= mysqli_real_escape_string($this->conn,trim($post_data['duration']));
      $link= mysqli_real_escape_string($this->conn,trim($post_data['link']));
      $result=false;
      if(isset($post_data['provider_filter']) && isset($post_data['domain_filter']) ){
        $provider_filter= mysqli_real_escape_string($this->conn,trim($post_data['provider_filter']));
        $domain_filter= mysqli_real_escape_string($this->conn,trim($post_data['domain_filter']));
        $sql="INSERT INTO course (course_name,duration,link,provider_name,domain_name) VALUES ('$course_name', '$duration', '$link','$provider_filter','$domain_filter')";
        $result=  $this->conn->query($sql);
      }
      if($result){
        header('Location: admin.php?selected=update_remove_course'); 
      }

      unset($post_data['addcourse']);
    }


  }


  public function create_new_domain($post_data=array()){

    if(isset($post_data['adddomain'])){
      $domain_name= mysqli_real_escape_string($this->conn,trim($post_data['domain_name']));
      $domain_desc= mysqli_real_escape_string($this->conn,trim($post_data['domain_desc']));

      $sql="INSERT INTO domain (domain_name,domain_description) VALUES ('$domain_name', '$domain_desc')";

      $result=  $this->conn->query($sql);

      if($result){
        header('Location: admin.php?selected=update_remove_domain'); 
      }

      unset($post_data['adddomain']);
    }


  }
  public function create_new_provider($post_data=array()){

    if(isset($post_data['addprovider'])){
      $provider_name= mysqli_real_escape_string($this->conn,trim($post_data['provider_name']));
      $contact= mysqli_real_escape_string($this->conn,trim($post_data['provider_contact']));
      $website= mysqli_real_escape_string($this->conn,trim($post_data['provider_website']));

      $sql="INSERT INTO provider (provider_name,contact,website) VALUES ('$provider_name', '$contact', '$website')";

      $result=  $this->conn->query($sql);

      if($result){
        header('Location: admin.php?selected=update_remove_provider'); 
      }

      unset($post_data['addprovider']);
    }


  }

  public function update_course($post_data=array(),$course_id){

    if(isset($post_data['updatecourse'])){
      $course_name= mysqli_real_escape_string($this->conn,trim($post_data['course_name']));
      $duration= mysqli_real_escape_string($this->conn,trim($post_data['duration']));
      $link= mysqli_real_escape_string($this->conn,trim($post_data['link']));
      $provider_filter= mysqli_real_escape_string($this->conn,trim($post_data['provider_filter']));
      $domain_filter= mysqli_real_escape_string($this->conn,trim($post_data['domain_filter']));
      $sql="UPDATE course set course_name='$course_name',duration='$duration',link='$link',provider_name='$provider_filter',domain_name='$domain_filter' where course_id='$course_id'";
      $result=  $this->conn->query($sql);

      if($result){
        header('Location: admin.php?selected=update_remove_course'); 
      }

      unset($post_data['updatecourse']);
    }


  }
  public function update_domain($post_data=array(),$domain_name){

    if(isset($post_data['updatedomain'])){
      $domain_desc= mysqli_real_escape_string($this->conn,trim($post_data['domain_desc']));
      $sql="UPDATE domain set domain_description='$domain_desc' where domain_name='$domain_name'";
      $result=  $this->conn->query($sql);

      if($result){
        header('Location: admin.php?selected=update_remove_domain'); 
      }

      unset($post_data['updatedomain']);
    }


  }
  public function update_provider($post_data=array(),$provider_name){

    if(isset($post_data['updateprovider'])){
      $contact= mysqli_real_escape_string($this->conn,trim($post_data['contact']));
      $website= mysqli_real_escape_string($this->conn,trim($post_data['website']));
      $sql="UPDATE provider set contact='$contact',website='$website' where provider_name='$provider_name'";
      $result=  $this->conn->query($sql);

      if($result){
        header('Location: admin.php?selected=update_remove_provider'); 
      }

      unset($post_data['updateprovider']);
    }


  }
  public function remove_course($id){

    $course_id= mysqli_real_escape_string($this->conn,trim($id));
    $sql="DELETE FROM course WHERE course_id=$course_id";
    $result=  $this->conn->query($sql);
    header('Location: admin.php?selected=update_remove_course'); 
  }

  public function remove_provider($id){

    $provider_name= mysqli_real_escape_string($this->conn,trim($id));
    $sql="DELETE FROM provider WHERE provider_name='$provider_name'";
    $result=  $this->conn->query($sql);
    header('Location: admin.php?selected=update_remove_domain'); 
  } 
  public function remove_domain($id){

    $domain_name= mysqli_real_escape_string($this->conn,trim($id));
    $sql="DELETE FROM domain WHERE domain_name='$domain_name'";
    $result=  $this->conn->query($sql);
    header('Location: admin.php?selected=update_remove_provider'); 
  }   

  public function add_review($post_data=array(),$id,$user){
    if(isset($post_data['add_review'])){
      $review_desc= mysqli_real_escape_string($this->conn,trim($post_data['review_desc']));
      $course_id= mysqli_real_escape_string($this->conn,trim($id));
      $username= mysqli_real_escape_string($this->conn,trim($user));
      $rating=0;
      if(isset($_POST['star'])) {
        $rating=$_POST['star'];
      }

      $sql="INSERT INTO review (course_id,username,rating,description) VALUES ('$course_id', '$username','$rating','$review_desc')";
      $result=  $this->conn->query($sql);
      $sql="UPDATE review set rating=$rating,description='$review_desc' where course_id=$course_id and username='$username'";
      $result=  $this->conn->query($sql);
      header('Location: course_details.php?courseID='.$id); 
    }

    unset($post_data['add_review']);
  }

    public function showReview($id){

    $course_id= mysqli_real_escape_string($this->conn,trim($id));
    $sql="CALL GetReview($course_id)";
    $result=  $this->conn->query($sql); 
    return $result;
  }

    public function call_setavg_proc($id){

    $course_id= mysqli_real_escape_string($this->conn,trim($id));
    $sql="CALL SetAvgRating($course_id)";
    $result=  $this->conn->query($sql); 
  }

    public function remove_user($id){

    $username= mysqli_real_escape_string($this->conn,trim($id));
    $sql="DELETE FROM person WHERE username='$username'";
    $result=  $this->conn->query($sql);
    header('Location: admin.php?selected=update_remove_provider'); 
  }



  function __destruct() {
    mysqli_close($this->conn);  
  }

}

?>