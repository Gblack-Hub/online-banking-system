<?php
    include('mycon.php');
    // $data = json_decode(file_get_contents('php://input'), true);
    // $resp = array();

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $pnumber = $_POST['pnumber'];
    $gender = $_POST['gender'];

    $filePath = "uploads/".$_FILES['pix']['name'];
    $fileType = $_FILES['pix']['type'];
    $fileSize = $_FILES['pix']['size'];
    $temp = $_FILES['pix']['tmp_name'];
    // $passport = $_POST['passport'];

    if($con){
        if($fileSize <= 500000){
            // if($fileType == "jpg" || "png" || "jpeg"){
            //     echo "Sorry, only JPG, JPEG and PNG passport photographs are allowed";
            // } else {
                $query = mysqli_query($con, "INSERT INTO user_tb
                                (firstname,lastname,email,password,date_of_birth,phone_number,gender,passport)
                                VALUES ('$fname','$lname','$email','$password','$dob','$pnumber','$gender','$filePath')");
                if($query && move_uploaded_file($temp, $filePath)){
                    header("Location: index.php");
                } else {
                    echo "Error uploading files, please contact our customer care";
                    echo mysqli_error($con);
                }
            // }
        } else {
            echo "Sorry, your passport is too large";
        }
    } else {
        die("connection failed:".mysqli_error($con));
    }
    // echo json_encode($resp);
?>