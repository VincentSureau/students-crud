<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=students_crud;charset=utf8', 'admin', 'adminpwd');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$sql = "SELECT * FROM `students`;";
$studentsStatement = $db->prepare($sql);
$studentsStatement->execute();
$students = $studentsStatement->fetchAll();

function format_birthdate($date)
{
    $date = new DateTime($date);
    return $date->format('d/m/Y');
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  <body>
    <main class="container p-5">
        <h1>Ma liste d'élèves</h1>
        <div class="d-flex justify-content-end">
            <a href="" class="btn btn-primary"><i class="fa-regular fa-plus"></i> Ajouter un élève</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Genre</th>
                    <th>Date de naissance</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student): ?>
                <tr>
                    <td><?= $student['id'] ?></td>
                    <td><?= ucwords($student['lastname']) ?></td>
                    <td><?= ucwords($student['firstname']) ?></td>
                    <td><?= ucwords($student['gender']) ?></td>
                    <td><?= format_birthdate($student['birthdate']) ?></td>
                    <td><?= $student['email'] ?></td>
                    <td>
                        <a href="" class="btn btn-sm btn-primary"><i class="fa-regular fa-pen-to-square"></i> Modifier</a>
                        <a href="" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>