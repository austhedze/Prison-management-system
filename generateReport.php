<?php
include 'connection.php';

// Query to fetch total number of inmates
$totalInmatesQuery = "SELECT COUNT(*) AS total_inmates FROM inmate";
$result = mysqli_query($conn, $totalInmatesQuery);
$totalInmates = mysqli_fetch_assoc($result)['total_inmates'];

// Query to fetch most common gender
$genderQuery = "SELECT gender, COUNT(*) as count FROM inmate GROUP BY gender ORDER BY count DESC LIMIT 1";
$genderResult = mysqli_query($conn, $genderQuery);
$mostGender = mysqli_fetch_assoc($genderResult)['gender'];

// Query to fetch most common offense
$offenseQuery = "SELECT offense, COUNT(*) as count FROM inmate GROUP BY offense ORDER BY count DESC LIMIT 1";
$offenseResult = mysqli_query($conn, $offenseQuery);
$mostOffense = mysqli_fetch_assoc($offenseResult)['offense'];

// Query to fetch most common sentence length
$sentenceQuery = "SELECT sentence_length, COUNT(*) as count FROM inmate GROUP BY sentence_length ORDER BY count DESC LIMIT 1";
$sentenceResult = mysqli_query($conn, $sentenceQuery);
$mostSentence = mysqli_fetch_assoc($sentenceResult)['sentence_length'];

// Return the data as JSON
echo json_encode([
    'totalInmates' => $totalInmates,
    'mostGender' => $mostGender,
    'mostOffense' => $mostOffense,
    'mostSentence' => $mostSentence
]);
?>
