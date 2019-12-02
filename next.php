<?php

    session_start();

    require 'db.php';

    if ($_POST['chosen']){

        array_push($_SESSION['chosens'], $_POST['chosen']);

            $_SESSION['key'] += 1;

            /*question*/
            $question = $_SESSION['fetched_records'][$_SESSION['key']]['question_sentence'];

            /*options*/
            $correct = $_SESSION['fetched_records'][$_SESSION['key']]['correct'];
            $w1 = $_SESSION['fetched_records'][$_SESSION['key']]['w1'];
            $w2 = $_SESSION['fetched_records'][$_SESSION['key']]['w2'];
            $w3 = $_SESSION['fetched_records'][$_SESSION['key']]['w3'];

            $options = array($correct, $w1, $w2, $w3);

            shuffle($options);

    }
?>
<!-- When we have more questions -->
<?php if($_SESSION['key'] < 10):?>

<div class="question"><?php echo $question; ?></div>

<div class="option-container">
    <div class="option"><?php echo $options[0];?></div>
    <div class="option"><?php echo $options[1];?></div>
    <div class="option"><?php echo $options[2];?></div>
    <div class="option"><?php echo $options[3];?></div>
</div>

<!-- When there's no more questions -->
<?php else :?>

<h1 class="answer">Answers</h1>

<?php for($i=0; $i<$_SESSION['num']; $i++):?>

<?php 
    if($_SESSION['chosens'][$i] == $_SESSION['fetched_records'][$i]['correct']){
        $token = "correct";
    }else{
        $token = "wrong";
    }
?>

<!-- each answer block-->
<div class="each-answer <?php echo $token;?>">
<!-- Only question sentence is shown as default-->
<p class="ans-q"><span><?php echo $i+1;?>.	&nbsp;</span><?php echo $_SESSION['fetched_records'][$i]['question_sentence'];?></p>

<!-- this comment section (correct sentence, translation, comment and your choice) will show only when the block is clicked-->
<div class="rest hidden">
<?php if($token == "correct"):?>
<hr>
<div class="answer-title">Answers</div>
<p class="correct-sentence"><?php echo str_replace("(&nbsp;&nbsp;&nbsp;)","<span class='correct-blue'>".$_SESSION['fetched_records'][$i]['correct']."</span>",$_SESSION['fetched_records'][$i]['question_sentence']);?></p>
<p class="translation"><?php echo $_SESSION['fetched_records'][$i]['translation'];?></p>
<hr>
<div class="comment-title">Comment</div>
<p class="comment"><?php echo $_SESSION['fetched_records'][$i]['comment'];?></p>
<?php else:?>
<hr>
<div class="answer-title">Answers</div>
<p class="correct-sentence"><?php echo str_replace("(&nbsp;&nbsp;&nbsp;)","<span class='correct-blue'>".$_SESSION['fetched_records'][$i]['correct']."</span>",$_SESSION['fetched_records'][$i]['question_sentence']);?></p>
<p class="translation"><?php echo $_SESSION['fetched_records'][$i]['translation'];?></p>
<hr>
<div class="comment-title">Comment</div>
<p class="comment"><?php echo $_SESSION['fetched_records'][$i]['comment'];?></p>
<hr>
<div class="choice-title">What You Selected</div>
<p class="choice">You chose&nbsp;<span class="wrong-red"><?php echo $_SESSION['chosens'][$i];?></span></p>
<?php endif ;?>
</div>
</div>

<?php endfor ;?>

<div class="btn-container">
<button onclick="window.location.reload()" class="again">Try Again</button>
<button  onclick="window.location.href='index.php'" class="menu">Menu</button>
</div>

<?php endif ;?>