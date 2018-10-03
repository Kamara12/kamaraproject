<?php
    try{
        require 'data.php';
        $conn = new PDO("mysql:host=$servername; dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $username = $password = $email = '';
        $usrequired = $passrequired = $erequired = '';
        
        if(empty($_POST["username"])){
            $usrequired = "This field is required";
        }else{
            $username = test_input($_POST["username"]);
        }
        
        if(empty($_POST["password"])){
            $passrequired = "This field is required";
        }else{
            $password = test_input($_POST["password"]);
        }
        
        if(empty($_POST["email"])){
            $erequired = "";
        }else{
            $email = test_input($_POST["email"]);
        }
        
        if(isset($_POST['submit'])){            
            if(empty($username) || empty($password)){
                $reply = '<div class="alert alert-danger center" role="alert">FILL ALL THE REQUIRED FIELDS!</div>';
            }else{
                $sql = "INSERT INTO tbl_login (username, password, email) VALUES ('$username', '$password', '$email')";
                $conn->exec($sql);
                $reply = '<div class="alert alert-success" role="alert">ACCOUNT SUCCESSFULLY CREATED!</div>';
            }           
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section class="col-lg-4 right wksp">
            <?php
                if(isset($reply)){
                    echo $reply;
                }
            ?>            
            <div class="center display-4">SignUp Form</div><br/><br/>
            <h5 class="center">Fill The Form Below To Create An Admin Account.</h5><br/>
            <div class="col-lg-9 formspace">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label><b>Username:&nbsp;</b><span class="red">*<?php echo $usrequired;?></span></label>
                    <input value="Username" type="text"  name="username" class="form-control"><br/>
                    <label for="password"><b>Password:&nbsp;&nbsp;</b><span class="red">*<?php echo $passrequired;?></span></label>
                    <input value="Password" type="password" name="password" class="form-control"><br/>
                    <label for="email"><b>Email:&nbsp;&nbsp;</b><span class="red"><?php echo $erequired;?></span></label>
                    <input value="example@hostname.com" type="email" name="email" class="form-control"><br/>
                    <input type="submit" name="submit" value="SignUp" class="btn btn-primary right">
                </form>
            <p>Already have an account? <a href="home.php" class="logout">Login Here.</a></p>
            </div>
        </section>
        <div class="col-lg-8 bkg"></div>
    </body>
</html>