<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OMADA Alerts - Log Viewer</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        pre { background: #f0f0f0; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>OMADA Alerts Log - <?php echo OMADA_SITE; ?></h1>
    <pre>
<?php
if (file_exists(LOG_FILE)) {
    echo file_get_contents(LOG_FILE);
} else {
    echo "No logs yet.";
}
?>
    </pre>
</body>
</html>
