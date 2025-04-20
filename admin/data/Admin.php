<?php 

// Get All USERS
function getByID($conn, $id){
   $sql = "SELECT id, first_name, last_name, username FROM admin WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if($stmt->rowCount() >= 1){
         $data = $stmt->fetch();
         return $data;
   }else {
       return 0;
   }

   
}

function getByID2($conn, $id){
    $sql = "SELECT id, fname, username FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
 
    if($stmt->rowCount() >= 1){
          $data = $stmt->fetch();
          return $data;
    }else {
        return 0;
    }
}