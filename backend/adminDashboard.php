<?php
    require '../model/model_clients.php';
    session_start();


    if(isset($_POST['deleteCustomer'])){
        $id = filter_input(INPUT_POST, 'Customer_ID');
        deleteCustomer($id);
    }

    $customers = getCustomers();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Island+Moments&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
  <style>
    html 
    {
      height: 100%;
    }
    body 
    {
      margin:0;
      padding:0;
      font-family: sans-serif;
    }
    h2
    {
      color:black;
    }
    h1
    {
      color:black;
    }
    label
    {
      color:black;
    }
    .wrapper 
    {
      display: flex;
      align-items: center;
    }

    .label 
    {
      margin-right: 10px;
    }
    /*Css so that input text and submit have the same margin-bottom padding */
    input[type="text"],
    input[type="submit"] 
    {
      margin-bottom: 20px;
    }
    /*Separate css for text boxes to increase height and width */
    input[type="text"] {
        padding: 3px 5px; 
        font-size: 1.25rem; 
        width: 100%; 
        margin-bottom: 20px; 
        border: 2px solid #ccc; 
        border-radius: 5px; 
    }
    /*Separate css for submit for buttons like search and delete */
    input[type="submit"] {
        padding: 10px 10px ; 
        font-size: 1.00rem; 
        background-color: #007bff; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
    }
    .links-container a {
        display: inline-block; 
        padding: 8px 12px; 
        margin-right: 10px; 
        background-color: #007bff; 
        color: white; 
        text-decoration: none; 
        border-radius: 5px; 
    }


     .island-moments {
      font-family: 'Island Moments', sans-serif;
    }
    .italiana{
      font-family: 'Italiana', sans-serif;
    }
    .jacques{
      font-family: 'Jacques Francois', serif;
    }
    .larger-text{
      font-size:2.5rem;
    }
    .dm-serif{
        font-family: 'DM Serif Display', serif; 
    }
    
    
  </style>
</head>
<body style="background-color: #F5EAEB;">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <header class="absolute top-0 w-full bg-red-600 text-white text-center py-4 text-lg font-semibold jacques"style="background-color:#C1373C ;">
            <div class="flex justify-between items-center w-full px-4">
                <div class="text-lg font-semibold text-center flex-1">Admin Dashboard</div>
                <a href="../adminLogin.php" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">Logout</a>
            </div>
        </header>
    <div class="flex min-h-screen items-center justify-center">
    <div class="flex-1 flex justify-center">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" href="#"></a>
    </li>
    </ul>
    </div>

    <div class="col-sm-offset-2 col-sm-10">
     
                
        
     <h1>Search</h1>
           
     <div class="links-container" style="margin-bottom: 20px;">
        <a href="adminDashboard.php" class="btn btn-info" style="margin-right: 10px;">View Customers</a>
        
        <a href="addCustomer.php" class="btn" style="background-color: #D05B5F; color: white;"> + Add Appointment</a>
     </div>
     <?php
 

    if (isset($_POST['search'])) {
        $FirstName = filter_input(INPUT_POST, 'FirstName');
        $LastName = filter_input(INPUT_POST, 'LastName');
    }else{
        $FirstName = '';
        $LastName = '';
    }


        $customers = searchCustomer($FirstName, $LastName);
     
    ?>



<form method="POST">
        <div class="wrapper">
            <div class="label">
                <label>First Name:</label>
            </div>
            <div>
                <input type="text" name="FirstName" value="<?= $FirstName; ?>" />
            </div>
            <div class="label">
                <label>Last Name:</label>
            </div>
            <div>
                <input type="text" name="LastName" value="<?=  $LastName; ?>" />
            </div>

            <div>
                &nbsp;
            </div>
            <div>
                <input type="submit" name="search" value="Search" />
            </div>
           
        </div>
    </form>
 

    <h2> Customers</h2>

    <table class="table table-striped" >
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Appt Time</th>
                <th>Status</th>
                <th>Phone Number</th>
                <th>Job Desc</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?php echo $c['Customer_ID']; ?></td>
                    <td><?php echo $c['FirstName']; ?></td>
                    <td><?php echo $c['LastName']; ?></td>
                    <td><?php echo $c['ApptTime']; ?></td>
                    <td><?php echo $c['Stat']; ?></td>
                    <td><?php echo $c['PhoneNum']; ?></td>
                    <td><?php echo $c['JobDesc']; ?></td>
                    <td>
                        <a href="editCustomers.php?id=<?php echo $c['Customer_ID']; ?>" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                    <!-- FORM FOR DELETE FUNCTIONALITY -->
                    <form action='adminDashboard.php' method='post'>
                        <input type="hidden" name="Customer_ID" value="<?= $c['Customer_ID'];?>"/>
                        <input class="" type="submit" name="deleteCustomer" value="Delete" />
                        
                    </form>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>