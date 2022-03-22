<?php
$courseName = $_POST["courseName"];
$teacherName = $_POST["teacherName"];
$courseGroup = $_POST["courseGroup"];
$courseType = $_POST["courseType"];
$courseDescription = $_POST["courseDescription"];

echo "<h1>Добавен курс: $courseName</h1>";
echo "<h1>Преподавател: $teacherName</h1>";
echo "<h1>Тип на предмета: $courseGroup</h1>";
echo "<h1>Вид на курса: $courseType</h1>";
echo "<h1>Описание: $courseDescription</h1>";
?>
