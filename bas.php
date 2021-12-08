<?php
    session_start();
function Clean($input){
    return   strip_tags(trim($input));
 }
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name  = clean($_POST['name']); 
    $email = clean($_POST['email']);
    $password =$_POST['password'] ;
    $address  =clean($_POST['address']);
    $linkedIn =clean($_POST['linkedIn']);
    
    $errors = [];
    
    #  Validate Name ... 
     if(empty($name)){
         $errors['name'] = "Field Required";
     }
     if(!is_string($name))
       {
        $errors['name'] = "NameMustBeString";
       }
     # Validate Email 
     if(empty($email)){
         $errors['email'] = "Field Required";
     }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Invalid Email";
     }
     #Validate Password
    if(empty($password)){
        $errors['password'] = "Field Required";
      }
      if(strlen($password) < 6){
          $errors['Password']  = "Password Length must be >= 6 chs ";
      }
  
      # Validate Address ..... 
      if(empty($address)){
        $errors['Address'] = "Field Required";
      }
      if(strlen($address) != 10){
       $errors['Address']  = "address Length must be 10 chs ";
      }
  
      # Validate LinkedIn ..... 
      if(empty($linkedIn)){
         $errors['LinkedIn'] = "Field Required";
      }
      if (!filter_var($linkedIn, FILTER_VALIDATE_URL)) {
        $errors['LinkedIn'] ="Enter Valid Url" ;
      }
     # Validate pic ... 
     if(empty($_FILES['pic']['name'])){
         $errors['pic'] = "Field Required";
     }else{
        $tmpPath    =  $_FILES['pic']['tmp_name'];
        $imageName  =  $_FILES['pic']['name'];
        $exArray   = explode('.',$imageName);
        $extension = end($exArray);
        $FinalName = rand().time().'.'.$extension;
        $allowedExtension = ["png",'jpg'];
           
           if(in_array($extension,$allowedExtension)){
                  $desPath = './upload/'.$FinalName;
                if(move_uploaded_file($tmpPath,$desPath)){
                    echo 'Image Uploaded';
                    }else{
                      echo 'Error In Uploading file';
                    }
                }
        if(!in_array($extension,$allowedExtension)){
            $errors['pic'] = "Invalid Extension";
        }
     }
     if(count($errors) > 0){
        foreach ($errors as $key => $value) {
            # code...
            echo '* '.$key.' : '.$value.'<br>';
        }
    }
    else{
           
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['linkedIn'] = $linkedIn;


        echo "<br>DataUploaded";
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
 
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="exampleInputName">Name</label>
    <input type="text" class="form-control" id="exampleInputName"  name="name" aria-describedby="" placeholder="Enter Name">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail">Email address</label>
    <input type="email"   class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword">New Password</label>
    <input type="password"   class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail">Address</label>
    <input type="text"   class="form-control" id="exampleInputAddress" name="address" aria-describedby="addressHelp" placeholder="Enter address">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail">LinkedInUrl</label>
    <input type="text"   class="form-control" id="exampleInputUrl" name="linkedIn" aria-describedby="urlHelp" placeholder="Enter linkedIn">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword">profilePic</label>
    <input type="file"  id="exampleInputPassword1" name="pic" >
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>
