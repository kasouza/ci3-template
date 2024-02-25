<?php echo form_open('users/register'); ?>

<h5>Username</h5>
<input class="<?php echo error_class('name') ?>" type="text" name="name" value="<?php echo set_value('name') ?>" size="50" />
<?php echo form_error('name'); ?>

<h5>Password</h5>
<input class="<?php echo error_class('password') ?>" type="text" name="password" value="<?php echo set_value('password') ?>" size="50" />
<?php echo form_error('password'); ?>

<h5>Password Confirm</h5>
<input class="<?php echo error_class('passconf') ?>" type="text" name="passconf" value="<?php echo set_value('passconf') ?>" size="50" />
<?php echo form_error('passconf'); ?>

<h5>Email Address</h5>
<input class="<?php echo error_class('email') ?>" type="text" name="email" value="<?php echo set_value('email') ?>" size="50" />
<?php echo form_error('email'); ?>

<div><input type="submit" value="Submit" /></div>

</form>
