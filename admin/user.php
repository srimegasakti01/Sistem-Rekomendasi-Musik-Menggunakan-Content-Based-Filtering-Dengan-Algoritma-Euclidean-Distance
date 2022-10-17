<?php
if (!isset($_SESSION)) {
    session_start();
    include "../koneksi.php";
}

$SemuaUser = array();
$ambil = $koneksi->query("SELECT * FROM user");
while ($tiap = $ambil->fetch_assoc()) {
    $SemuaUser[] = $tiap;
}

?>

<div class="container">
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($SemuaUser as $key => $value) : ?>
            <tr>
                <td><?php echo $value['id_user'] ?></td>
                <td><?php echo $value['nama_user'] ?></td>
                <td><?php echo $value['email_user'] ?></td>
                <td class="text-center">
                    <a href="<?php echo $value["id_user"]; ?>" class="btn btn-outline-warning">Update</a>
                    <a href="<?php echo $value["id_user"]; ?>" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>