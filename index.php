<?php

ini_set("display_errors",1);
error_reporting(-1);
require_once 'config.php';
require_once 'funcs.php';

if(isset($_POST['test'])){
    $test = (int)$_POST['test'];
    unset($_POST['test']);
    $result=get_correct_answers($test);
    if(!is_array($result))exit('Ошибка!');
    $test_all_data=get_test_data($test);
    $test_all_data_result=get_test_data_result($test_all_data,$result);
    echo print_result($test_all_data_result);
    //print_arr($test_all_data_result) ;
    die;
}

$tests=get_tests();
//print_arr($tests);
if(isset($_GET['test']))
{
    $test_id=(int)$_GET['test'];
    $test_data=get_test_data($test_id);
    if(is_array($test_data))
    {
       $count_questions=count($test_data);
       $pagination=pagination($count_questions,$test_data);
       
    }
    //print_arr($test_data);
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <title>TESTS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="wrap">
        <?php if($tests):?>
            <h3 align="center">Варианты тестов</h3>
            <?php foreach($tests as $test):?>
                <p align="center"><a href="?test=<?=$test['id']?>"><?=$test['name']?></a></p>
            <?php endforeach;?>   

        <?php else:?>
            <h3>Нет тестов</h3>
        <?php endif; ?>
        <br><hr><br>
        <div class="content">

            <?php if(isset($test_data)):?>
                <?php if(is_array($test_data)):?>
                    <p align="center">Всего вопросов:<?=$count_questions?></p>
                    <?=$pagination?>
                    <span class="none" id="test-id"><?=$test_id?></span>
            <div class="test-data">
                <?php foreach($test_data as $id_question =>$item):?>
                    <div class="question" data-id="<?=$id_question?>" id="question-<?=$id_question?>">
                        <?php foreach($item as $id_answer=>$answer):?>
                            <?php if(!$id_answer):?>
                                <p class="q">
                                    <?=$answer?>
                                </p>
                            <?php else:?>
                                <p class="a">
                                    <input type="radio" id="answer-<?=$id_answer?>" name="question-<?=$id_question?>" value="<?=$id_answer?>">
                                    <label for="answer-<?=$id_answer?>"><?=$answer?></label>
                                </p>
                            <?php endif;?>   
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
                
            
            </div>
            <div class="buttons">
                <button class="center btn" id="btn">Закончить тест</button>
            </div>           
                    <div class="">
                        Решайте(Гойда)
                    </div>
                <?php else:?>
                    Тест в разработке
                <?php endif;?>

            <?php else:?>
                Выберите тест
            <?php endif;?>
        </div>
    </div>
<script src="http://code.jquery.com//jquery-latest.js"></script>
<script src="scripts.js"></script>
</body>
</html> 