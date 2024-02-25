<?php echo form_open('users/login'); ?>

<h5>Email Address</h5>
<input class="<?php echo error_class('email') ?>" type="text" name="email" value="<?php echo set_value('email') ?>" size="50" />
<?php echo form_error('email'); ?>

<h5>Password</h5>
<input class="<?php echo error_class('password') ?>" type="text" name="password" value="<?php echo set_value('password') ?>" size="50" />
<?php echo form_error('password'); ?>

<div><input type="submit" value="Submit" /></div>

</form>
