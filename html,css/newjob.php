<?php
  
  session_start();
  
  $host = getenv('IP');
  $username = getenv('C9_USER');
  $password = '';
  $dbname = 'HireMe';
 try{
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e)
 {
    echo "Connection failed:" .$e->getMessage();
 }
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
      /*if(!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']){
          echo "<p>unwanted user detected</p>";
      }else{*/
          
          $stmt = $conn->prepare("INSERT INTO Jobs(job_title, job_description, category, company_name, company_location,date_posted) VALUES(:j_title,:j_des,:selection,:comp,:j_loc,:ddate)");
          $stmt->bindParam(':j_title', $JobTitle);
          $stmt->bindParam(':j_des', $Jobdes);
          $stmt->bindParam(':selection', $Selection);
          $stmt->bindParam(':comp', $Companyname);
          $stmt->bindParam(':j_loc', $CompanyLoc);
          $stmt->bindParam(':ddate', $ddate);
          
          $JobTitle = clean_input($_POST['j_title']);
          $Jobdes = clean_input($_POST['j_des']);
          $Selection= clean_input($_POST['selection']);
          $Companyname = clean_input($_POST['comp']);
          $CompanyLoc= clean_input($_POST['j_loc']);
          $ddate = date("Y-m-d");
          
          $stmt->execute();
         // echo "<p>New job details successfully added!</p>";
         header('Location: home.php'); //takes user back to dashboard
          
      
  
    }
  
  
  //santitize all data inputs from form
  function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlentities($data);
        $data = htmlspecialchars($data);
        return $data;
      } 
      
?>