<?php
require_once "../config.php";
$sql = "SELECT * FROM persons";
$result=mysqli_query($conn,$sql)
?>
<?php //include "../header.php"?>
<html>
<head><title>Retrieve</title></head>
<body>
<a href="create.php">Create</a>
<form action="search.php" method="post">
    <input type="text" name="search_keyword" required>
    <select name="search_field" required>
        <option value="first_name" selected>First Name</option>
        <option value="last_name">Last Name</option>
        <option value="email">Email</option>
    </select>
    <input type="submit" value="Search">
</form>
<table border="1">
<tr>
    <th>id</th>
    <th>Image</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
    <?php foreach ($result as $row){ ?>
     <tr>
     <td><?php echo$row['id']?></td>
     <td><img src="upload/<?php echo $row['image']?>" height= "2%" width="5%"></td>
     <td><?php echo $row['first_name']?></td>
     <td><?php echo $row['last_name']?></td>
     <td><?php echo $row['email']?></td>
     <td><a href="update_details.php?id=<?php echo $row["id"]?>">Edit</a></td>
     <td><a href="delete_details.php? id=<?php echo $row["id"]?>">Delete</a> </td>
   </tr>

     <?php } ?>
 </table>
</body>
</html>
<?php //include "../footer.php"?>
