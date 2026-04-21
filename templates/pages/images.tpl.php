<h2>Pizza Gallery</h2>

<?php if (isset($_SESSION['login'])) { ?>
    <h3>Upload a New Image</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image_file" accept=".jpg,.jpeg,.png,.gif,.webp">
        <input type="submit" name="upload_image" value="Upload">
    </form>

    <?php if (!empty($uploadMessage)) { ?>
    <p style="color:green;"><?= htmlspecialchars($uploadMessage) ?></p>
<?php } ?>
<?php } else { ?>
    <p><strong>Login to upload new images.</strong></p>
<?php } ?>

<hr>

<div class="gallery-grid">
<?php
$galleryDir = "./images/gallery/";
$images = array();

if (is_dir($galleryDir)) {
    $allFiles = scandir($galleryDir);

    foreach ($allFiles as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
            $images[] = $file;
        }
    }
}

if (!empty($images)) {
    foreach ($images as $img) {
        echo "<div style='border:1px solid #ccc; padding:10px; background:#fff;'>";
        echo "<img src='./images/gallery/" . htmlspecialchars($img) . "' alt='Pizza image' style='width:220px; height:160px; object-fit:cover; display:block;'>";
        echo "<p style='margin-top:8px;'>" . htmlspecialchars($img) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No gallery images found.</p>";
}
?>
</div>