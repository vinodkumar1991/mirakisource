<?php
$strAction = Yii::$app->controller->action->id;

if ('login' != $strAction) {
    ?>
<!DOCTYPE html>
<html>
<head>
<?php
    echo $this->render('common/header_script');
    ?>
</head>
<body>
<?php
    echo $this->render('common/header');
    echo $this->render('common/side_menu');
    ?>
	<main class="main-container"> 
	
	<?php
    echo $content;
    echo $this->render('common/footer');
    ?></main>
<?php
    echo $this->render('common/footer_script');
    ?>
</body>

</html>
<?php
} else {
    echo $content;
}

?>
