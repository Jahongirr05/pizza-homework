<h2>Messages</h2>

<?php
if (!isset($_SESSION['login'])) {
    echo "<p style='color:red;'>Only logged-in users can view messages.</p>";
} else {
    $conn = new mysqli("sql100.infinityfree.com", "if0_41711727", "dushanbe2025", "if0_41711727_pizza_homework");

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr>
                <th>Date</th>
                <th>Sender</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            echo "<td>" . htmlspecialchars($row['sender_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['sender_email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
            echo "<td>" . htmlspecialchars($row['message_text']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No messages found.</p>";
    }

    $conn->close();
}
?>