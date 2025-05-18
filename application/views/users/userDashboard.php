<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        <?php include APPPATH . 'views/css/admin_styles.css'; ?>
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $this->session->userdata('first_name'); ?></h2>

        <div class="dashboard-layout">
            <!-- Sidebar -->
            <div class="sidebar">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#profile">My Profile</a></li>
                    <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <h3 id="profile">My Profile</h3>
                <table>
                    <tr><th>Field</th><th>Value</th></tr>
                    <tr><td>Name</td><td><?php echo ($this->session->userdata('first_name')." ". $this->session->userdata('last_name')); ?></td></tr>
                    <tr><td>Email</td><td><?php echo $this->session->userdata('email'); ?></td></tr>
                    <tr><td>User Type</td><td><?php echo ($this->session->userdata('employee_type') == 1) ? 'Admin' : 'Employee'; ?></td></tr>
                    <tr><td>Salary</td><td><?php echo $this->session->userdata('salary'); ?></td></tr>
                    <tr><td>Phone</td><td><?php echo $this->session->userdata('phone'); ?></td></tr>

                    
                </table>
            </div>
        </div>
    </div>
</body>
</html>
