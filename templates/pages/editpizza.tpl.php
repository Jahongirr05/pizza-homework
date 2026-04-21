<h2>Edit Pizza</h2>

<?php
$conn = new mysqli("sql100.infinityfree.com", "if0_41711727", "dushanbe2025", "if0_41711727_pizza_homework");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_pizza'])) {
    $original_pname = $_POST['original_pname'];
    $pname = trim($_POST['pname']);
    $categoryname = trim($_POST['categoryname']);
    $vegetarian = isset($_POST['vegetarian']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE pizza SET pname=?, categoryname=?, vegetarian=? WHERE pname=?");
    $stmt->bind_param("ssis", $pname, $categoryname, $vegetarian, $original_pname);
    $stmt->execute();
    $stmt->close();

    header("Location: ./?crud");
    exit;
}

if (!isset($_POST['pname'])) {
    echo "<p style='color:red;'>No pizza selected.</p>";
    echo '<a href="./?crud">Back to CRUD</a>';
    $conn->close();
    return;
}

$currentPname = $_POST['pname'];

$stmt = $conn->prepare("SELECT * FROM pizza WHERE pname=?");
$stmt->bind_param("s", $currentPname);
$stmt->execute();
$result = $stmt->get_result();
$pizza = $result->fetch_assoc();
$stmt->close();

if (!$pizza) {
    echo "<p style='color:red;'>Pizza not found.</p>";
    echo '<a href="?crud">Back to CRUD</a>';
    $conn->close();
    return;
}

$categories = $conn->query("SELECT cname FROM category ORDER BY cname ASC");
?>

<form method="post">
    <input type="hidden" name="original_pname" value="<?= htmlspecialchars($pizza['pname']) ?>">

    <label>Pizza Name:</label><br>
    <input type="text" name="pname" value="<?= htmlspecialchars($pizza['pname']) ?>"><br><br>

    <label>Category:</label><br>
    <select name="categoryname">
        <?php while ($cat = $categories->fetch_assoc()) { ?>
            <option value="<?= htmlspecialchars($cat['cname']) ?>"
                <?= ($cat['cname'] === $pizza['categoryname']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['cname']) ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>
        <input type="checkbox" name="vegetarian" <?= $pizza['vegetarian'] ? 'checked' : '' ?>>
        Vegetarian
    </label><br><br>

    <button type="submit" name="update_pizza">Update</button>
    <a href="./?crud"><button type="button">Back</button></a>
</form>

<?php
$conn->close();
?>