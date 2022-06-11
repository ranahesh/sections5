<?php 
 session_start(); 

 //echo 'Name : '.$_SESSION['name'].'<br>';
  //echo 'ID : '.$_SESSION['id'].'<br>'


  if(isset($_SESSION['title'])){
       echo '<h3>'.$_SESSION['title'].'</h3>';
     }else{
       echo 'No Message Session Found <br>';
     }

     if(isset($_SESSION['contant'])){
        echo '<p>'.$_SESSION['contant'].'</p>';
      }else{
        echo 'NO contaned is reduried <br>';
      }
 

      if(isset($_SESSION['studentData'])){
  foreach ($_SESSION['studentData'] as $key => $value) {
    //     # code...
        ECHO $key . ' : ' . $value . '<br>';
  }}else{
     echo 'No Student Data Session Found <br>';


     
 }

  
 
 
 
  


 ?>