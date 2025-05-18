<div class="container">
    <h2>Login to Your Account</h2>
	
    <!-- Status message -->
   

    <?php if ($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
    <?php endif; ?>

	
    <!-- Login form -->
    <div class="regisFrm">
        <form action="user_access" method="post">
            <div class="form-group">
                <input type="email" name="email" placeholder="EMAIL" required="">
                <?php echo form_error('email','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="PASSWORD" required="">
                <?php echo form_error('password','<p class="help-block">','</p>'); ?>
            </div>
            <div class="send-button">
                <input type="submit" name="loginSubmit" value="LOGIN">
            </div>
        </form>
        <p>Don't have an account? <a href="<?php echo base_url('users/index'); ?>">Register</a></p>
    </div>
</div>