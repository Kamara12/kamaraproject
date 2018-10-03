<?php
    if(isset($_SESSION['username'])){
        $id = $surname = $firstname = $othernames = $gender = $phonenumber = $DOB = $email = $campus = $student_pic = $programme = $hallofresidence = $startdate = $enddate ='';

        $idrequired = $snrequired = $fnrequired = $onrequired = $grequired = $pnrequired = $DOBrequired = $erequired = $crequired = $prequired = $prrequired = $rrequired = $endrequired = $exdrequired ='';

        try{
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
                $firstnamee = test_input($_POST["firstname"]);
            }

            if(empty($_POST["othernames"])){
                $onrequired = "";
                $othername = "";
            }else{
                $othername = test_input($_POST["othernames"]);
            }

            if(empty($_POST["gender"])){
                $grequired = "This field is required";
                $gender == "Male/Female";
            }else{
                $gender = test_input($_POST["gender"]);
            }

            if(empty($_POST["phonenumber"])){
                $pnrequired = "This field is required";
            }else{
                $phonenumber = test_input($_POST["phonenumber"]);
            }

            if(empty($_POST["DOB"])){
                $DOBrequired = "This field is required";
            }else{
                $DOB = test_input($_POST["DOB"]);
            }

            if(empty($_POST["email"])){
                $erequired = "This field is required";
            }else{
                $email = test_input($_POST["email"]);
            }

            if(empty($_POST["campus"])){
                $crequired = "";
                $campus = "Main/City";
            }else{
                $campus = test_input($_POST["campus"]);
            }

            if(empty($_POST["student_pic"])){
                $prequired = "";
                $student_pic = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwrOhKZY0SY9O9Mg2bffwJB4C6I9ECfT5w1oDxThLDcUDmgUJ7jw";
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

            $search_id = '';
            $search_id = escape($_GET['id']);

            $sql = "SELECT * FROM tbl_studentinfo WHERE id=:search_id";
            
            $statement = $conn->prepare($sql);
            $statement->bindParam(':search_id', $search_id, PDO::PARAM_STR);
            $statement->execute();

            $results = $statement->fetchAll();
            

            if(isset($_POST['submit'])){
                if($idrequired || $snrequired || $fnrequired || $grequired || $pnrequired || $DOBrequired || $erequired || $prrequired || $rrequired || $endrequired || $exdrequired){
                    $reply = '<div class="alert alert-danger center" role="alert">FILL ALL THE REQUIRED FIELDS!</div>';
                }else{
                    $sql = "INSERT INTO tbl_studentinfo(id, surname, firstname, othernames, gender, phonenumber, DOB, email, campus, student_pic, programme, hallofresidence, startdate, enddate, height, weight) VALUES ('$id', '$surname', '$firstname', '$othernames', '$gender', '$phonenumber', '$DOB', '$email', '$campus', '$student_pic', '$programme', '$hallofresidence', '$startdate', '$enddate', '$height', '$weight')";
                    $conn->exec($sql);
                    echo '<div class="alert alert-success" role="alert">Editing Successful!</div>';
                }
            }            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }else{
        header('location: home.php');
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
        <div class="col-lg-10 right">
            <?php foreach($results as $result){ if($results && $statement->rowCount()>0){ ?>
            <h3 class="center">Edit Student Data.</h3>
            <?php
                if(isset($reply)){
                    echo $reply;
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="id"><b>ID:&nbsp;</b><span class="red">*<?php echo $idrequired;?></span></label>
                        <input value="<?php echo escape($result["id"]); ?>" type="text" name="id" class="col-lg-3 form-control">
                    </div>
                </div><br/>
                
                <div class="form-row">
                    <div class="col">
                        <label for="surname"><b>surname:&nbsp;</b><span class="red">*<?php echo $snrequired;?></span></label>
                        <input value="<?php echo escape($result["surname"]); ?>" type="text" name="surname" class="form-control">
                    </div>
                    <div class="col">
                        <label for="firstname"><b>firstname:&nbsp;</b><span class="red">*<?php echo $fnrequired;?></span></label>
                        <input value="<?php echo escape($result["firstname"]); ?>" type="text" name="firstname" class="form-control">
                    </div>
                    <div class="col">
                        <label for="othernames"><b>Othernames:&nbsp;</b><span class="red"><?php echo $onrequired;?></span></label>
                        <input value="<?php echo escape($result["othernames"]); ?>" type="text" name="othernames" class="form-control">
                    </div>
                </div><br/>                
                
                <div class="form-row">
                    <div class="col">
                        <label for="gender"><b>Gender:&nbsp;</b><span class="red">*<?php echo $grequired;?></span></label>
                        <input value="<?php echo escape($result["gender"]); ?>" type="text" name="gender" class="form-control">
                    </div>
                    
                    <div class="col">
                        <label for="phonenumber"><b>Phone Number:&nbsp;</b><span class="red">*<?php echo $pnrequired;?></span></label>
                        <input value="<?php echo escape($result["phonenumber"]); ?>" type="text"  name="phonenumber" class="form-control">
                    </div>
                        
                    <div class="col">
                        <label for="DOB"><b>Date of Birth:&nbsp;</b><span class="red">*<?php echo $DOBrequired;?></span></label>
                        <input value="<?php echo escape($result["DOB"]); ?>" type="text" name="DOB" class="form-control">
                    </div>
                </div><br/>
                
                <div class="form-row">
                    <div class="col">
                        <label for="email"><b>Email:&nbsp;</b><span class="red">*<?php echo $erequired;?></span></label>
                        <input value="<?php echo escape($result["email"]); ?>" type="email" name="email" class="form-control">
                    </div>
                    
                    <div class="col">
                        <label for="campus"><b>Campus:&nbsp;</b><span class="red"><?php echo $crequired;?></span></label>
                        <input value="<?php echo escape($result["campus"]); ?>" type="text" name="campus" class="form-control">
                    </div>
                    
                    <div class="col custom-file">
                        <label for="student_pic"><b>Profile student_picture:&nbsp;</b><span class="red"><?php echo $prequired;?></span></label>
                        <input type="file" name="student_pic" class="form-control">
                    </div>
                </div><br/>

                <div class="form-row">
                    <div class="col">
                        <label for="programme"><b>programme:&nbsp;</b><span class="red">*<?php echo $prrequired;?></span></label>
                        <input value="<?php echo escape($result["programme"]); ?>" type="text" name="programme" class="form-control">
                    </div>

                    <div class="col">
                        <label for="hallofresidence"><b>hallofresidence:&nbsp;</b><span class="red">*<?php echo $rrequired;?></span></label>
                        <input value="<?php echo escape($result["hallofresidence"]); ?>" type="text" name="hallofresidence" class="form-control">
                    </div>

                    <div class="col">
                        <label for="startdate"><b>Date of Entry:&nbsp;</b><span class="red">*<?php echo $endrequired;?></span></label>
                        <input value="<?php echo escape($result["startdate"]); ?>" type="text" name="startdate" class="form-control">
                    </div>
                </div><br/>

                <div class="form-row">
                    <div class="col">
                        <label for="enddate"><b>Date of Exit:&nbsp;</b><span class="red">*<?php echo $exdrequired;?></span></label>
                        <input value="<?php echo escape($result["enddate"]); ?>" type="text" name="enddate" class="form-control">
                    </div>

                </div><br/>

                <input type="submit" name="submit" value="Update Database" class="btn btn-primary right">
            </form>
            <?php } } ?>
        </div>
    </body>
</html>