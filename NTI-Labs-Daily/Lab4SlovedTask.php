<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group"  >
            <label for="exampleInputname1">Title</label>
            <input type="text" name ='title' class="form-control" id="exampleInputname1" placeholder="enter Title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Content</label>
            <textarea name="content" rows="4" cols="50" placeholder="enter Content"></textarea>
        </div>
        <div class="form-group">
        Select Image to upload:
        <input type="file" name="image" id="fileToUpload">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    
    $title=$_POST['title'];   
    $content=$_POST['content'];
    function clean($input){
        return trim(strip_tags(stripslashes($input)));
    }

    $clearedTitle = clean($title);
    $clearedContent = clean($content);

    $errors=[];
    if(empty($clearedTitle)){
        $errors['Title']= "Required";
    }
    else if (is_numeric($clearedTitle))
    {
         $errors['Title']= "Title Cannot Be Numbers Only Must Be String";
    }
    if(empty($clearedContent)){
        $errors['Content']= "Required";
    }
    else if (strlen($clearedContent) < 50)
    {
        $errors['Content'] = "Content is too short, minimum is 50 characters.";
    }
      
    if (!empty($_FILES['image']['name'])) {
    
        $imageName    = $_FILES['image']['name'];
        $imageTemPath = $_FILES['image']['tmp_name'];
        $imageSize    = $_FILES['image']['size'];
        $imageType    = $_FILES['image']['type'];
    
        $typesInfo  =  explode('/', $imageType);    
        $extension  =  strtolower(end($typesInfo));      
        $allowedType = ['png','jpg','jpeg'];  
    
        if (in_array($extension, $allowedType)) {
    
            # Create Final Name ... 
            $FinalName = time() . rand() . '.' . $extension;
    
            $disPath = 'Image Uploads/' . $FinalName;
    
            if (move_uploaded_file($imageTemPath, $disPath)) {
    
                echo 'Image Uploaded <br>';
            } else {
                echo 'Error Try Again';
            }
        }else{
            echo 'InValid Extension';
        }
    } else {
        $errors['Image']= "Required";
    }
    if(count($errors) > 0 ){
        foreach ($errors as $error => $value) {
            
            echo '*'.$error.':'.$value.'<br>';
        }
    }else{
        echo 'Thx For Sharing Data <br>';
        // Store input  Into File Text 
        $file =   fopen('data.txt','a')  or die("can't open file");
        $dataFromForm = "<br> Form Data : Title =" .$title." and Content = ".$content."And Image = ".$imageName."\n"; 
        fwrite($file,$dataFromForm);    
        fclose($file);
        //Display ALl blogs
        echo file_get_contents( "data.txt" );


        // To Delete All File Txt
        if(!file_put_contents("data.txt", "")){
            echo "All Blogs got Deleted";
        }else{
            echo "Failed to delete Blogs";
        }

    }
    ?>

</body>
</head>
</html>