<?php

/** @var Connection $connection */
$connection = require_once 'pdo.php';
$notes = $connection->getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World</title>
</head>
<body>
<div>
    <form action="create.php" method="post">
        <input type="text" name="title" placeholder="Note title" autocomplete="off"
               value="<?php echo $currentNote['title'] #صدقني انا نفسي مش عارف عملت كده ليه ?>">
        <textarea name="description" cols="30" rows="4"
                  placeholder="Note Description"><?php echo $currentNote['description'] ?></textarea>
        <button>
            <?php if ($currentNote['id']): ?>
                Update
            <?php else: ?>
                New note
            <?php endif ?>
        </button>
    </form>
    <div class="notes">
        <?php foreach ($notes as $note): ?>
            <div class="note">
                <div class="title">
                    <a href="?id=<?php echo $note['id'] ?>">
                        <?php echo $note['title'] ?>
                    </a>
                </div>
                <div class="description">
                    <?php echo $note['description'] ?>
                </div>
                <small><?php echo date('d/m/Y H:i', strtotime($note['create_date'])) ?></small>
                <form action="delete.php" method="post">
                    <button class="close">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
