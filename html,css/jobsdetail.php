
<?php
//Reuest and sends job detail for a particular job
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'HireMe';





try{
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 }catch(PDOException $e)
 {
    echo "Connection failed:" .$e->getMessage();
 }
//if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $stmt = $conn->query("SELECT * FROM Jobs WHERE Jobs_id = 1");
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
echo '<head>
        <title>HireMe</title>
        <link href = "home.css" type = "text/css" rel = "stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         
    </head>
    <body id = "body">
        <div class="wrapper">
            
            <header>
                <p>HireMe</p>
            </header>
          
            <section id = "details">';

foreach ($info as $row) {
        echo '<h1 id="title">'.$row['job_title'].'</h1>';
        echo '<button type="button">Apply Now</button>';
        echo '<p id = "date">'.$row['date_posted'].'</p>';
        echo '<p id = "cat">'.$row['category'].'</p>';
                
        echo '<h2 id = "coName">'.$row['company_name'].'<br>'.$row['company_location'].'</h2>';
        echo '<br/>';
        echo '<br/>';
                 
        echo '<div class = "jobDes">';
                     
        echo '<h3> Job Description</h3>';
        echo '<p id = "desc"> '.$row['job_description'].'</p>';
        echo '<br/>';
        echo '<p> <b>Job Requirements</b></p>';
        echo '<ul id = "req">';
        echo '<li>list of requirements</li>';
        echo '</ul>';
        echo ' </div>';
        
    }
   
    echo ' <script> 
            $(document).ready(function(){
                var trigger = $("#nav ul li a");
                var container = $("#body");
                
                trigger.on("click", function(){
                    var $this = $(this);
                    var target = $this.data("target");
                    
                    container.load(target);
                    
                    return false;
                });
            });
        </script>'; 
   echo'
            </section>
            
            <nav id="nav">
                 <ul>
                     <li id ="home"> <img src = "http://www.stickpng.com/assets/images/588a6758d06f6719692a2d22.png" 
                     width = "20" height = "15"><a href = "#" data-target ="home.php">Home</a></li>
                     
                     <li id ="add"><img src = "https://png.pngtree.com/svg/20170222/add_friends_232334.png" 
                     width = "17" height = "18"><a href = "#" data-target ="newUser.html">Add User</a></li>
                     
                     <li id ="njob"><img src = "http://cdn.onlinewebfonts.com/svg/img_386644.png" 
                     width = "17" height = "15"><a href = "#" data-target ="newJob.html">New Job </a></li>
                     
                     <li id ="log"><img src = "https://png.pngtree.com/svg/20170825/logout_1185957.png" 
                     width = "17" height = "15"><a href = "logout.php">Logout </a></li>
                </ul>
            </nav>
            <br/>
            
        </div>
        </body>';
       
        
     

    
//}

?>