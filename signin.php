    <!DOCTYPE html>
    <html>
        <head>
            <script>
                function myFunction() {
                    var x = document.getElementById("mySelect").options[0].text;
                    document.getElementById("demo").innerHTML = x;
                }
            </script>
        </head>
        <style>
            input[type=text], input[type=password] ,select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 3px solid yellow;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 100%;
                background-color: pink;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            #psw {
                text-align: right;
            }
            .cancelbtn {
                width: auto;
                padding: 10px 18px;
                background-color: pink;
            }
            .container {
                padding: 16px;
            }

            input[type=submit]:hover {
                background-color:pink;
            }

        </style>
        <body>
            <?php
            include 'dbconnect.php';
            session_start();
            if (!empty($_POST)) {
                $email = $_REQUEST['email'];

                $password = $_REQUEST['password'];
                $sql = "SELECT id FROM users WHERE email = '$email' and password = '$password'";
                
      $result = mysqli_query($conn,$sql);
      //var_dump($result);die;
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
        
      if($count == 1) {
         //session_register("email");
         $_SESSION['email'] = $email;
         echo "Successful";
         
        // header("location: home.php");
      }else {
         echo "Your Login Name or Password is invalid";
      }
}
                ?>
            </h3>
            <form method="post" action="home.php" >
                <div class="container">
                    <label><b>Email</b></label>
                    <input type="text" placeholder="Enter Your Email" name="email" required>

                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Your Password..." name="password" required>

                    <input type="submit" value="Login">
                    <input type="checkbox" checked="checked"> Remember me
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <p id="psw">Need an account?   <a href="signup.php">Sign In</a>  here</p>
                </div>
            </form>

        </body>
    </html>
