<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        <?php include APPPATH . 'views/css/admin_styles.css'; ?>
    </style>
</head>
<body>
    <div class="dashboard-container" style="max-width: 700px;">
        <h2>Edit User: <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h2>

        <div class="main-content">
            <form action="<?php echo base_url('users/updateUser/' . $user['id']); ?>" method="post" class="regisFrm">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required onkeypress="return onlyAlphabetKey(event)">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required onkeypress="return onlyAlphabetKey(event)">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                     <input type="text" name="phone" maxlength="10" oninput="validatePhoneLength(this)" onkeypress="return onlyNumberKey(event)"  value="<?php echo !empty($user['phone']) ? $user['phone'] : ''; ?>" required>
                    <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
                </div>

                <div class="form-group">
                    <label>Department</label>
                    <select name="department" required>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?php echo $dept['id']; ?>" <?php echo ($dept['id'] == $user['department_id']) ? 'selected' : ''; ?>>
                                <?php echo $dept['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" value="<?php echo $user['designation']; ?>" onkeypress="return onlyAlphabetKey(event)" required>
                </div>

                <div class="form-group">
                    <label>Salary</label>
                    <input type="text" name="salary" onkeypress="return onlyNumberKey(event)" value="<?php echo $user['salary']; ?>" min="0">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="1" <?php echo ($user['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo ($user['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <div class="send-button">
                    <input type="submit" value="Update User">
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/myScript.js'); ?>"></script>
</body>
</html>
