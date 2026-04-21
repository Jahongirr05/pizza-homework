<h2>Contact Us</h2>

<script>
function validateContactForm() {
    let email = document.forms["contactForm"]["email"].value.trim();
    let subject = document.forms["contactForm"]["subject"].value.trim();
    let message = document.forms["contactForm"]["message"].value.trim();

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (subject.length < 3) {
        alert("Subject must be at least 3 characters.");
        return false;
    }

    if (message.length < 5) {
        alert("Message must be at least 5 characters.");
        return false;
    }

    return true;
}
</script>

<form name="contactForm" method="post" onsubmit="return validateContactForm();">
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <label>Subject:</label><br>
    <input type="text" name="subject"><br><br>

    <label>Message:</label><br>
    <textarea name="message"></textarea><br><br>

    <input type="submit" name="send" value="Send">
</form>

<?php
if (isset($_POST['send'])) {
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (strlen($subject) < 3) {
        $errors[] = "Subject must be at least 3 characters.";
    }

    if (strlen($message) < 5) {
        $errors[] = "Message must be at least 5 characters.";
    }

    if (empty($errors)) {
        $conn = new mysqli("sql100.infinityfree.com", "if0_41711727", "dushanbe2025", "if0_41711727_pizza_homework");

        if ($conn->connect_error) {
            die("Database connection failed.");
        }

        $sender_name = isset($_SESSION['login']) ? ($_SESSION['fn'] . " " . $_SESSION['ln']) : "Guest";

        $stmt = $conn->prepare("INSERT INTO messages (sender_name, sender_email, subject, message_text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $sender_name, $email, $subject, $message);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Message sent successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error while saving the message.</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<div style='color:red;'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
}
?>