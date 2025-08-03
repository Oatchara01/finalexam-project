<?php
$conn = new mysqli("db", "root", "password", "finalexam");

// ดักจับการแก้ไข
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $result = $conn->query("SELECT * FROM `references` WHERE id=$id");
    $edit = $result->fetch_assoc();
}

// บันทึกการเพิ่ม / แก้ไข
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $pdf = $_POST['pdf_url'];

    if (isset($_POST['id']) && $_POST['id']) {
        $id = (int) $_POST['id'];
        $conn->query("UPDATE `references` SET title='$title', pdf_url='$pdf' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO `references` (title, pdf_url) VALUES ('$title', '$pdf')");
    }

    header("Location: reference.php");
    exit;
}

// ลบข้อมูล
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM `references` WHERE id=$id");
    header("Location: reference.php");
    exit;
}

// โหลดข้อมูลทั้งหมด
$refs = $conn->query("SELECT * FROM `references` ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage References</title>
</head>
<body>
    <h1><?= $edit ? "Edit Reference" : "Add Reference" ?></h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
        <input name="title" placeholder="IEEE Title" value="<?= $edit['title'] ?? '' ?>" required />
        <input name="pdf_url" placeholder="PDF URL" value="<?= $edit['pdf_url'] ?? '' ?>" required />
        <button type="submit"><?= $edit ? "Update" : "Add" ?></button>
        <?php if ($edit): ?>
            <a href="reference.php">Cancel</a>
        <?php endif; ?>
    </form>

    <h2>All References</h2>
    <ul>
        <?php while($row = $refs->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($row['title']) ?> -
                <a href="<?= htmlspecialchars($row['pdf_url']) ?>" target="_blank">View PDF</a> |
                <a href="?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this reference?')">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>

<p>
    <a href="index.php" style="text-decoration:none;">
        <button type="button">กลับหน้าแรก</button>
    </a>
</p>

</html>

