<?php

include 'connect.php';

//validate
if (isset($_POST['submit'])) {
    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name']['required'] = 'Name is required';
    } else {
        // Trường 'username' có giá trị
        if (strlen(trim($_POST['name'])) < 5) {
            $errors['name']['min'] = 'name phải lớn hơn 5 kí tự';
        }
    }

    if (empty($_POST['birthday'])) {
        $errors['birthday']['required'] = 'birthday is required';
    }

    if (empty($_POST['province'])) {
        $errors['province']['required'] = 'province is required';
    }

    if (empty($_POST['gender'])) {
        $errors['gender']['required'] = 'gender is required';
    }
}
//insert data 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $province = $_POST['province'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $file_name = '';
    $description = $_POST['description'];

    if ($_FILES['avatar']['name']) {
        $file = $_FILES['avatar'];
        $tmp_name = $file['tmp_name'];
        $file_name = $file['name'];
        move_uploaded_file($tmp_name, './uploads/' . $file_name);
    }

    $sql = "INSERT INTO `people`(`name`, `province_id`, `avatar`, `birthday`, `gender`, `about`) VALUES ('$name','$province', '$file_name', '$birthday', '$gender', '$description')";


    if (mysqli_query($conn, $sql)) {
        header('location: index.php');
    } else {
        echo mysqli_error($conn);
    }
}


?>


<?php include_once 'header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php include_once 'sidebar.php'; ?>
            </div>
            <div class="col-lg-9 mb-3">
                <h1 class="text-uppercase py-1 text-center bg-info">thêm mơi người dân</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tên người dân*</label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Nhập tên người dân">
                                <?php echo (!empty($errors['name']['required'])) ? '<span style="color: red">' . $errors['name']['required'] . '</span>' : false;
                                echo (!empty($errors['name']['min'])) ? '<span style="color: red;">' . $errors['name']['min'] . '</span>' : false;
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">chọn thành phố*</label>
                                <div class="form-group">
                                    <select class="form-control" name="province" id="">
                                        <option value="">--choose--</option>
                                        <?php
                                        $sql = "SELECT * FROM province";
                                        $provinces = mysqli_query($conn, $sql);
                                        foreach ($provinces as $value) : ?>
                                            <option value="<?= $value['id'] ?>">
                                                <?= $value['id'] ?> - <?= $value['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo (!empty($errors['province']['required'])) ? '<span style="color: red">' . $errors['province']['required'] . '</span>' : false;
                                    ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">ngày sinh</label>
                                <input type="text" name="birthday" id="" class="form-control" placeholder="yyyy//mm//dd">
                                <?php echo (!empty($errors['birthday']['required'])) ? '<span style="color: red">' . $errors['birthday']['required'] . '</span>' : false;
                                echo (!empty($errors['birthday']['min'])) ? '<span style="color: red;">' . $errors['birthday']['min'] . '</span>' : false;
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check my-3">
                                <label class="form-check-label">
                                    Giới tính
                                    <br>
                                    <input type="radio" class="form-check-input" name="gender" id="" value="1" checked>
                                    nam
                                    <span class="ml-4"></span>
                                    <input type="radio" class="form-check-input mt-2" name="gender" id="" value="0">
                                    nữ
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" name="avatar" id="" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Giới thiệu bản thân</label>
                                <textarea class="form-control" name="description" id="" rows="3" placeholder="Giới thiệu bản thân"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>