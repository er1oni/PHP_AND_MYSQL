<?php

//  new student
if(isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class = $_POST['class'];
    $parent_id = $_POST['parent_id'];
    
    $sql = "INSERT INTO students (name, age, class, parent_id) VALUES ('$name', '$age', '$class', '$parent_id')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "Student added successfully!";
    } else {
        echo "Error adding student.";
    }
}


// display students
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)) {
    echo $row['name'] . " - " . $row['class'] . "<br>";
}


// assign subject to teacher
if(isset($_POST['assign_subject'])) {
    $teacher_id = $_POST['teacher_id'];
    $subject = $_POST['subject'];
    
    $sql = "INSERT INTO teacher_subjects (teacher_id, subject) VALUES ('$teacher_id', '$subject')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "Subject assigned to teacher!";
    } else {
        echo "Error assigning subject.";
    }
}


// add new class
if(isset($_POST['add_class'])) {
    $class_name = $_POST['class_name'];
    
    $sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "Class added successfully!";
    } else {
        echo "Error adding class.";
    }
}


// mark attendance
if(isset($_POST['mark_attendance'])) {
    $student_id = $_POST['student_id'];
    $status = $_POST['status']; // Present or Absent
    
    $sql = "INSERT INTO attendance (student_id, status) VALUES ('$student_id', '$status')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "Attendance marked!";
    } else {
        echo "Error marking attendance.";
    }
}


// add fee payment record
if(isset($_POST['add_fee_payment'])) {
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    
    $sql = "INSERT INTO fee_payments (student_id, amount) VALUES ('$student_id', '$amount')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "Fee payment recorded!";
    } else {
        echo "Error recording payment.";
    }
}


?>