<?php
require_once '../middleware/auth.php';
require_once '../models/User.php';

class AdminController
{
    public function listUsers()
    {
        $users = User::getAll();
        // Display the list of users in the view
        // For example: include 'views/user_list.php';
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Ensure that an admin cannot be created from the application
            if ($role === 'admin') {
                // Redirect to an error page or display an error message
                // For example: header('Location: /error_page.php');
                echo "Error: Admin role cannot be created.";
                return;
            }

            // Validate input data
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password) && !empty($role)) {
                User::create($email, $password, $role);
                // Redirect to the list of users
                header('Location: /admin/listUsers');
            } else {
                // Display validation error message
                echo "Error: Invalid input data.";
            }
        } else {
            // Display the user creation form in the view
            // For example: include 'views/create_user_form.php';
        }
    }

    public function editUser($id)
    {
        $user = User::getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Validate input data
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password) && !empty($role)) {
                User::update($id, $email, $password, $role);
                // Redirect to the list of users
                header('Location: /admin/listUsers');
            } else {
                // Display validation error message
                echo "Error: Invalid input data.";
            }
        } else {
            // Display the user editing form in the view
            // For example: include 'views/edit_user_form.php';
        }
    }

    public function deleteUser($id)
    {
        User::delete($id);
        // Redirect to the list of users
        header('Location: /admin/listUsers');
    }
}
