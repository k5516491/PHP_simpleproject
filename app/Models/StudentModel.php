<?php

require_once appRoot."\Libraries\Database.php";
class StudentModel extends \CodeIgniter\Controller
{

    private $db ;
    public function __construct()
    {
        $this-> db = new Database;
    }
    public function get_StudentList()
    {
        $this->db->query("Select * from student");
        return $this->db->resultSet();
    }
    public function New_Student($student_name)
    {
        $this->db->query("INSERT into student(student_name) VALUES  ('$student_name')");
        return $this->db->resultSet();
    }
    public function CheckDulpicate($student_name)
    {
        $this->db->query("Select * from student where student_name='$student_name'");
        return $this->db->resultSet();
    }
}