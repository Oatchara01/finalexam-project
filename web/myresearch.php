<?php
$conn = new mysqli("db", "root", "password", "finalexam");
$result = $conn->query("SELECT * FROM `references`");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Research</title>
</head>
<body>
    <h1>แนวทางวิจัยของนักศึกษา</h1>
    <p>
        โครงการวิจัยนี้มุ่งเน้นการพัฒนาระบบสารสนเทศเพื่อจัดเก็บและแสดงผลข้อมูลเอกสารอ้างอิงงานวิจัยในรูปแบบ IEEE 
        โดยมีวัตถุประสงค์ในการสร้างความสะดวกสบายให้กับนักศึกษาในการจัดเก็บและเข้าถึงข้อมูลเอกสารอ้างอิง 
        พร้อมทั้งฝึกทักษะการพัฒนาเว็บแอปพลิเคชันด้วย PHP และฐานข้อมูล MySQL บน Docker
    </p>
    
    <p>
        แนวคิดหลักของโครงการคือการนำเทคโนโลยีมาใช้ในการบริหารจัดการเอกสารอ้างอิงให้มีประสิทธิภาพ 
        โดยสามารถเพิ่ม ลบ แก้ไข และเรียกดูเอกสารได้ง่าย รวมทั้งแสดงผลตามมาตรฐาน IEEE
    </p>

    <hr>

    <h2>References (IEEE)</h2>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <?php echo $row['title']; ?>.
                [ออนไลน์]. เข้าถึงได้จาก: 
                <a href="<?php echo $row['pdf_url']; ?>" target="_blank">PDF</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <hr>
    <p><a href="reference.php">→ จัดการข้อมูลอ้างอิง</a></p>
</body>
</html>
