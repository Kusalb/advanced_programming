<?php
$url = 'https://data.askbhunte.com/api/v1/covid/timeline'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed
//print_r($characters);
?>
<html>
<table border="1">
    <tr>
        <th>Date</th>
        <th>Total Cases</th>
        <th>New Cases</th>
        <th>Total Recoveries</th>
        <th>New Recoveries</th>
        <th>Total Deaths</th>
        <th>New Deaths</th>
    </tr>

    <?php foreach ($characters as $character) { ?>
        <tr>
            <td><?php echo $character->date ?></td>
            <td><?php echo $character->totalCases ?></td>
            <td><?php echo $character->newCases ?></td>
            <td><?php echo $character->totalRecoveries ?></td>
            <td><?php echo $character->newRecoveries ?></td>
            <td><?php echo $character->totalDeaths ?></td>
            <td><?php echo $character->newDeaths ?></td>
        </tr>
    <?php } ?>


</table>
</html>
