<div class="container">
    <h2>Create a New Account</h2>
	<?php isset($validation_errors) ?? '';  ?> 
    <!-- Status message -->
    
    <!-- Flash status messages -->
    <?php if ($this->session->flashdata('success_msg')): ?>         
        <div class="status-msg success">
            <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
    <?php endif; ?>
	
    <!-- Registration form -->
    <div class="regisFrm">
        <form action="<?php echo base_url('users/register'); ?>" method="post">
            <div class="form-group">
                <input type="text" name="first_name" placeholder="FIRST NAME" value="<?php echo !empty($user['first_name'])?$user['first_name']:''; ?>" required>
                <?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" placeholder="LAST NAME" value="<?php echo !empty($user['last_name'])?$user['last_name']:''; ?>" required>
                <?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="EMAIL" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" required>
                <?php echo form_error('email','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="PASSWORD" required>
                <?php echo form_error('password','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="conf_password" placeholder="CONFIRM PASSWORD" required>
                <?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="PHONE NUMBER" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>">
                <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <select name="department" required>
                    <option value="">-- SELECT DEPARTMENT --</option>
                    <?php foreach($departments as $dept):?>
                    <option value="<?php echo $dept['id']; ?>"><?php echo $dept['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo form_error('department','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
                <input type="text" name="designation" placeholder="DESIGNATION" value="<?php echo !empty($user['designation']) ? $user['designation'] : ''; ?>" required>
                <?php echo form_error('designation', '<p class="help-block">', '</p>'); ?>
            </div>


            <div class="send-button">
                <input type="submit" name="signupSubmit" value="CREATE ACCOUNT">
            </div>
        </form>
        <p>Already have an account? <a href="<?php echo base_url('users/login'); ?>">Login here</a></p>
    </div>
</div>