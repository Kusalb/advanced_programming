<?php
require_once "../config.php";
$sql = "SELECT * FROM persons";
$result=mysqli_query($conn,$sql)
?>
<?php include "header.php";?>
<table class="table table-success table-striped">
<tr>
    <th>id</th>
    <th>Image</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Action</th>
<!--    <th>Delete</th>-->
</tr>
    <?php foreach ($result as $row){ ?>
     <tr>
     <td><?php echo$row['id']?></td>
     <td><img src="upload/<?php echo $row['image']?>" height= "2%" width="5%"></td>
     <td><?php echo $row['first_name']?></td>
     <td><?php echo $row['last_name']?></td>
     <td><?php echo $row['email']?></td>
<!--     <td><a href="update_details.php?id=--><?php //echo $row["id"]?><!--">Edit</a></td>-->
<!--     <td><a href="delete_details.php? id=--><?php //echo $row["id"]?><!--">Delete</a> </td>-->
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="update_details.php?id=<?php echo $row["id"]?>">Edit</a></li>
                <li><a class="dropdown-item" href="delete_details.php? id=<?php echo $row["id"]?>">Delete</a></li>
            </ul>
        </div>
    </td>
     </tr>
     <?php } ?>
 </table>
<?php include "footer.php"?>

