<?php
include 'condb.php';
header("Content-Type: application/json; charset=UTF-8");

// รับค่า Action จาก $_POST
$action = $_POST['action'] ?? null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action) {
        // ✅ ส่วนของ เพิ่ม / แก้ไข / ลบ (ใช้ POST + Action)
        switch ($action) {
            case 'add':
                $full_name = $_POST['full_name'];
                $department = $_POST['department'];
                $salary = $_POST['salary'];
                $active = $_POST['active'];

                // จัดการอัพโหลดไฟล์รูป
                $filename = null;
                if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    $targetDir = "uploads/";
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    $filename = time() . '_' . basename($_FILES['image']['name']);
                    $targetFile = $targetDir . $filename;
                    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
                }

                $sql = "INSERT INTO employees (full_name, department, salary, active, image)
                        VALUES (:full_name, :department, :salary, :active, :image)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':department', $department);
                $stmt->bindParam(':salary', $salary);
                $stmt->bindParam(':active', $active);
                $stmt->bindParam(':image', $filename);

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "เพิ่มข้อมูลพนักงานเรียบร้อย"]);
                } else {
                    echo json_encode(["success" => false, "message" => "ไม่สามารถเพิ่มข้อมูลพนักงานได้"]);
                }
                break;

            case 'update':
                $emp_id = $_POST['emp_id'];
                $full_name = $_POST['full_name'];
                $department = $_POST['department'];
                $salary = $_POST['salary'];
                $active = $_POST['active'];

                // จัดการอัพโหลดไฟล์รูปใหม่ (ถ้ามี)
                $imageSQL = "";
                if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    $targetDir = "uploads/";
                    $filename = time() . '_' . basename($_FILES['image']['name']);
                    $targetFile = $targetDir . $filename;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $imageSQL = ", image = :image";
                    }
                }

                $sql = "UPDATE employees SET 
                            full_name = :full_name,
                            department = :department,
                            salary = :salary,
                            active = :active
                            $imageSQL
                        WHERE emp_id = :emp_id";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':department', $department);
                $stmt->bindParam(':salary', $salary);
                $stmt->bindParam(':active', $active);
                $stmt->bindParam(':emp_id', $emp_id);
                if (!empty($imageSQL)) {
                    $stmt->bindParam(':image', $filename);
                }

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "แก้ไขข้อมูลพนักงานเรียบร้อย"]);
                } else {
                    echo json_encode(["success" => false, "message" => "ไม่สามารถแก้ไขข้อมูลได้"]);
                }
                break;

            case 'delete':
                $emp_id = $_POST['emp_id'];
                
                // ขั้นตอนลบ: (แนะนำให้ลบไฟล์รูปในโฟลเดอร์ทิ้งด้วยถ้าต้องการ)
                $stmt = $conn->prepare("DELETE FROM employees WHERE emp_id = :emp_id");
                $stmt->bindParam(':emp_id', $emp_id);
                
                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "ลบข้อมูลเรียบร้อย"]);
                } else {
                    echo json_encode(["success" => false, "message" => "ไม่สามารถลบข้อมูลได้"]);
                }
                break;

            default:
                echo json_encode(["success" => false, "message" => "Action ไม่ถูกต้อง"]);
                break;
        }
    } else {
        // ✅ GET: ดึงข้อมูลพนักงานทั้งหมด
        $stmt = $conn->prepare("SELECT * FROM employees ORDER BY emp_id DESC");
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(["success" => true, "data" => $result]);
        } else {
            echo json_encode(["success" => false, "data" => []]);
        }
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>