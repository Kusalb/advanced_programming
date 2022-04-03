<?php
require_once "../config.php";
if (isset($_POST["search_keyword"]) && isset($_POST["search_field"])) {
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "first_name") {
        $sql = "SELECT * FROM persons WHERE first_name LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "last_name") {
        $sql = "SELECT * FROM persons WHERE last_name LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "email") {
        $sql = "SELECT * FROM persons WHERE email LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    }
}
?>

<html>
<head><title>Search</title></head>
<a href="create.php">Create</a>
<form action="search.php" method="post">
    <input type="text" name="search_keyword" required>
    <select name="search_field" required>
        <option value="first_name" selected>First Name</option>
        <option value="last_name">Last Name</option>
        <option value="email">Email</option>
    </select>
    <input type="submit" value="Search">
    <a href="retrieve_to.php"><button>Clear</button></a>
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
    <?php
    if (isset($result)) {
        if (mysqli_num_rows($result) == 0) {
            echo "<tr>";
            echo "<td colspan='7'>No data found!!!</td>";
            echo "</tr>";
        }
    }
    ?>
    <?php if (isset($result)) { ?>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><img src="upload/<?php echo $row['image'] ?>" height="2%" width="5%"></td>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><a href="update_details.php?id=<?php echo $row["id"] ?>">Edit</a></td>
                <td><a href="delete_details.php? id=<?php echo $row["id"] ?>">Delete</a></td>
            </tr>
        <?php } ?>
    <?php } ?>

</table>
</html>
