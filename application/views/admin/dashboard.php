<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        <?php include APPPATH . 'views/css/admin_styles.css'; ?>

        .action-btns a {
            padding: 6px 10px;
            margin-right: 5px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 13px;
            color: white;
        }

        .edit-btn { background-color: #28a745; }
        .delete-btn { background-color: #dc3545; }
        .toggle-btn { background-color: #17a2b8; }

        .action-btns a:hover {
            opacity: 0.85;
        }

        .add-department-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .add-department-btn:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $this->session->userdata('first_name'); ?> (Admin)</h2>

        <div class="dashboard-layout">
            <!-- Sidebar -->
            <div class="sidebar">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#users">Users</a></li>
                    <li><a href="#departments">Departments</a></li>
                    <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Button to add a new department -->
                <a href="#addDepartmentForm" class="add-department-btn">Add New Department</a>

                <!-- Add Department Form (hidden initially) -->
                <div id="addDepartmentForm" style="display: none; margin-top: 20px;">
                    <h3>Add New Department</h3>
                    <form action="<?php echo base_url('departments/save'); ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Department Name</label>
                            <input type="text" name="name" id="name" class="form-control" required onkeypress="return onlyAlphabetKey(event)">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="send-button">Add Department</button>
                        </div>
                    </form>
                </div>

                <!-- Users Table -->
                <h3 id="users">All Users</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Salary</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['department_name']; ?></td>
                                <td><?php echo $user['designation']; ?></td>
                                <!-- <td><?php echo $user['salary']. " Rs"; ?></td> -->
                                 <td><?php 
                                        if(isset($user['salary'])){
                                            echo $user['salary']. " Rs";
                                        }else{
                                            echo "0". " Rs";
                                        }
                                    ?>
                                </td>
                                <td><?php echo ($user['employee_type'] == 1) ? 'Admin' : 'Employee'; ?></td>
                                <td><?php echo ($user['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                <td class="action-btns">
                                    <a href="<?php echo base_url('users/editUser/' . $user['id']); ?>" class="edit-btn">Edit</a>
                                    <a href="<?php echo base_url('users/delete_user/' . $user['id']); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                    <a href="<?php echo base_url('users/toggleUserStatus/' . $user['id']); ?>" class="toggle-btn">
                                        <?php echo ($user['status'] == 1) ? 'Deactivate' : 'Activate'; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Departments Table -->
                <h3 id="departments" style="margin-top: 40px;">Departments</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departments as $dept): ?>
                            <tr>
                                <td><?php echo $dept['id']; ?></td>
                                <td><?php echo $dept['name']; ?></td>
                                <td><?php echo ($dept['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                 <td><?php echo date('d-m-Y', strtotime($dept['modified'])); ?></td>
                                <td class="action-btns">
                                    <a href="<?php echo base_url('departments/editDepartment/' . $dept['id']); ?>" class="edit-btn">Edit</a>
                                    <!-- <a href="<?php echo base_url('departments/delete/' . $dept['id']); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                                    <a href="<?php echo base_url('departments/toggleStatus/' . $dept['id']); ?>" class="toggle-btn">
                                        <?php echo ($dept['status'] == 1) ? 'Deactivate' : 'Activate'; ?>
                                    </a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const addDeptBtn = document.querySelector(".add-department-btn");
        const addForm = document.getElementById("addDepartmentForm");

        addDeptBtn.addEventListener("click", function (e) {
            e.preventDefault();
            if (addForm.style.display === "none" || addForm.style.display === "") {
                addForm.style.display = "block";
                addDeptBtn.textContent = "Hide Form";
            } else {
                addForm.style.display = "none";
                addDeptBtn.textContent = "Add New Department";
            }
        });
    });
</script>

<script src="<?php echo base_url('assets/js/myScript.js'); ?>"></script>

</body>
</html>
