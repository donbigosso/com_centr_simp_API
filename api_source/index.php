<?php
include 'classes/db_access.php';
include 'classes/core.php';
include 'classes/user_model.php';

echo "<h2>Api source php file</h2>";

$db   = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$core = new Core();
$db = new DatabaseAccess('mysql', $db, $user, $pass);
$userModel = new UserModel($db);




echo "<br><br>";
$hashed_pwd = password_hash('Mont3Negr0!', PASSWORD_DEFAULT);
// var_dump($db->insert('users', ['name' => 'bigos', 'password' => $hashed_pwd]));

$found_user = $userModel->getByName('bigos');
if($found_user){
    print_r($found_user);
}
else
{
    echo "User not found<br>";
}   



echo "<br><br>";

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
else
{
    echo "<br>$file2 does not exist.";
}

echo "<br>Checking ENV variables<br>";
var_dump(getenv('API_KEYS'));
var_dump(getenv('MYSQL_DATABASE'));
echo "<br><br> This line was added form MacOS"; 

?>
