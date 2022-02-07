<?php
require_once __DIR__ . '/Department.php';
require_once __DIR__ . '/database.php';

// preparazione query
$sql = 'SELECT * FROM departments';
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $department = new Department();
        $department->id = $row['id'];
        $department->name = $row['name'];
        
        $departments[] = $department;
    }
}
else if($result && $result->num_rows == 0) {
    echo 'la quey è andata a buon fine ma non ci sono risultati';
}
else {
    echo 'Query error';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Dipartimenti</h1>

    <?php foreach($departments as $department) { ?>
        <div>
            <a href="department-details.php?id=<?php echo $department->id; ?>"><?php echo $department->name; ?></a>
        </div>
    <?php } ?>
    
</body>
</html>