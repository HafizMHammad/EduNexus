<?php

class Admin_Class
{
    public $db;

    public function __construct()
    {
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $db_name = 'lms'; // database name

        try {
            $connection = new PDO("mysql:host={$host_name}; dbname={$db_name}", $user_name,  $password);
            $this->db = $connection; // connection established
        } catch (PDOException $message) {
            echo $message->getMessage();
        }
    }

    /* CRUD Queries */

    // 1. Insert Assignment
    public function insertAssignment($title, $details, $dueDate, $teacherID)
    {
        $sql = "INSERT INTO Assignment (Title, Details, DueDate, TeacherID) 
                VALUES (:title, :details, :dueDate, :teacherID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':dueDate', $dueDate);
        $stmt->bindParam(':teacherID', $teacherID);
        return $stmt->execute();
    }

    // 2. Select All Assignments
    public function getAllAssignments()
    {
        $sql = "SELECT * FROM Assignment";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Select Single Assignment
    public function getAssignmentById($assignmentID)
    {
        $sql = "SELECT * FROM Assignment WHERE AssignmentID = :assignmentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':assignmentID', $assignmentID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Update Assignment
    public function updateAssignment($assignmentID, $title, $details, $dueDate)
    {
        $sql = "UPDATE Assignment SET Title = :title, Details = :details, DueDate = :dueDate 
                WHERE AssignmentID = :assignmentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':assignmentID', $assignmentID);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':dueDate', $dueDate);
        return $stmt->execute();
    }

    // 5. Delete Assignment
    public function deleteAssignment($assignmentID)
    {
        $sql = "DELETE FROM Assignment WHERE AssignmentID = :assignmentID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':assignmentID', $assignmentID);
        return $stmt->execute();
    }

    // 6. Authentication: Check User Credentials
    public function authenticateUser($email, $password)
    {
        $sql = "SELECT * FROM User WHERE Email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user; // User authenticated
        }
        return false; // Authentication failed
    }

    // 7. Insert Student
    public function insertStudent($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO User (Name, Email, Password, Role) 
                VALUES (:name, :email, :password, 'Student')";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    // 8. Insert Teacher
    public function insertTeacher($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO User (Name, Email, Password, Role) 
                VALUES (:name, :email, :password, 'Teacher')";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    // 9. Get All Students
    public function getAllStudents()
    {
        $sql = "SELECT * FROM User WHERE Role = 'Student'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 10. Get All Teachers
    public function getAllTeachers()
    {
        $sql = "SELECT * FROM User WHERE Role = 'Teacher'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 11. Update Profile
    public function updateProfile($userID, $name, $email)
    {
        $sql = "UPDATE User SET Name = :name, Email = :email WHERE UserID = :userID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':userID', $userID);
        return $stmt->execute();
    }

    // 12. Delete Student
    public function deleteStudent($studentID)
    {
        $sql = "DELETE FROM User WHERE UserID = :studentID AND Role = 'Student'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        return $stmt->execute();
    }

    // 13. Delete Teacher
    public function deleteTeacher($teacherID)
    {
        $sql = "DELETE FROM User WHERE UserID = :teacherID AND Role = 'Teacher'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':teacherID', $teacherID);
        return $stmt->execute();
    }

    // 14. Get User Profile by ID
    public function getUserProfile($userID)
    {
        $sql = "SELECT * FROM User WHERE UserID = :userID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
