<?php
  
  session_start();
  
  $host = getenv('IP');
  $username = getenv('C9_USER');
  $password = '';
  $dbname = 'HireMe';
 try{
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  echo "Connected";
 }catch(PDOException $e)
 {
    echo "Connection failed:" .$e->getMessage();
 }
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
      /*if(!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']){
          echo "<p>unwanted user detected</p>";
      }else{*/
          
          $stmt = $conn->prepare("INSERT INTO Users(firstname,lastname,password,telephone,email,date_joined) 
          VALUES(:f_name,:l_name,:p_word,:tele,:mail,:ddate)");
          $stmt->bindParam(':f_name', $firstname);
          $stmt->bindParam(':l_name', $lastname);
          $stmt->bindParam(':p_word', $password);
          $stmt->bindParam(':tele', $telephone);
          $stmt->bindParam(':mail', $email);
          $stmt->bindParam(':ddate', $ddate);
          
          $firstname = clean_input($_POST['f_name']);
          $lastname = clean_input($_POST['l_name']);
          $password = clean_input($_POST['p_word']);
          $telephone = clean_input($_POST['tele']);
          $email = clean_input($_POST['mail']);
          $ddate = date("Y-m-d");
          
          switch(true){
            
            case (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/", $password)):
              echo "<p>Password is not valid!</p>"; 
              break;
              
            case (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $telephone)):
              echo "<p>Telephone # is not valid! Format must be for eg 876-555-7896</p>"; 
              break;
            
            case (!filter_var($email, FILTER_VALIDATE_EMAIL)):
              echo "<p>Email is not valid!</p>"; 
              break;
            
            default:
              $password = password_hash(clean_input($_POST['password']),PASSWORD_DEFAULT);
              $stmt->execute();
              header('Location: home.php'); //takes user back to dashboard 
          }
  
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