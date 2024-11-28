<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<form action="page1.php" method="post">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">name</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
 <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">prenom</label>
    <input type="text" class="form-control" name="prenom" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="passwrod" id="exampleInputPassword1">
  </div>
  
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">password check</label>
    <input type="password" class="form-control" name="confirmPassword" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>