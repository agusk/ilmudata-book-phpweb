<?php
$folder = "uploads/";
$files = scandir($folder);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Foto Explore</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Galeri Foto</h1>
    <div class="row">
        <?php foreach ($files as $file): ?>
            <?php if ($file !== "." && $file !== ".."): ?>
                <div class="col-md-4">
                    <img src="<?php echo $folder . $file; ?>" class="img-fluid" alt="<?php echo $file; ?>">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <br>            
    <h2>Unggah Foto Baru</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="foto" required>
        <button type="submit" class="btn btn-primary">Unggah</button>
    </form>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>