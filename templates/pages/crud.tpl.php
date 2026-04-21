<h2>Pizza CRUD</h2>

<p><a href="./?createpizza">Add New Pizza</a></p>

<?php
$conn = new mysqli("sql100.infinityfree.com", "if0_41711727", "dushanbe2025", "if0_41711727_pizza_homework");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.pname, p.categoryname, p.vegetarian, c.price
        FROM pizza p
        LEFT JOIN category c ON p.categoryname = c.cname
        ORDER BY p.pname ASC";

$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}

echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>Pizza Name</th>
        <th>Category</th>
        <th>Vegetarian</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['pname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['categoryname']) . "</td>";
    echo "<td>" . ($row['vegetarian'] ? "Yes" : "No") . "</td>";
    echo "<td>" . htmlspecialchars($row['price'] ?? '') . "</td>";
    echo "<td>";

    echo '<form method="post" action="./?editpizza" style="display:inline;">
        <input type="hidden" name="pname" value="' . htmlspecialchars($row['pname']) . '">
        <button type="submit">Edit</button>
        </form> ';

    echo '<form method="post" action="./?deletepizza" style="display:inline;" onsubmit="return confirm(\'Delete this pizza?\');">
        <input type="hidden" name="pname" value="' . htmlspecialchars($row['pname']) . '">
        <button type="submit">Delete</button>
        </form>';

    echo "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>