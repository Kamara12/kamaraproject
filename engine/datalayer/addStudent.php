<?php
    session_start();
    $id = $surname = $firstname = $othername = $gender = $phonenumber = $dob = $email = $campus = $student_pic = $programme = $hallofresidence = $startdate = $enddate ='';

    $idrequired = $snrequired = $fnrequired = $onrequired = $grequired = $pnrequired = $dobrequired = $erequired = $crequired = $prequired = $prrequired = $rrequired = $endrequired = $exdrequired = '';

    try{
        require 'data.php';
        $conn = new PDO("mysql:host=$servername; dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(empty($_POST["id"])){
            $idrequired = "This field is required";
        }else{
            $id = test_input($_POST["id"]);
        }

        if(empty($_POST["surname"])){
            $snrequired = "This field is required";
        }else{
            $surname = test_input($_POST["surname"]);
        }

        if(empty($_POST["firstname"])){
            $fnrequired = "This field is required";
        }else{
            $firstname = test_input($_POST["firstname"]);
        }

        if(empty($_POST["othername"])){
            $onrequired = "";
            $othername = "";
        }else{
            $othername = test_input($_POST["othername"]);
        }

        if(empty($_POST["gender"])){
            $grequired = "This field is required";
        }else{
            $gender = test_input($_POST["gender"]);
        }

        if(empty($_POST["phonenumber"])){
            $pnrequired = "This field is required";
        }else{
            $phonenumber = test_input($_POST["phonenumber"]);
        }

        if(empty($_POST["dob"])){
            $dobrequired = "This field is required";
        }else{
            $dob = test_input($_POST["dob"]);
        }

        if(empty($_POST["email"])){
            $erequired = "This field is required";
        }else{
            $email = test_input($_POST["email"]);
        }

        if(empty($_POST["campus"])){
            $crequired = "";
            $campus = "";
        }else{
            $campus = test_input($_POST["campus"]);
        }

        if(empty($_POST["student_pic"])){
            $prequired = "";
            $student_pic = "";
        }else{
            $student_pic = test_input($_POST["student_pic"]);
        }

        if(empty($_POST["programme"])){
            $prrequired = "This field is required";
        }else{
            $programme = test_input($_POST["programme"]);
        }

        if(empty($_POST["hallofresidence"])){
            $rrequired = "This field is required";
        }else{
            $hallofresidence = test_input($_POST["hallofresidence"]);
        }

        if(empty($_POST["startdate"])){
            $endrequired = "This field is required";
        }else{
            $startdate = test_input($_POST["startdate"]);
        }

        if(empty($_POST["enddate"])){
            $exdrequired = "This field is required";
        }else{
            $enddate = test_input($_POST["enddate"]);
        }
        
        if(isset($_POST['submit'])){
            if($idrequired || $snrequired || $fnrequired || $grequired || $pnrequired || $dobrequired || $erequired || $prrequired || $rrequired || $exdrequired || $endrequired){
                $reply = '<div class="alert alert-danger center" role="alert">FILL ALL THE REQUIRED FIELDS!</div>';
            }else{
                $sql = "INSERT INTO tbl_studentinfo(id, surname, firstname, othername, gender, phonenumber, DOB, email, campus,student_pic, programme, hallofresidence, startdate, enddate) VALUES ('$id', '$surname', '$firstname', '$othername', '$gender', '$phonenumber', '$dob', '$email', '$campus', '$student_pic', '$programme', '$hallofresidence', '$startdate', '$enddate')";
                $conn->exec($sql);
                $reply = '<div class="alert alert-success" role="alert">NEW STUDENT SUCCESSFULLY ADDED!</div>';
            }
        }            
    }catch(PDOException $e){
        echo $sql . "<br/>" . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Student</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>        
        <div class="col-lg-9 right wksp">
            <h3 class="center">Fill The Form To Add Student Data.</h3>
            <?php
                if(isset($reply)){
                    echo $reply;
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="id"><b>ID:&nbsp;</b><span class="red">*<?php echo $idrequired;?></span></label>
                        <input value="<?php echo $id; ?>" type="text" name="id" class="col-lg-3 form-control">
                    </div>
                </div><br/>
                
                <div class="form-row">
                    <div class="col">
                        <label for="surname"><b>Surname:&nbsp;</b><span class="red">*<?php echo $snrequired;?></span></label>
                        <input value="<?php echo $surname;?>" type="text" name="surname" class="form-control">
                    </div>
                    <div class="col">
                        <label for="firstname"><b>Firstname:&nbsp;</b><span class="red">*<?php echo $fnrequired;?></span></label>
                        <input value="<?php echo $firstname; ?>" type="text" name="firstname" class="form-control">
                    </div>
                    <div class="col">
                        <label for="othernames"><b>Othername:&nbsp;</b><span class="red"><?php echo $onrequired;?></span></label>
                        <input value="<?php echo $othername; ?>" type="text" name="othername" class="form-control">
                    </div>
                </div><br/>                
                
                <div class="form-row">
                    <div class="col">
                        <label for="gender"><b>Gender:&nbsp;</b><span class="red">*<?php echo $grequired;?></span></label>
                        <input value="<?php echo $gender; ?>" type="text" name="gender" class="form-control">
                    </div>
                    
                    <div class="col">
                        <label for="phonenumber"><b>Phone Number:&nbsp;</b><span class="red">*<?php echo $pnrequired;?></span></label>
                        <input value="<?php echo $phonenumber; ?>" type="text"  name="phonenumber" class="form-control">
                    </div>
                        
                    <div class="col">
                        <label for="dob"><b>Date of Birth:&nbsp;</b><span class="red">*<?php echo $dobrequired;?></span></label>
                        <input value="<?php echo $dob; ?>" type="date" name="dob" class="form-control">
                    </div>
                </div><br/>
                
                <div class="form-row">
                    <div class="col">
                        <label for="email"><b>Email:&nbsp;</b><span class="red">*<?php echo $erequired;?></span></label>
                        <input value="<?php echo $email; ?>" type="email" name="email" class="form-control">
                    </div>
                    
                    <div class="col">
                        <label for="campus"><b>Campus:&nbsp;</b><span class="red"><?php echo $crequired;?></span></label>
                        <input value="<?php echo $campus; ?>" type="text" name="campus" class="form-control">
                    </div>
                    
                    <div class="col custom-file">
                        <label for="student_pic"><b>Profile student_picture:&nbsp;</b><span class="red"><?php echo $prequired;?></span></label>
                        <input type="file" name="student_pic" class="form-control">
                    </div>
                </div><br/>

                <div class="form-row">
                    <div class="col">
                        <label for="programme"><b>Programme:&nbsp;</b><span class="red">*<?php echo $prrequired;?></span></label>
                        <input value="<?php echo $programme; ?>" type="text" name="programme" class="form-control">
                    </div>

                    <div class="col">
                        <label for="hallofresidence"><b>hallofresidence:&nbsp;</b><span class="red">*<?php echo $rrequired;?></span></label>
                        <input value="<?php echo $hallofresidence; ?>" type="text" name="hallofresidence" class="form-control">
                    </div>

                    <div class="col">
                        <label for="startdate"><b>startdate:&nbsp;</b><span class="red">*<?php echo $endrequired;?></span></label>
                        <input type="date" name="startdate" class="form-control">
                    </div>
                </div><br/>

                <div class="form-row">
                    <div class="col">
                        <label for="enddate"><b>enddate:&nbsp;</b><span class="red">*<?php echo $exdrequired;?></span></label>
                        <input type="date" name="enddate" class="form-control">
                    </div>

                </div><br/>

                <input type="submit" name="submit" value="Add To Database" class="btn btn-primary right">
            </form>        
        </div>
        <?php
            include 'sidebar.php';
        ?>
        
    </body>
</html>