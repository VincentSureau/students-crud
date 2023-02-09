<?php

require_once "database.php";

function format_birthdate_form($date)
{
    $date = new DateTime($date);
    return $date->format('Y-m-d');
}


$id = $_GET['id'] ?? null;

$email = $_POST['email'] ?? null;
$firstname = $_POST['firstname'] ?? null;
$lastname = $_POST['lastname'] ?? null;
$birthdate = $_POST['birthdate'] ?? null;
$gender = $_POST['gender'] ?? null;


if(!empty($email) && !empty($lastname) && !empty($firstname) && !empty($gender) && !empty($birthdate)) {
    if(!empty($id)) {
        $sql = "UPDATE `students` SET `lastname` = '$lastname', `firstname` = '$firstname', `gender` = '$gender', `birthdate` = '$birthdate', `email` = '$email' WHERE `students`.`id` = $id;";
    } else {
        $sql = "INSERT INTO `students` (`id`, `lastname`, `firstname`, `gender`, `birthdate`, `email`) VALUES (NULL, '$lastname', '$firstname', '$gender', '$birthdate', '$email');";
    }
    $studentStatement = $db->prepare($sql);
    $studentStatement->execute();

    header('Location: index.php');
    exit;
}

if(!empty($id)) {
    $sql = "SELECT * FROM `students` WHERE `students`.`id` = $id;";
    $studentStatement = $db->prepare($sql);
    $studentStatement->execute();
    $student = $studentStatement->fetch();

    $email = $student['email'];
    $firstname = $student['firstname'];
    $lastname = $student['lastname'];
    $birthdate = format_birthdate_form($student['birthdate']);
    $gender = $student['gender'];
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= !empty($id) ? "Modifier" : "Ajouter"?> un élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  <body>
    <main class="container p-5">
        <h1><?= !empty($id) ? "Modifier" : "Ajouter"?> un élève</h1>
        <form method="POST">
            <div class="row">
                <div class="col">
                    <label for="lastname">Nom</label>
                    <input value="<?= $lastname ?>" type="text" class="form-control" placeholder="Nom" name="lastname">
                </div>
                <div class="col">
                    <label for="firstname">Prénom</label>
                    <input value="<?= $firstname ?>" type="text" class="form-control" placeholder="Prénom" name="firstname">
                </div>
            </div>
            <div class="form-group">
                <label for="gender">Genre</label>
                <select value="<?= $gender ?>" class="form-control" id="gender" name="gender">
                    <option value="homme" <?= $gender == "homme" ? 'selected' : '' ?>>Homme</option>
                    <option value="femme" <?= $gender == "femme" ? 'selected' : '' ?>>Femme</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthdate">Date de naissance</label>
                <input value="<?= $birthdate ?>" type="date" class="form-control" id="birthdate" placeholder="Date de naissance" name="birthdate">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?= $email ?>" type="email" class="form-control" id="email" placeholder="Email" name="email">
            </div>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary w-100"><?= !empty($id) ? "Modifier" : "Ajouter"?></button>
            </div>
        </form>
        <a href="index.php" class="btn btn-link mt-3">retour</a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>