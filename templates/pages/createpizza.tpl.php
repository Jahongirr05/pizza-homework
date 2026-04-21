<h2>Create New Pizza</h2>

<?php
$conn = new mysqli("sql100.infinityfree.com", "if0_41711727", "dushanbe2025", "if0_41711727_pizza_homework");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_pizza'])) {
    $pname = trim($_POST['pname']);
    $categoryname = trim($_POST['categoryname']);
    $vegetarian = isset($_POST['vegetarian']) ? 1 : 0;

    if ($pname === "" || $categoryname === "") {
        echo "<p style='color:red;'>Please fill all required fields.</p>";
    } else {
        $checkStmt = $conn->prepare("SELECT pname FROM pizza WHERE pname = ?");
        $checkStmt->bind_param("s", $pname);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<p style='color:red;'>This pizza name already exists. Please choose another name.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO pizza (pname, categoryname, vegetarian) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $pname, $categoryname, $vegetarian);

            if ($stmt->execute()) {
                header("Location: ./?crud");
                exit;
            } else {
                echo "<p style='color:red;'>Error while creating pizza.</p>";
            }

            $stmt->close();
        }

        $checkStmt->close();
    }
}

$categories = $conn->query("SELECT cname FROM category ORDER BY cname ASC");
?>

<form method="post">
    <label>Pizza Name:</label><br>
    <input type="text" name="pname"><br><br>

    <label>Category:</label><br>
    <select name="categoryname">
        <?php while ($cat = $categories->fetch_assoc()) { ?>
            <option value="<?= htmlspecialchars($cat['cname']) ?>">
                <?= htmlspecialchars($cat['cname']) ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>
        <input type="checkbox" name="vegetarian"> Vegetarian
    </label><br><br>

    <button type="submit" name="create_pizza">Create</button>
    <a href="./?crud"><button type="button">Back</button></a>
</form>

<?php
$conn->close();
?>