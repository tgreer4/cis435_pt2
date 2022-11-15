<?php
include 'main.php';
check_loggedin($con);


// output message (errors, etc)
$msg = '';
// Retrieve additional account info from the database because we don't have them stored in sessions
$stmt = $con->prepare('SELECT firstname, lastname,password, email, activation_code, role, registered FROM accounts WHERE id = ?');
// In this case, we can use the account ID to retrieve the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($firstname, $lastname,$password, $email, $activation_code, $role, $registered_date);
$stmt->fetch();
$stmt->close()
?>









<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Business website</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-highway.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mainwbsitesignedStyle.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
</head> 
  </head>
  <body>

      <div class="navigation w3-highway-blue w3-container">
        <nav class="nav-container w3-padding-large">
          <div class="logo">
            <a href="#home" >Inner<span>View</span></a>
          </div>
          <div class="mobile-button">
            <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
          </div>
          <div class="links">
            <a href="#home" >Home</a>
            <a href="#about" >About</a>
            <a href="#services" >Services</a>
            <a href="#Companies" >Companies</a>
            <a href="#contact" >Contact</a> 





 <div class="actionpro">
        <div class="profile" onclick="menuToggle();">
            <img src="user.png" alt="">
        </div>

        <div class="menu">
            <h3>
                User Account
                <div class="usernameid" >
							<?=$_SESSION['name']?>
				</div>
            </h3>
            <ul>
                 <li>
                    <span class="material-icons icons-size">person</span>
                    <a href="userprofile.php">My Profile</a>
                </li>
                <li>
                    <span class="material-icons icons-size">mode</span>
                    <a href="userprofile.php?action=edit">Edit Account</a>
                </li>
               
                <li>
                    <span class="material-icons icons-size">account_balance_wallet</span>
                    <a href="logout.php">Log out</a>
                </li>
                
            </ul>
        </div>
    </div>





















			
          </div>
          <div id="mobile-sidenav" class="mobile-links w3-highway-blue">
            <div class="mobile-logo" style="display: inline;">
              <a href="#home" class="logo">Inner<span>View</span></a>
              <span style="width: 100%;"></span>
              <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
            </div>
            <a href="#home" onclick="toggleMobileNavigation()">Home</a>
            <a href="#about" onclick="toggleMobileNavigation()">About Us</a>
            <a href="#services" onclick="toggleMobileNavigation()">Services</a>
            <a href="#Companies" onclick="toggleMobileNavigation()">Companies</a>
            <a href="#contact" onclick="toggleMobileNavigation()">Contact</a>
          </div>
        </nav>
      </div>

      <div class="hero" id="home">
        <div class="text container">
          <p class="pre-title">How to Use</p>
          <h1 class="title"> Inner<span>View?</span></h1>
          <p class="post-title">As an unregistered user, you can search for and scroll through companies that interest you. There is a thread of feedback about users and the workplace from former student employees on the page for each organization. You have the ability to make, add, modify, and remove topics that are personal to you as a verified student. You can also leave comments directly under the reviews left by other students.</p>
           
        </div>
      </div>

      <div class="about container w3-padding-large" id="about">
        <div class="text-one">
          <h2>About Us</h2>
          <p>Users of InnerView can browse reviews of businesses that interest them. These ratings come from former student workers and include details like job title, wage range, tasks, and workplace culture.</p>
           
        </div>
        <div class="text-one">
          <h2>Our Vision</h2>
          <p>Every semester, many students and graduates are unable to secure an internship or job.  Students can learn from InnerView about previous interviews and what to anticipate from the employer. Users of the page can voice their opinions about various jobs at various companies and ask questions about career prospects they are interested in. Each company added will be reviewed by the administrator to ensure that the job is relevant to UMD students.</p>
         
        </div>
      </div>

      <div class="w3-panel w3-highway-blue numbers">
        <h2 class="w3-center w3-xxxlarge">WE HAVE</h2>
        <p class="w3-center w3-xxxlarge show-medium">
          <?xml version="1.0" encoding="utf-8"?>
          <svg x="0px" y="0px" width="36" fill="#bed9f3" stroke="#bed9f3"
            viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
          <g id="Down-arrow">
            <path d="M17.2929993,29.7070007c-0.3906994-0.3906002-0.3906994-1.0234013,0-1.4140015
              c0.3906002-0.3906002,1.0234013-0.3906002,1.4140015,0L32,41.5858994l13.2929993-13.2929001
              c0.3905983-0.3906002,1.0233994-0.3906002,1.4140015,0C46.902298,28.4883003,47,28.7441998,47,29
              c0,0.2558994-0.097702,0.5116997-0.2929993,0.7070007l-14,14c-0.3906021,0.3906975-1.0234013,0.3906975-1.4140015,0
              L17.2929993,29.7070007z"/>
            <path d="M32,64c17.6730957,0,32-14.3269005,32-32S49.6730957,0,32,0C14.3268003,0,0,14.3268995,0,32S14.3268003,64,32,64z M32,62
              C15.4579,62,2,48.542099,2,32C2,15.4580002,15.4579,2,32,2s30,13.4580002,30,30C62,48.542099,48.542099,62,32,62z"/>
          </svg>
        </p>
        <div class="container w3-padding-large">
          <div class="text">
            <p class="number">0</p>
            <p>Clients</p>
          </div>
          <div class="text">
            <p class="number">4</p>
            <p>Employees</p>
          </div>
          <div class="text">
            <p class="number">0</p>
            <p>Years of experience</p>
          </div>
          <div class="text">
            <p class="number">0</p>
            <p>Awards</p>
          </div>
        </div>
      </div>

      <div class="services container" id="services">
        <h2 class="w3-center">Our services</h2>
        <div class="cards w3-padding-large w3-margin-top">
          <div class="card w3-card-2 w3-padding-large w3-border w3-border-blue w3-round-large">
            <h3>Companies Reviews</h3>
            <div class="card-text">
              <p>InnerView can offer a thorough description that helps users learn as much as they can about the companies they're interested in working for by by sharing the users' experiences about the companies they worked in.</p>
            </div>
          </div>
          <div class="card w3-card-2 w3-padding-large w3-border w3-border-blue w3-round-large">
            <h3>Interview Preparation</h3>
            <div class="card-text">
              <p>InnerView assists users in preparing for job interviews by answering their related questions.</p>
            </div>
          </div>
          <div class="card w3-card-2 w3-padding-large w3-border w3-border-blue w3-round-large">
            <h3>CONSULTING</h3>
            <div class="card-text">
              <p>We offer a <span class="">no-obligation</span> consultation on the relevant topic of interviews and offer you the best approach on how to master it.</p>
            </div>
          </div>
          
        </div>
      </div>

      <div class="careers container" id="careers">
        <h2 class="w3-center">Careers at InnerView</h2>
        <div class="cards w3-padding-large w3-margin-top">

            <div class="card w3-card-4">
              <header class="w3-container w3-indigo">
                 <h3>DIGITAL MARKETING CONSULTANT</h3>
              </header>

              <div class="content w3-container">
                <div class="card-text" style="padding-bottom: 20px;">
                  <h4>Requirements</h4>
                  <ul style="list-style-type: none;">
                    <li>3 year of working experience</li>
                    <li>Advanced knowledge of Digital Marketing</li>
                    <li>Advanced knowledge of Analytics and Ads tools</li>
                    <li>Advanced knowledge of Crossbrowser testing tools</li>
                    <li>Great soft skills</li>
                    <li>Can work in a team or alone efficiently</li>
                  </ul>
                  <h4>Feats</h4>
                  <ul style="list-style-type: none;">
                    <li>Great salary, increased with your experience</li>
                    <li>Work from home</li>
                    <li>We give you laptop for your work</li>
                    
                  </ul> 
                </div>
              </div>
              <footer class="w3-container" style="padding: 0">
                <a class="w3-button w3-indigo w3-hover-blue" style="width: 100%;" href="#contact">Apply</a>
              </footer>
            </div>

            <div class="card w3-card-4 w3-round-large">
              <header class="w3-container w3-indigo">
                 <h3>SENIOR FRONTEND DEVELOPER</h3>
              </header>

              <div class="content w3-container">
                <div class="card-text" style="padding-bottom: 20px;">
                <h4>Requirements</h4>
                <ul style="list-style-type: none;">
                  <li>5 years of working experience</li>
                  <li>Advanced knowledge of HTML and CSS</li>
                  <li>Advanced knowledge of advanced Javascript</li>
                  <li>Advanced knowledge of at least one frontend frameworks</li>
                  <li>Knowledge of Git and Github</li>
                  <li>Knowledge of Unit Tests</li>
                  <li>Can work in a team or alone efficiently</li>
                </ul>
                <h4>Feats</h4>
                <ul style="list-style-type: none;">
                  <li>Great salary, increased with your experience</li>
                  <li>Work from home</li>
                  <li>We give you laptop for your work</li>
                 
                </ul>
                </div>
              </div>
              <footer class="w3-container" style="padding: 0">
                <a class="w3-button w3-indigo w3-hover-blue" style="width: 100%;" href="#contact">Apply</a>
              </footer>
            </div>

            <div class="card w3-card-4">
              <header class="w3-container w3-indigo">
                 <h3>JUNIOR FRONTEND DEVELOPER</h3>
              </header>

              <div class="content w3-container">
                <div class="card-text" style="padding-bottom: 20px;">
                <h4>Requirements</h4>
                <ul style="list-style-type: none;">
                  <li>1 year of working experience</li>
                  <li>Knowledge of HTML and CSS</li>
                  <li>Knowledge of Javascript</li>
                  <li>Knowledge of at least one frontend framework</li>
                  <li>Will to learn more both in team and alone</li>
                </ul>
                <h4>Feats</h4>
                <ul style="list-style-type: none;">
                  <li>Great salary, increased with your experience</li>
                  <li>Work from home</li>
                  <li>We give you laptop for your work</li>
                 
                </ul>
                </div>
              </div>
              <footer class="w3-container" style="padding: 0">
                <a class="w3-button w3-indigo w3-hover-blue" style="width: 100%;" href="#contact">Apply</a>
              </footer>
            </div>
        </div>
      </div>

      <div class="contact container" id="contact">
        <div class="short-contact">
          <h2>Contact us</h2>
          <p class="w3-xlarge">We would like to hear from you!</p>
          <div class="w3-large w3-margin-top contact-info">
            <i class="fa fa-location-arrow"></i><span style="margin-left:10px;"><a href="https://www.google.com/maps/place/University+of+Michigan-Dearborn/@42.3176343,-83.2342186,17z/data=!3m1!4b1!4m5!3m4!1s0x883b35747403004f:0x37bcece74d237758!8m2!3d42.3176343!4d-83.2320299" target="_blank">4901 Evergreen Rd, Dearborn, MI 48128</a></span><br>
            <i class="fa fa-envelope-o"></i><span style="margin-left:10px;"><a href="">Inner@View.com</a></span><br>
            <i class="fa fa-phone"></i><span style="margin-left:10px;"><a href="">+13135935000</a></span><br>
          </div>
          <div class="w3-large w3-margin-top contact-info">
            <i class="fa fa-linkedin"></i><span style="margin-left:10px;"><a href="#" target="_blank" style="text-decoration: none;">- LinkedIn</a></span><br>
            <i class="fa fa-facebook"></i><span style="margin-left:10px;"><a href="#" target="_blank" style="text-decoration: none;"> - Facebook</a></span><br>
            <i class="fa fa-twitter"></i><span style="margin-left:10px;"><a href="#" target="_blank" style="text-decoration: none;">- Twitter</a></span><br>
          </div>
        </div>
        <div class="form w3-margin-top">
          <div class="container w3-round-xlarge">
            <form class="w3-highway-blue w3-padding-large w3-round-large">
              <label for="fname">First Name</label>
              <input type="text" id="name" name="name" placeholder="Your name">

              <label for="lname">Last Name</label>
              <input type="text" id="email" name="email" placeholder="Your email">

              <label for="subject">Subject</label>
              <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
              
              <p>By submiting this form, you agree to our <a href="privacy-policy.html" target="_blank">privacy policy</a></p><br>
              <input class="w3-metro-blue" type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>

      <div class=" w3-highway-blue w3-padding-large" id="footer">
        <p class="w3-center logo">© 2022 - Inner<span>View</span> - All rights reserved</p>
      </div>
<script ">

 function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }
</script>
  

  </body>
</html>