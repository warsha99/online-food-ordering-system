
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="../images/i.png" />
    <link rel="stylesheet" href="../test1.css">
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>FIFTY SHADES OF CUSSINE</title>
</head>
<body>
   
        <header>
            <a href=""><img src="../images/logo.png"></a>
            
        </header>
        <section id="section1">
            <div class="container1">
                <h1 style="font-size: 30px; color:aquamarine;">Admin login</h1>
                <h1>FIFTY SHADES OF CUSSINE</h1>
                <p>“There is no love sincerer than the love of food.”</p>
                <a href="#" class="button" id="button"> LOGIN</a>
            </div>
            <div class="popup"style="height: 100%;">
                <div class="close" style="top: -60px;right: -470px;"><img src="../images/close.png" alt="close" class="close"></div>
                <div class="popup-content"style="height: 350px;top=-100px">

                    
                    


                    <form action="" method="POST" styel="top: 100px;" >
                   
  
                    <br>
                    <br>
                    <br>

                    <input type="text" class="input-field" placeholder="USERNAME" name="username" required>
                    <br>
                    <input type="password" class="input-field" placeholder="ENTER PASSWORD" name="password" required>
                    
                        
                    <br>
                    <br>
                    <br>
                    
                    <button type="submit" name="submit" class="submit-btn1">LOGIN</button>
                    </form>
                    
                </div>


            </div>
            <script>document.getElementById("button").addEventListener("click", function () {
                    document.querySelector(".popup").style.display = "flex";
                })
                document.querySelector(".close").addEventListener("click", function () {
                    document.querySelector(".popup").style.display = "none";

                })

            </script>
        
        </section>
        
        
            <div class="footer">
                <div class="wrapper">
                    <p class="text-center"style="text-align:center">&copy; 2021 All rights reserved  -FIFTY SHADES OF CUSSINE-</p>

                </div>
            </div>
        


</body>
</html>
<?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //get the data from the login form
        $username=$_POST['username'];
        $password=$_POST['password'];

        //$_SESSION['user']=$username; // to check whether the user is logged in or not and logout will unset it 
        if($username=='admin' && $password=='admin'){
            
            header('location:index.php');

        }
        else
        {
            echo "<script>alert('Incorrect username or password.')</script>";
            $username="";
            $password="";
            
        }
    }

?>
