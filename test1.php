<?php 
include 'config.php';
error_reporting(0);
session_start();
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="images/i.png" />
    <link rel="stylesheet" href="test1.css">
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>FIFTY SHADES OF CUSSINE</title>
</head>
<body>
   
        <header>
            <a href=""><img src="images/logo.png"></a>
            <ul>
                <li><a href="#section1">Home</a></li>
                <li><a href="#section2">About</a></li>
                <li><a href="#section3">Contact</a></li>

            </ul>
        </header>
        <section id="section1">
            <div class="container1">
                <h1>FIFTY SHADES OF CUSSINE</h1>
                <p>“There is no love sincerer than the love of food.”</p>
                <a href="#" class="button" id="button"> LOGIN</a>
            </div>

            <div class="popup">
                <div class="close"><img src="images/close.png" alt="close" class="close"></div>
                <div class="popup-content">

                    <div class="button-box">

                        <div id="btn1"></div>
                        <button type="button" class="toggle-btn" onclick="login()">Login</button>
                        <button type="button" class="toggle-btn" onclick="register()">Register</button>

                    </div>
                    <div class="social-icons1">
                        <img src="images/facebook.png">
                        <img src="images/tweeter.png">
                        <img src="images/whatsapp.png">

                    </div>


                    <form action="log.php" method="POST" id="login" class="input-group">

                    <input type="email" class="input-field" placeholder="EMAIL" name="email" value="<?php echo $email; ?>"required>
                    <input type="password" class="input-field" placeholder="ENTER PASSWORD" name="password" value="<?php echo $_POST['password']; ?>" required>
                    
                        
                    <input type="checkbox" class="check-box"><span>Remember Password</span>
                    <button type="submit" name="submit" class="submit-btn1">LOGIN</button>
                    </form>
                    <form action="register.php" method="POST" id="register" class="input-group">

                    <input type="text" class="input-field" placeholder="USER NAME" name="username" value="<?php echo $username; ?>" required>
                    <input type="email" class="input-field" placeholder="E-MAIL" name="email" value="<?php echo $email; ?>" required>
                    <input type="password" class="input-field" placeholder="ENTER PASSWORD" name="password" value="<?php echo $_POST['password']; ?>" required>
                    <input type="password" class="input-field" placeholder="CONFIRM PASSWORD" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
                    <label for="user" >REGISTER AS:</label>
                        <select name="usertype" id="user"value="<?php echo $usertype; ?>"  required>
                            <option value="">Select...</option>
                            <option value="Customer">Customer</option>
                            <option value="Restuarent owner">Restuarent owner</option>
                        </select>
                    <input type="checkbox" class="check-box" required><span>I agree to the terms & conditions</span>
                    <button type="submit" name="submit" class="submit-btn1">REGISTER</button>
                    </form>
                </div>


            </div>


            <script>
                var x = document.getElementById("login");
                var y = document.getElementById("register");
                var z = document.getElementById("btn1");

                function register() {
                    x.style.left = "-400px";
                    y.style.left = "50px";
                    z.style.left = "110px";
                }

                function login() {
                    x.style.left = "50px";
                    y.style.left = "450px";
                    z.style.left = "0px";
                }
                function togglePopup() {
                    document.getElementById("popup-1").classList.toggle("active");
                }

                document.getElementById("button").addEventListener("click", function () {
                    document.querySelector(".popup").style.display = "flex";
                })
                document.querySelector(".close").addEventListener("click", function () {
                    document.querySelector(".popup").style.display = "none";

                })

            </script>
        </section>

        <section id="section2">

            <div class="wrapper">
                <div class="card">
                    <img src="images/1.png">
                    <div class="info">
                        <h1>Are you a restaurant owner?</h1>
                        <p></p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                
                    <div class="card">
                        <img src="images/2.png">
                        <div class="info">
                            <h1>Our special offers..</h1>
                            <p></p>
                            <a href="#" class="btn">Read More</a>
                        </div>
                    </div>



                    <div class="card">
                        <img src="images/3.png">
                        <div class="info">
                            <h1>Are you a foodie?</h1>
                            <p>
                               
                            </p>
                            <a href="#" class="btn">Read More</a>
                        </div>
                    </div>
                

            </div>
        </section>
        <section id="section3">

            <div class="container">
                <?php include 'contact.html';
                ?>
            </div>
                
        </section>
</body>
</html>