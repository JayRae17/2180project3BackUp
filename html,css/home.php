<?php
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'HireMe';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$stmt = $conn->query("SELECT * FROM Jobs");
$info = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<head>
        <title>Hire Me</title>
        <link href = "home.css" type = "text/css" rel = "stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>';
    

echo '<body id = "body">
        
        <script> 
            $(document).ready(function(){
                var nav = $("#nav ul li a");
                var dtl = $("table tr td a");
                var pJob = $("section span a");
                var container = $("#body");
                
                nav.on("click", function(){ 
                    var $this = $(this);
                    var target = $this.data("target");
                    
                    container.load(target);
                    
                    return false;
                });
                
                dtl.on("click", function(){ 
                    var $this = $(this);
                    var target = $this.data("target");
                    
                    container.load(target);
                    
                    return false;
                });
                
                pJob.on("click", function(){ 
                    var $this = $(this);
                    var target = $this.data("target");
                    
                    container.load(target);
                    
                    return false;
                });
            });         
        </script>
            
        <div class="wrapper">
            
            <header>
                <p>HireMe</p>
            </header>
            
            <section>
                <h1>Dashboard</h1> <span> <a href = "#" data-target ="newJob.html"/a> Post a Job</span>
                <style>
                span>a{
                        float: right;
                        margin-right: 6.3%;
                        background-color: #6CD03A; 
                        border: none;
                        color: white;
                        font-weight: bold;
                        padding: 13px 55px;
                        border-radius: 3px;
                        text-align: center;
                        font-size: 13px;
                        cursor: pointer;
                        margin-top: -10px;
                        text-decoration: none;
                        }

                span>a:hover{
                        background-color: #59b42b;
                        }
                </style>
                 
                 <table> <!-- Jobs Available Table -->
                     <caption>Available Jobs</caption>
                     <tr class = "head">
                         <th> Company</th>
                         <th> Job Title</th>
                         <th> Category</th>
                         <th> Date</th> ';
echo '<th class = "hide">'. "ID" . '</th>';
echo '</tr>';
foreach ($info as $row) {
  echo '<tr>';
  echo '<td>' . $row['company_name'] . '</td>';
  echo '<td>' . '<a href = "#" data-target ="jobsdetail.php">' . $row['job_title'] . '</a>' . '</td>';
  echo '<td>' . $row['category'] . '</td>';
  echo '<td>' . $row['date_posted'] . '</td>';
  echo '<td class = "hide" id="ele_id">' . $row['jobs_id'] . '</td>';
  echo '</tr>';
}
echo'</table>';


//Jobs applied for
try{
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT Jobs.Jobs_id, company_name, job_title, category, date_applied FROM Jobs JOIN JobsAppliedFor ON Jobs.Jobs_id = JobsAppliedFor.Job_id where JobsAppliedFor.user_id = 3");
$stmt->execute();
$info = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo ' <table>
         <caption>Jobs Applied For</caption>
          <tr class = "head">
              <th> Company</th>
              <th>Job Title </th>
              <th> Category</th>
              <th> Date Applied</th> ';
echo '<th class = "hide">'. "ID" . '</th>';
echo '</tr>';
foreach ($info as $row) {
  echo '<tr>';
  echo '<td>' . $row['company_name'] . '</td>';
  echo '<td>' . '<a href = "#" data-target ="jobsdetail.php">' . $row['job_title'] . '</a>' . '</td>';
  echo '<td>' . $row['category'] . '</td>';
  echo '<td>' . $row['date_applied'] . '</td>';
  echo '<td class = "hide">' . $row['jobs_id'] . '</td>';
  echo '</tr>';
}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo' </table>
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
                     width = "17" height = "15"><a href = "logout.php" >Logout </a></li>
                </ul>
            </nav>
            <br/>
            
        </div>
    </body>';

?>