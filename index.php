<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row mt-5">
            <?php
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

            // Function to get count
            function getCount($conn, $tableName) {
                $query = "SELECT COUNT(*) as count FROM $tableName";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['count'];
                } else {
                    return 0;
                }
            }

            // Function to get count subjects
            function getCountSubjectEnrollment($conn, $subjectName) {
                $query = "SELECT COUNT(DISTINCT StudentID) AS NumberOfStudents FROM Students s JOIN Subjects sub ON s.SubjectID = sub.SubjectID WHERE sub.SubjectName = '$subjectName'";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['NumberOfStudents'];
                } else {
                    return 0;
                }
            }
            
              // Function to get count subjects
              function getCountFailed($conn, $subjectName) {
                $query = "SELECT COUNT(DISTINCT g.StudentID) AS NumberOfFails FROM grades g JOIN subjects s ON g.SubjectID=s.SubjectID WHERE s.SubjectName='$subjectName' and g.Grade='E';";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['NumberOfFails'];
                } else {
                    return 0;
                }
            }

            // Get counts
            $studentsCount = getCount($conn, 'Students');
            $teachersCount = getCount($conn, 'Teachers');
            $subjectsCount = getCount($conn, 'Subjects');

            $englishLanguage = getCountSubjectEnrollment($conn, 'English Language');
            $mathematics = getCountSubjectEnrollment($conn, 'Mathematics');
            $art = getCountSubjectEnrollment($conn, 'Art');

            $englishLanguageFails = getCountFailed($conn, 'English Language');
            $mathematicsFails = getCountFailed($conn, 'Mathematics');
            $artFails = getCountFailed($conn, 'Art');


            ?>

            <div class="col-2">
                <a href="" class="btn btn-primary w-100 mb-2">Dashboard</a>
                <a href="" class="btn btn-primary w-100 mb-2">Manage Students</a>
                <a href="" class="btn btn-primary w-100 mb-2">Manage Teachers</a>
            </div>

            <div class="col-10">
                <div class="row">
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Total number of students
                            </div>
                            <div class="card-body">
                                <?php echo $studentsCount; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Total number of teachers
                            </div>
                            <div class="card-body">
                                <?php echo $teachersCount; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Total number of subjects
                            </div>
                            <div class="card-body">
                                <?php echo $subjectsCount; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                English Language enrollment
                            </div>
                            <div class="card-body">
                                <?php echo $englishLanguage; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Mathematics enrollment
                            </div>
                            <div class="card-body">
                                <?php echo $mathematics; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Art enrollment
                            </div>
                            <div class="card-body">
                                <?php echo $art; ?>
                            </div>
                        </div>
                    </div>
                    <!-- --- -->
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                English Language fails
                            </div>
                            <div class="card-body">
                                <?php echo $englishLanguageFails; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Mathematics fails
                            </div>
                            <div class="card-body">
                                <?php echo $mathematicsFails; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header text-center">
                                Art fails
                            </div>
                            <div class="card-body">
                                <?php echo $artFails; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
