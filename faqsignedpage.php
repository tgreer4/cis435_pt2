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
    <link rel="stylesheet" href="faqstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
	 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faq JavaScript</title>
  </head>
  <body>

      <div class="navigation w3-highway-blue w3-container">
        <nav class="nav-container w3-padding-large">
          <div class="logo">
            <a href="mainwbsitesigned.php" >Inner<span>View</span></a>
          </div>
          <div class="mobile-button">
            <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
          </div>
          <div class="links">
            <a href="mainwbsitesigned.php" >Home</a>
           
            
            <a href="#Companies" >Companies</a>
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
           
            <a href="#Companies" onclick="toggleMobileNavigation()">Companies</a>
            <a href="#sign" onclick="toggleMobileNavigation()">Sign In/Sign Up</a>
          </div>
        </nav>
		
      </div>

      <div class="hero" id="home">
	  <div class="container">
        <h1 class="title">
            Frequenty Asked Questions
        </h1>
        <main class="accordion">
            <div class="faq-img">
                <img src="img.png" alt="" class="accordion-img">
            </div>
            <div class="content-accordion">
                <div class="question-answer">
                    <div class="question">
                        <h3 class="title-question">
                            Why can't I rate and add a comment?
                        </h3>
                        <button class="question-btn">
                            <span class="up-icon">
                                <i class="fas fa-chevron-up"></i>
                            </span>
                            <span class="down-icon">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </div>
                    <div class="answer">
                        <p>In order to get the ability to rate a company and comment, you must log in first.</p>
                    </div>
                </div>
                <div class="question-answer">
                    <div class="question">
                        <h3 class="title-question">
                            What is the differrence between 
                            Front-end and Back-end?
                        </h3>
                        <button class="question-btn">
                            <span class="up-icon">
                                <i class="fas fa-chevron-up"></i>
                            </span>
                            <span class="down-icon">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </div>
                    <div class="answer">
                        <p>Front-end development focuses on the visual aspects of a website – the part that users see and interact with. Back-end development comprises a site's structure, system, data, and logic.</p>
                    </div>
                </div>
                <div class="question-answer">
                    <div class="question">
                        <h3 class="title-question">
                            Which is better Front-end or Back-end?
                        </h3>
                        <button class="question-btn">
                            <span class="up-icon">
                                <i class="fas fa-chevron-up"></i>
                            </span>
                            <span class="down-icon">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </div>
                    <div class="answer">
                        <p>If you're interested in the designing aspect, the front end would be great. If you're good at logical thinking, API, server management, the back end would be better.</p>
                    </div>
                </div>
                <div class="question-answer">
                    <div class="question">
                        <h3 class="title-question">
                            What is Front-end?
                        </h3>
                        <button class="question-btn">
                            <span class="up-icon">
                                <i class="fas fa-chevron-up"></i>
                            </span>
                            <span class="down-icon">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </div>
                    <div class="answer">
                        <p>The front-end is the part of the website users can see and interact with such as the graphical user interface (GUI) and the command line including the design, navigating menus, texts, images, videos, etc. </p>
                    </div>
                </div>
                <div class="question-answer">
                    <div class="question">
                        <h3 class="title-question">
                            What is Back-end?
                        </h3>
                        <button class="question-btn">
                            <span class="up-icon">
                                <i class="fas fa-chevron-up"></i>
                            </span>
                            <span class="down-icon">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </div>
                    <div class="answer">
                        <p>The back end refers to parts of a computer application or a program's code that allow it to operate and that cannot be accessed by a user. Most data and operating syntax are stored and accessed in the back end of a computer system</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
      
          


    <script src="faqcontroler.js"></script>
<script ">

 function menuToggle(){
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }
</script>


  </body>
</html>