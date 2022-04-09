<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group"  >
            <label for="exampleInputname1">name</label>
            <input type="text" name ='name' class="form-control" id="exampleInputname1" placeholder="enter Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text"  name ='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group"  >
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name ='password' class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
        <input type="radio" name="gender" value="Male">Male 
        <input type="radio" name="gender" value="Female"> Female
        </div>
        <div class="form-group">
            <label for="exampleInputAddress1">Address</label>
            <input type="text" name ='address' class="form-control" id="exampleInputAddress1" placeholder="enter Address">
        </div>
        <div class="form-group">
        Select CV to upload:
        <input type="file" name="cv" id="fileToUpload">
        </div>
        <div class="form-group"  >
            <label for="exampleInputLinkedin1">Linkedin URL</label>
            <input type="text" name ='linkedin' class="form-control" id="exampleInputLinkedin1" placeholder="enter linkedinURL">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    
    $name=$_POST['name'];   
    $email=$_POST['email'];
    $password=$_POST['password'];
    $address=$_POST['address'];
    $linkedin=$_POST['linkedin'];
    $gender=$_POST['gender'];

    function cleanName($name){
        return trim(strip_tags(stripslashes($name)));
    }
    function cleanEmail($email){
        return trim(strip_tags(stripslashes($email)));
    }
    function cleanPassword($password){
        return trim(strip_tags(stripslashes($password)));
    }
    function cleanAddress($address){
        return trim(strip_tags(stripslashes($address)));
    }
    function cleanLinkedin($linkedin){
        return trim(strip_tags(stripslashes($linkedin)));
    }
    $clearedEmail = cleanEmail($email);
    $clearedName = cleanName($name);
    $clearedPassword = cleanPassword($password);
    $clearedAddress = cleanAddress($address);
    $clearedLinkedin = cleanLinkedin($linkedin);

    $errors=[];
    if(empty($clearedName)){
        $errors['Name']= "Required";
    }
    else if (is_numeric($clearedName))
    {
         $errors['Name']= "Name Cannot Be Numbers Only Must Be String";
    }
    if(empty($clearedEmail)){
        $errors['Email']= "Required";
    }
    else if (!filter_var($clearedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors['Email']= "Invalid Email missing @";
    }
    if(empty($clearedPassword)){
        $errors['Password']= "Required";
    }
    else if (strlen($clearedPassword) < 6)
    {
        $errors['Password'] = "Password is too short, minimum is 6 characters.";
    }
    if(empty($clearedAddress)){
        $errors['Address']= "Required";
    }
    
    
    else if (strlen($clearedAddress) < 10)
    {
        $errors['Address'] = "Address is too short, minimum is 10 characters.";
    }
    if(empty($gender)){
        $errors['gender']= "Required";
    }
    if(empty($clearedLinkedin)){
        $errors['Linkedin']= "Required";
    }
    else if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$clearedLinkedin)) {
        $errors['Linkedin']= "Invalid URL";
    }    
      
    if (!empty($_FILES['cv']['name'])) {
    
        $cvName    = $_FILES['cv']['name'];
        $cvTemPath = $_FILES['cv']['tmp_name'];
        $cvSize    = $_FILES['cv']['size'];
        $cvType    = $_FILES['cv']['type'];
    
        $typesInfo  =  explode('/', $cvType);    
        $extension  =  strtolower(end($typesInfo));      
        $allowedType = ['pdf'];  
    
        if (in_array($extension, $allowedType)) {
    
            # Create Final Name ... 
            $FinalName = time() . rand() . '.' . $extension;
    
            $disPath = 'Cvuploads/' . $FinalName;
    
            if (move_uploaded_file($cvTemPath, $disPath)) {
    
                echo 'CV Uploaded <br>';
            } else {
                echo 'Error Try Again';
            }
        }else{
            echo 'InValid Extension';
        }
    } else {
        $errors['CV']= "Required";
    }
    if(count($errors) > 0 ){
        foreach ($errors as $error => $value) {
            
            echo '*'.$error.':'.$value.'<br>';
        }
    }else{
        echo 'Thx For Sharing Data';
    }
    ?>
</body>
</head>
</html>