<?php
echo "<h2>Api source php file</h2>";
$pdo = new PDO('mysql:host=mysql;dbname=bgs_com_ctr_db', 'majsteradmin', 'Szcz3k0c!!!ny');
echo "Connected!<br>";

$stmt = $pdo->query("SHOW TABLES");
while ($row = $stmt->fetch()) {
    echo $row[0] . "<br>";
}

$folder = __DIR__ . '/uploads';
$file = $folder . '/test_file.txt';


// Try to create file
if (file_put_contents($file, "Hello from PHP!\n")) {
    echo "File created successfully at: $file";
// Change file permission to group write
    chmod($file, 0664);  // owner rw, group rw, others r
} else {
    echo "Failed to create file. Check folder permissions!";
}

// Check if file exists
if (file_exists($file)) {
    echo "<br>File contents:<br>";
    echo nl2br(file_get_contents($file));
}

$file2 = $folder.'/test2.txt';
if (file_exists($file2)) {
echo "<br>File 2 contents:<br>";
    echo nl2br(file_get_contents($file2));
}
echo "<br>Checking ENV variables<br>";
echo "Secret: " . getenv('APP_SECRET') . "<br>";
var_dump(getenv('APP_SECRET'));


?>
