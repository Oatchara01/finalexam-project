<?php
$conn = new mysqli("db", "root", "password", "finalexam");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $pdf = $_POST['pdf_url'];
    $conn->query("INSERT INTO references (title, pdf_url) VALUES ('$title', '$pdf')");
}
$refs = $conn->query("SELECT * FROM references");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage References</title>
</head>
<body>
    <h1>Add Reference</h1>
    <form method="POST">
        <input name="title" placeholder="IEEE Title" required />
        <input name="pdf_url" placeholder="PDF URL" required />
        <button type="submit">Add</button>
    </form>
    <h2>All References</h2>
    <ul>
        <?php while($row = $refs->fetch_assoc()): ?>
            <li><?php echo $row['title']; ?> -
                <a href="<?php echo $row['pdf_url']; ?>" target="_blank">View PDF</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
