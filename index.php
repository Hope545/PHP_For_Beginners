<?php          

// starting the session
session_start();

// fetching the connection to the database
require "config.php";

// making sure nobody can access this page when logged in
if(!isset($_SESSION['email'])){

    // redirecting the user to the login page
    header("location: login.php");
}

// fetching the user's details from the database
$fetchUser = $conn->query("SELECT * FROM `users` WHERE `email` = '$_SESSION[email]'");
$fetchUser->execute();
$fetchUserDetails = $fetchUser->fetch(PDO::FETCH_ASSOC);

// checking if data is fetched
if($fetchUser->rowCount() > 0){

    // creating variables to store the first and last name of the user
    $firstname = $fetchUserDetails['firstname'];
    $lastname = $fetchUserDetails['lastname'];
    $userId = $fetchUserDetails['id'];
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: 0;
            font-family: sans-serif;
        }

        body{
            width: 100%;
            height: 100vh;
            background: linear-gradient(to top right, rgba(0, 0, 255, 0.24), white);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        ::-webkit-scrollbar{
            width: 0;
        }

        .container{
            width: 70%;
            height: auto;
            box-shadow: 0 0 5px blue ;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .container p{
            background-color: rgb(2, 2, 161);
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            cursor: default;
            color: white;
            font-size: 1.5em;
            font-weight: bold;
        }

        .text p{
            padding: 10px;
            text-align: center;
            margin: 10px;
            font-size: 1em;
            background-color: white;
            color:  black;
            font-weight: 0;
            color: black;
        }

        .text p:first-child{
        margin-top: 30px;
        }

        .container a{
            text-decoration: none;
            width: auto;
            border: 0;
            font-size: 1.1em;
            margin: 30px 40% 10px 40%;
            background-color: rgb(2, 2, 161);
            color: rgb(255, 255, 255);
            transition: 1s;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .container a:hover{
            transform: scale(1.05);
        }

        .container p i{
            margin: 0 10px;
            font-style: normal;
            color: rgb(6, 172, 223);
            font-weight: bold;
        }


    </style>
</head>
<body>
    <div class="container">
        <p> <i><?php if($fetchUser->rowCount() > 0)   {?>
        
            <?php echo $firstname . " " . $lastname?>

            <?php } else{?>
                USER
            <?php }?>
        
        
        
        </i>WELCOME TO THE WORLD OF PHP</p>

        <div class="text">
            <p class="text1">
                

            </p>

            <p class="text2">
                

            </p>

            <p class="text3">
                
            </p>

            <p class="text4">
               
            </p>
        </div>

        <a href="logout.php<?php if ($fetchUser->rowCount() > 0) {?>

            <?php echo "?id=" . $userId }else{ echo "";} ?>
            
            ">LOGOUT</a> 
        <a href="view.php">VIEW YOUR DATABASE</a>
    </div>


    <script>
    function typeText(element, message, speed, callback) {
        let i = 0;
        element.style.display = "block"; // Make the element visible when typing starts
        const interval = setInterval(() => {
            if (i < message.length) {
                element.textContent += message.charAt(i);
                i++;
            } else {
                clearInterval(interval);
                if (callback) callback(); // Move to the next typing action
            }
        }, speed);
    }

    const text1 = document.querySelector(".text .text1");
    const text2 = document.querySelector(".text .text2");
    const text3 = document.querySelector(".text .text3");
    const text4 = document.querySelector(".text .text4");

    const text1Message = `This introductory treatise serves as a foundational roadmap for newcomers to the dynamic and versatile world of PHP programming, providing an exhaustive overview of the essential principles, 
                    concepts, and best practices requisite for success in PHP web development. By emphasizing the paramount importance of consistent practice, grasping fundamental syntax and semantics, 
                    and leveraging an array of online resources, including tutorials, documentation, and communities of practice, beginners can establish a robust and sustainable foundation in PHP, 
                    facilitating a seamless transition from novice to proficient developer.`;

    const text2Message = `Furthermore, this guide underscores the critical role of version control systems, such as Git, in managing and tracking code modifications, while also highlighting the necessity 
                    of rigorous testing and debugging protocols to ensure the reliability, stability, and security of PHP applications. Additionally, the importance of project-based learning is underscored, 
                    wherein beginners can apply theoretical knowledge in practical, real-world contexts, such as building dynamic web applications, interacting with databases, and integrating third-party libraries and APIs.`;

    const text3Message = `To further augment the learning process, this treatise provides actionable advice on cultivating a supportive community of peers and mentors, staying abreast of emerging trends and best practices, 
                    and leveraging an array of development tools and frameworks to streamline workflow and enhance productivity. By heeding these recommendations and persevering through initial challenges, novice PHP 
                    developers can rapidly acquire the skills, knowledge, and confidence requisite to excel in this dynamic and rapidly evolving field, unlocking a wide range of career opportunities and professional 
                    growth prospects.`;

    const text4Message = `Ultimately, this comprehensive guide aims to empower beginners with the theoretical foundations, practical skills, and emotional resilience necessary to navigate the complexities and nuances of 
                    PHP web development, while also fostering a deeper appreciation for the elegance, flexibility, and expressiveness of the PHP language itself.`;

    // Hide all elements initially
    text1.style.display = "none";
    text2.style.display = "none";
    text3.style.display = "none";
    text4.style.display = "none";

    // Sequentially type text for each class
    typeText(text1, text1Message, 30, () => {
        typeText(text2, text2Message, 30, () => {
            typeText(text3, text3Message, 30, () => {
                typeText(text4, text4Message, 30);
            });
        });
    });
</script>



    
</body>
</html>
