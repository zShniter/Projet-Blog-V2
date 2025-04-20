<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username']) ) {

    if(isset($_POST['fname']) && 
       
       isset($_POST['username'])){

      include "../db_conn.php";
      $fname = $_POST['fname'];
      
      $username = $_POST['username'];
      $id = $_SESSION['user_id'];

      if(empty($fname)){
         $em = "Full name is required"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }else if(empty($username)){
         $em = "Username is required"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }
    
      $sql = "UPDATE users SET fname=?, username=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$fname,$username, $id]);
    
      
     if ($res) {
        $_SESSION['username'] = $username;
          $sm = "Successfully edited!"; 
          header("Location: ../profile.php?success=$sm");
          exit;
      }else {
        $em = "Unknown error occurred"; 
        header("Location: ../profile.php?error=$em");
        exit;
      }


    }else {
        header("Location: ../profile.php");
        exit;
    }


}else {
    header("Location: ../login.php");
    exit;
} 