<?php
    session_start();

    $_SESSION['key'] = 0;

    require 'db.php';

    if ($_POST['level']) {
        $_SESSION['level'] = $_POST['level'];
        header('Location: question.php');
    }
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=M+PLUS+1p' rel='stylesheet' type='text/css'>
</head>

<body id="index_body">
<h1 class="title">Japanese Grammar Quiz</h1>
<form action="" method="post" class="select_level">
<button type="submit" name="level" value="beginner" class="level" id="beginner">beginner</button>
<button type="submit" name="level" value="easy" class="level" id="easy">easy</button>
<button type="submit" name="level" value="middle" class="level" id="middle">middle</button>
<button type="submit" name="level" value="difficult" class="level" id="difficult">difficult</button>
<button type="submit" name="level" value="expert" class="level" id="expert">expert</button>
</form>
</body>

</html>

