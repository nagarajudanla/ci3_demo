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
        <h2>Edit Department:</h2>

        <div class="main-content">
            <form action="<?php echo base_url('Departments/updateDepartment/' . $department['id']); ?>" method="post" class="regisFrm">
                <div class="form-group">
                    <label>Department Name</label>
                    <input type="text" name="name" value="<?php echo $department['name']; ?>" required onkeypress="return onlyAlphabetKey(event)">
                </div>

                <div class="send-button">
                    <input type="submit" value="Update Department">
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/myScript.js'); ?>"></script>
</body>
</html>
