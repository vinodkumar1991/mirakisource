<form method='post' action=''>

<?php
if (Yii::$app->session->hasFlash('user_success')) {
    echo Yii::$app->session->getFlash('user_sucess');
}
?>
	<!-- Roles :: START -->
	Role : <select id='role_id' name='role_id'>
		<option value=''>--Select Role--</option>
		<?php
if (! empty($roles)) {
    foreach ($roles as $key => $value) {
        if (isset($fields['role_id']) && ($fields['role_id'] == $key)) {
            ?>
        <option value='<?php echo $key.'-'.$value;?>' selected><?php echo $value;?></option>
        <?php
        } else {
            ?>
            <option value='<?php echo $key.'-'.$value;?>'><?php echo $value;?></option>
            <?php
        }
    }
    unset($roles);
}
?>
	</select> <span><?php echo isset($errors['role_id'][0]) ? $errors['role_id'][0] : NULL; ?></span>
	<br />

	<!-- Roles :: END -->
	<!-- Fullname :: START -->
	Fullname : <input type='text' name='fullname' id='fullname'
		value='<?php echo isset($fields['fullname']) ? $fields['fullname'] : NULL; ?>'
		maxlength='100' autocomplete='off' /> <span><?php echo isset($errors['fullname'][0]) ? $errors['fullname'][0] : NULL; ?></span>
	<br />
	<!-- Fullname :: END -->
	<!-- Email :: START -->
	Email : <input type='text' name='email' id='email'
		value='<?php echo isset($fields['email']) ? $fields['email'] : NULL; ?>'
		maxlength='40' autocomplete='off' /> <span><?php echo isset($errors['email'][0]) ? $errors['email'][0] : NULL; ?></span>
	<br />
	<!-- Email :: END -->
	<!-- Phone :: START -->
	Phone : <input type='text' name='phone' id='phone'
		value='<?php echo isset($fields['phone']) ? $fields['phone'] : NULL; ?>'
		maxlength='10' autocomplete='off' /> <span><?php echo isset($errors['phone'][0]) ? $errors['phone'][0] : NULL; ?></span>
	<br />
	<!-- Phone :: END -->
	<!-- Status :: START -->
	<input type='hidden' name='status' id='status' value='active' />
	<!-- Status :: END -->
	<!-- Button :: START -->
	<input type='submit' name='create_user' id='create_user' value='Create' />
	&emsp; <input type='reset' name='clear_user_fields'
		id='clear_user_fields' value='Clear' />
	<!-- Button :: END -->
</form>