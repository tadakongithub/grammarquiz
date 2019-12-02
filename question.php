<?php 

session_start();

$level = $_SESSION['level'];

require 'db.php';

$stmt = $db->query("SELECT * FROM " . $level);

$fetched_records = array();

while ($record = $stmt->fetch()) {
    array_push($fetched_records, $record);
}

shuffle($fetched_records);

/* how many questions there are*/
$_SESSION['num'] = count($fetched_records);

$_SESSION['fetched_records'] = $fetched_records;

$_SESSION['chosens'] = array();

$_SESSION['key'] = 0;

/*question*/
$question = $_SESSION['fetched_records'][$_SESSION['key']]['question_sentence'];

/*options*/
$correct = $_SESSION['fetched_records'][$_SESSION['key']]['correct'];
$w1 = $_SESSION['fetched_records'][$_SESSION['key']]['w1'];
$w2 = $_SESSION['fetched_records'][$_SESSION['key']]['w2'];
$w3 = $_SESSION['fetched_records'][$_SESSION['key']]['w3'];

$options = array($correct, $w1, $w2, $w3);

shuffle($options);

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=M+PLUS+1p' rel='stylesheet' type='text/css'>
</head>

<body id="question_body">

    <div class="content">

        <div class="question"><?php echo $question; ?></div>

        <div class="option-container">
            <div class="option"><?php echo $options[0];?></div>
            <div class="option"><?php echo $options[1];?></div>
            <div class="option"><?php echo $options[2];?></div>
            <div class="option"><?php echo $options[3];?></div>
        </div>
        

    </div>

    <script>
        $(document).ready(function(){
            $(".content").on('click', '.option', function(){
                    var chosen = $(this).text();
                    $.ajax({
                        url:'next.php',
                        type:'POST',
                        data:{
                            'chosen':chosen
                        },
                        success: function(data){
                            $(".content").empty();
                            $(".content").append(data);
                        }
                    });
                    
            });
        });

        $(document).ready(function(){
            $(".content").on('click', '.each-answer', function(){
                $(this).find(".rest").toggleClass("hidden");
            });
        });
    </script>

</body>

</html>


