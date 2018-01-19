<form method='post' action=''>
	<!-- Message Type :: START -->
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
	<br />
	<!-- Message Type :: END -->
	<!-- From Email :: START -->
	<input type='text' name='from_email' id='from_email'
		value='<?php echo isset($fields['from_email']) ? $fields['from_email'] : NULL;?>' />
	<!-- From Email :: END -->
	<!-- Subject :: START -->
	<select id='senderid_id' name='senderid_id'>
		<option value=''>--Select Subject--</option>
		<?php
if (! empty($subjects)) {
    foreach ($subjects as $key => $value) {
        ?>
        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
		        <?php
    }
}
?>
	</select>
	<!-- Subject :: END -->
<!-- 	message type from email senderid code name template description status -->

</form>