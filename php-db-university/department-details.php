<?php
require_once __DIR__ . '/Department.php';
require_once __DIR__ . '/database.php';

$id = $_GET['id'];
$sql = $connection->prepare('SELECT * FROM departments WHERE id = ?');
$sql->bind_param('d', $id);
$sql->execute();

// prelevare il risultato
$result = $sql->get_result();

if ($result && $result->num_rows > 0) {
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $department = new Department();
        $department->id = $row['id'];
        $department->name = $row['name'];
        $department->email = $row['email'];
        $department->address = $row['address'];
        $department->phone = $row['phone'];
        $department->website = $row['website'];
        $department->head_of_department = $row['head_of_department'];

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
    <h1><?php echo $department->name; ?></h1>
    <div>address: <?php echo $department->address; ?></div>
    <div>phone: <?php echo $department->phone; ?></div>
    <div>email: <?php echo $department->email; ?></div>
    <div>website: <?php echo $department->website; ?></div>
    <div>head of department: <?php echo $department->head_of_department; ?></div>
</body>
</html>