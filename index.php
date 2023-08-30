<?php include_once 'header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php include_once 'sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <h1 class="text-center text-uppercase">danh sách sản phẩm</h1>
                <a name="" id="" class="btn btn-primary" href="add.php">Add new +</a>
                <table class="table my-4">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Ảnh</th>
                            <th>Tên người dân</th>
                            <th>ngày sinh</th>
                            <th>thành phố</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once 'connect.php';
                        $sql = "SELECT pr.name as provinceName, p.* FROM people p JOIN province pr ON pr.id = p.province_id";
                        $result =  mysqli_query($conn, $sql);
                        foreach ($result as $row) {
                            echo "
                            <tr>
                            <td>$row[id]</td>
                            <td><img src='./uploads/$row[avatar]' width='50' alt=''></td>
                            <td>$row[name]</td>
                            <td>$row[birthday]</td>
                            <td>$row[provinceName]</td>
                            <td>
                                <a name='' id='' class='btn btn-primary' href='update.php?id=$row[id]'>edit</a>
                                <a name='' id='' onclick='return confirm(\"Are you sure ???\")' class='btn btn-danger' href='delete.php?id=$row[id]'>delete</a>
                            </td>
                        ";
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>