<?php
   require_once 'connec.php';
   $pdo = new \PDO(DSN, USER, PASS);
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
    <form action="index.php" method="POST">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="text" name="lastname" placeholder="lastname">
        <input type="submit">
    </form>

    <?php
    if(isset($_POST['firstname']) && isset($_POST['lastname'])){
        $firstname = trim($_POST['firstname']); 
        $lastname = trim($_POST['lastname']);
        
        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);
        
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        
        $statement->execute();
        
        $friends = $statement->fetchAll();

        header('Location: index.php');
    }
        ?>
        
    <?php 
        $query = "SELECT * FROM friend";
        $statement = $pdo->query($query);
        $friends = $statement->fetchAll();

        echo '<ul>';
            foreach($friends as $friend) {
            echo '<li>'.$friend['firstname'] . ' ' . $friend['lastname'].'</li>';
            }
        echo '</ul>';
        ?>
</body>
</html>
