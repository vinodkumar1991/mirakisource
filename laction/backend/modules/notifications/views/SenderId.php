<?php
print_r($fields);
?>
<!DOCTYPE html>
<form method='post' action=''>
	Message Type : <select name='message_type' id='message_type'>
		<option value=''>--Select Message Type--</option>
		<?php
if (! empty($message_types)) {
    foreach ($message_types as $key => $value) {
        if (isset($fields['message_type']) && ($fields['message_type'] == $key)) {
            ?>
            <option value='<?php echo $key; ?>' selected><?php echo $value;?></option>
           <?php
        } else {
            ?>  <option value='<?php echo $key; ?>'><?php echo $value;?></option>
		  <?php
        }
    }
}
unset($message_types);
?>
	</select> <br /> <span><?php echo isset($errors['message_type']) ? $errors['message_type'][0] : NULL;?></span>
	<br /> Category Type : <select name='category_type' id='category_type'>
		<option value=''>--Select Category Type--</option>
				<?php
    if (! empty($category_types)) {
        foreach ($category_types as $key => $value) {
            if (isset($fields['category_type']) && ($fields['category_type'] == $key)) {
                ?>
                <option value='<?php echo $key; ?>' selected><?php echo $value;?></option>
                <?php
            } else {
                ?>
		  <option value='<?php echo $key; ?>'><?php echo $value;?></option>
		  <?php
            }
        }
    }
    unset($category_types);
    ?>
	</select> <br /> <span><?php echo isset($errors['category_type']) ? $errors['category_type'][0] : NULL;?></span><br />
	Subject : <input type='text' name='subject' id='subject'
		value='<?php echo isset($fields['subject']) ? $fields['subject'] : NULL;?>' />
	<br /> <span><?php echo isset($errors['subject']) ? $errors['subject'][0] : NULL;?></span><br />
	<input type='hidden' name='status' id='status' value='active' /><br />
	<input type='submit' name='create_sender_id' id='create_sender_id'
		value='Create' />
</form>