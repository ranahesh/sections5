<?php
   session_start(); 

 
  //$_SESSION['name'] = "hamdy";
  //$_SESSION['id'] = 178125;

  function clean($input){
    
    $input = trim($input); 
    $input = stripslashes($input); 
    $input = strip_tags($input); 
    return $input;


}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Title   =   clean ($_POST['title']);
    $Contant =   clean ( $_POST['contant']);
    $errors=[];

    $tempName  = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $imageType = $_FILES['image']['type'];

       $extensionArray = explode('/', $imageType);
        $extension =  strtolower( end($extensionArray));

        $finalName = uniqid() . time() . '.' . $extension;
        $allowedExtensions = ['png','jpg'];
        if (in_array($extension, $allowedExtensions)) {

    
    $disPath = 'uploads/'.$imageName;
    if (move_uploaded_file($tempName, $disPath)) {
        echo 'File Uploaded Successfully';
    } else {
        echo 'File Uploaded Failed';
    }
    
     }else {
      echo 'File Type Not Allowed';
     }

   // Array ( [image] => Array ( [name] => b3.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php7F71.tmp [error] => 0 [size] => 18004 ) ) success
    
      
  

     //validate name 
     if (empty($Title)) {    
        $errors['title'] = 'Field is Required';
    }elseif(!ctype_alpha(str_replace(' ', '', $Title))){
        $errors['title'] = 'Name must be only title';
    }
      

      //validate email
      if (empty($Contant)) {
        $errors['Contant'] = 'Field is Required';
    }elseif (!filter_var($Contant, FILTER_VALIDATE_EMAIL)){
        $errors['Contant'] = 'Invalid Contant';
    }


       //check errors 
       if (count ($errors) > 0){
           foreach($errors as $key => $value){

               //code 
               echo $key.' : ' .$value.'<br>';
           }
       }else {
           

        $_SESSION['studentData'] = [
               'title' => $Title,
                'content' => $Contant,
           
                 $_SESSION['title'] = 'Rana',
                $_SESSION['contant'] = ' HELLO this is my project',
           ];
            
            $file = fopen('info.txt', 'a') or die('Unable to open file!');
            $text =$Title . "||" . $Contant . "||" ."\n";

            fwrite($file, $text);
            fclose($file);

            echo 'Your Data Saved .';
       }   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>
 <body>
        <div class="container">
        <h2>Register</h2>
        <!-- action.php -->
        <form method="post" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputName">title</label>
                <input type="text" class="form-control" name="title" id="exampleInputName" aria-describedby="" placeholder="Enter title">
            </div>

            <div class="form-group">
                <label for="contant">content</label>
                <input type="contant" class="form-control" name="contant" id="examplcontent" aria-describedby="contantlHelp" placeholder="Enter contant">
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword">image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>



