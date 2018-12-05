<?php

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'HireMe';

$email=$_POST['Email'];
$p_word=$_POST['Password'];

try{
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 }catch(PDOException $e)
 {
    echo "Connection failed:" .$e->getMessage();
 }

/*if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
   $stmt = $conn->query("SELECT * FROM Users WHERE email = '$email'");
    $stmt2 = $conn->query("SELECT * FROM Jobs WHERE password='$p_word'");
    
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
 foreach ($stmt as $row) {
 if($stmt == true && $stmt2 == true){
   echo "Login success!!! Welcome ".$row['email'];
     
}else{
 echo "Invalid email or passsword";
 echo "stmt:",$info['email'];
}
 

  session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['email'];
      $mypassword = $_POST['p_sword']; 
      
      $sql = "SELECT email FROM Users WHERE email = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($dbname,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     $active = $row['active'];
      
     $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
       $_SESSION['login_user'] = $myusername;
      echo 'Logged in';
         
      header("location: home.php");
      }else {
       $error = "Your Login Name or Password is invalid";
       echo 'Nope';
      }
   }
*/  
  // function to escape data and strip tags
function safestrip($string){
       $string = strip_tags($string);
      // $string = mysql_real_escape_string($string);
       return $string;
}

//function to show any messages
function messages() {
   $message = '';
   if($_SESSION['success'] != '') {
       $message = '<span class="success" id="message">'.$_SESSION['success'].'</span>';
       $_SESSION['success'] = '';
   }
   if($_SESSION['error'] != '') {
       $message = '<span class="error" id="message">'.$_SESSION['error'].'</span>';
       $_SESSION['error'] = '';
   }
   return $message;
}

// log user in function
function login($conn, $email, $p_word){

 //call safestrip function
 $user = safestrip($email);
 $pass = safestrip($p_word);

 //convert password to md5
 $pass = md5($pass);

  // check if the user id and password combination exist in database
  $stmt = $conn->prepare("SELECT * FROM Users WHERE email = :email AND password = :pass");
  $stmt->bindParam(':email', $user, PDO::PARAM_STR);
  $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
  //if match is equal to 1 there is a match
  if ($user) {

                          //set session
                          $_SESSION['authorized'] = true;

                          // reload the page
                         $_SESSION['success'] = 'Login Successful';
                         header('Location: home.php');
                        
                         die();


   } else {
               // login failed save error to a session
              
               $_SESSION['error'] = 'Sorry, wrong username or password';
  }
}


login($conn, $email, $p_word)       ; 
    
?>