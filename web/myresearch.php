<?php
$conn = new mysqli("db", "root", "password", "finalexam");
$result = $conn->query("SELECT * FROM references");
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Research</title>
</head>
<body>
    <h1>My Research</h1>
    <p>This is my research summary.</p>
    <h2>References (IEEE)</h2>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <?php echo $row['title']; ?> -
                <a href="<?php echo $row['pdf_url']; ?>" target="_blank">PDF</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
