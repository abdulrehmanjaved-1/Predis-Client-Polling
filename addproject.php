<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="alert alert-danger">
            <h3>Add Project Form</h3>
        </div>
        <form method="post" action="check.php">
            <div class="form-group">
                <label for="">Project Title</label>
                <input type="text" class="form-control" name="txtProjectTitle" id="">
            </div>
            <div class="form-group">
                <label for="">Project Client Name</label>
                <input type="text" class="form-control" name="txtClientName" id="">
            </div>
            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="txtDate" class="form-control" id="">
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" name="txtPrice" class="form-control" id="">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="txtDescription" class="form-control" id="">
            </div>
            <div class="form-group">
                <label for="">No of Employee</label>
                <input type="text" name="txtEmployee" class="form-control" id="">
            </div>
            <div class="form-group">
                <input type="submit" name="btnSubmit" class="btn btn-info" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
</body>
</html>

<?php 
   //require("../../config.php");
   require("config.php");
   if(!empty($_POST['btnSubmit']))
   {
        $project_title  =   $_POST["txtProjectTitle"];   
        $client_name    =   $_POST["txtClientName"];   
        $date           =   $_POST["txtDate"];   
        $price          =   $_POST["txtPrice"];   
        $description    =   $_POST["txtDescription"];   
        $employee       =   $_POST["txtEmployee"];   
        $q = mysqli_query($conn, "INSERT into project(project_title, client_name	, project_date, price, description, empname) VALUES('$project_title', '$client_name', '$date', '$price', '$description', '$employee')");
        if($q)
        {
            echo "<script>alert('Project added'); window.location = 'manage_project.php';</script>";
        }
   }
?>