<?php
require_once 'vendor/autoload.php';

echo "Running...";

// Database connection
$host = 'localhost';
$db   = 'schoolmanagementsystem';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize Faker
$faker = Faker\Factory::create();

// Insert data into Teachers
for ($i = 0; $i < 10; $i++) {
    $firstName = $conn->real_escape_string($faker->firstName);
    $lastName = $conn->real_escape_string($faker->lastName);
    $hireDate = $conn->real_escape_string($faker->date);

    $sql = "INSERT INTO Teachers (FirstName, LastName, HireDate) VALUES ('$firstName', '$lastName', '$hireDate')";
    $conn->query($sql);
}

// Insert data into Subjects
for ($i = 0; $i < 20; $i++) {
    $subjectName = $faker->randomElement([
        'Mathematics', 'General Science', 'Social Studies', 'Islamic Studies', 
        'Writing', 'Art', 'Music', 'Physical Education', 
        'Health Education', 'Basic Computing', 'Environmental Studies', 'Library', 
        'Bahasa Malaysia', 'English Language', 'Creative Arts', 'Moral Education', 
        'Numeracy', 'Geography', 'History', 'Life Skills'
    ]);
    $room = $faker->numberBetween(100, 999);
    $teacherId = $faker->numberBetween(1, 10); // assuming you have 10 teachers

    $sql = "INSERT INTO Subjects (SubjectName, Room, TeacherID) VALUES ('$subjectName', '$room', $teacherId)";
    $conn->query($sql);
}

// Insert data into Students
for ($i = 0; $i < 100; $i++) {
    
    $firstName = $conn->real_escape_string($faker->firstName);
    $lastName = $conn->real_escape_string($faker->lastName);
    $dob = $conn->real_escape_string($faker->date);
    $gender = $conn->real_escape_string($faker->randomElement(['Male', 'Female']));
    $subjectId = $faker->numberBetween(1, 20); // assuming you have 20 subjects

    $sql = "INSERT INTO Students (FirstName, LastName, DateOfBirth, Gender, SubjectID) VALUES ('$firstName', '$lastName', '$dob', '$gender', $subjectId)";
    $conn->query($sql);
}

// Insert data into Grades
for ($i = 0; $i < 200; $i++) {
    $studentId = $faker->numberBetween(1, 100); // assuming you have 100 students
    $subjectId = $faker->numberBetween(1, 20); // assuming you have 20 subjects
    $grade = $faker->randomElement(['A', 'B', 'C', 'D', 'E']);

    $sql = "INSERT INTO Grades (StudentID, SubjectID, Grade) VALUES ($studentId, $subjectId, '$grade')";
    $conn->query($sql);
}

echo "\nCompleted!";

$conn->close();
?>