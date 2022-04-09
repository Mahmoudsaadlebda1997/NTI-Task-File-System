<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

    <form method="post" action="lab4Assign.php">
        <div class="form-group"  >
            <label for="exampleInputPassword1">Title</label>
            <input type="text" name ='title' class="form-control" id="exampleInputPassword1" placeholder="enter Post">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Content</label>
            <textarea name="content" rows="4" cols="50" placeholder="enter Content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    
    $title=$_POST['title'];
    
    $content=$_POST['content'];

    $errors=[];
    if(empty($title)){
        $errors['Title']= "Required";
    }
    else if (strlen($title) <= 10)
    {
       $errors['Title'] = "Title is too short, minimum is 10 characters.";
    }
    if(empty($content)){
        $errors['Content']= "Required";
    }
    else if (strlen($content) <= 10 || strlen($content) >= 50 )
    {
       $errors['Content'] = "content is too short, minimum is 10 characters or more than 50 char.";
    }
          
    if(count($errors) > 0 ){
        foreach ($errors as $error => $value) {

            echo '*'.$error.':'.$value.'<br>';
        }
    }else{
        echo 'Thx For Sharing Data';
        setcookie('title',$title,time()+(60*60),'/');
        setcookie('content',$content,time()+(60*60),'/');
    }

    ?>
</body>
</head>
</html>