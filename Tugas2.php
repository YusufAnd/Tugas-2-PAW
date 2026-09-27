<?php
$host = 'localhost';
$db   = 'Tugas2PAW';
$user = 'root';
$pass = 'Nanda5712*#';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    die('Error: ' . $e->getMessage());
}

if (isset($_POST['tambah'])) {
    $nim  = $_POST['nim'];
    $name = $_POST['name'];

    $sql  = "INSERT INTO mahasiswa (nim, name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nim, $name]);

    header("Location: Tugas2.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql  = "DELETE FROM mahasiswa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    header("Location: Tugas2.php");
    exit();
}

$data_edit = null;
if (isset($_GET['edit'])) {
    $id   = $_GET['edit'];
    $sql  = "SELECT * FROM mahasiswa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $data_edit = $stmt->fetch();
}

if (isset($_POST['update'])) {
    $id   = $_POST['id'];
    $nim  = $_POST['nim'];
    $name = $_POST['name'];

    $sql  = "UPDATE mahasiswa SET nim = ?, name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nim, $name, $id]);

    header("Location: Tugas2.php");
    exit();
}

$sql   = "SELECT * FROM mahasiswa";
$query = $conn->query($sql);
$rows  = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tugas 2 PAW</title>
</head>
<body>

    <h2>Form Data Mahasiswa</h2>

    <!-- Form Input / Edit -->
    <form action="Tugas2.php" method="POST">
        <?php if ($data_edit): ?>
            <input type="hidden" name="id" value="<?php echo $data_edit['id']; ?>">
            <p>NIM: <input type="text" name="nim" value="<?php echo $data_edit['nim']; ?>"></p>
            <p>Nama: <input type="text" name="name" value="<?php echo $data_edit['name']; ?>"></p>
            <button type="submit" name="update">Update Data</button>
            <a href="Tugas2.php">Batal</a>
        <?php else: ?>
            <p>NIM: <input type="text" name="nim" required></p>
            <p>Nama: <input type="text" name="name" required></p>
            <button type="submit" name="tambah">Simpan</button>
        <?php endif; ?>
    </form>

    <hr>

    <h2>Daftar Mahasiswa</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($rows as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nim']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
                <a href="Tugas2.php?edit=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="Tugas2.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
