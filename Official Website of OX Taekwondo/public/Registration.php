<?php
    include "../PHP/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OX Taekwondo Martial Arts</title>
    <link rel="stylesheet" href="../css/regform.css">
    
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="../Photo/OX_LOGOO.png" alt="OX Taekwondo Martial Arts">
            </div>
            <h1>OX TAEKWONDO MARTIAL ARTS</h1>
        </header>
        
        <form action="../PHP/connect.php" method="POST" >
            <fieldset>
                <legend>Personal Information</legend>
                
                <label for="dateEnrolled">Date Enrolled:</label>
                <input type="date" id="dateEnrolled" name = "dateEnrolled" required>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="middleInitial">Middle Initial:</label>
                <input type="text" id="middleInitial" name="middleInitial">

                <label for="suffix">Other Name(Suffix):</label>
                <select id="suffix" name="suffix">
                    <option value="">Select</option>
                    <option value="Jr">Jr</option>
                    <option value="Sr">Sr</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="None">None</option>
                </select>

                <label for="houseNo">House No.:</label>
                <input type="text" id="houseNo" name="houseNo">

                <label for="street">Street:</label>
                <input type="text" id="street" name="street">

                <label for="barangay">Barangay:</label>
                <input type="text" id="barangay" name="barangay">

                <label for="province">Province:</label>
                <input type="text" id="province" name="province">

                <label for="city">City:</label>
                <input type="text" id="city" name="city">

                <label for="cellNo">Mobile No.:</label>
                <input type="text" id="cellNo" name="cellNo" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="birthDate">Birth Date:</label>
                <input type="date" id="birthDate" name="birthDate">

                <label for="religion">Religion:</label>
                <input type="text" id="religion" name="religion">

                <label for="sex">Sex:</label>
                <select id="sex" name="sex" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="">Select</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                </select>

                <label for="schoolName">School Name:</label>
                <input type="text" id="schoolName" name="schoolName" required>

                <label for="academicLevel">Academic Level:</label>
                <select id="academicLevel" name="academicLevel">
                    <option value="">Select</option>
                    <option value="Elementary">Elementary</option>
                    <option value="High School">High School / Senior High School </option>
                    <option value="College">College</option>
                </select>

            </fieldset>

            <div class="buttons">
                <button type="button" onclick="history.back()">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
    <sript src = "../script/script.js"> </sript>
</body>
</html>

