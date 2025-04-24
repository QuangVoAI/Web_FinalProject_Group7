<?php
include_once __DIR__ . '/layout/header.php';
include_once __DIR__ . '/layout/header_content.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit();
}

// Dữ liệu người dùng (giả lập, sau này lấy từ database)
$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$date_of_birth = "**/**/2005";
$phone_number = ""; 
$name = "TDTU"; 
?>

<!-- ACCOUNT -->
<section class="account spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="account__sidebar">
                    <div class="account__user">
                        <img src="img/avatar.png" alt="" class="user-avatar">
                        <div class="user-info">
                            <h5><?php echo htmlspecialchars($username); ?></h5>
                            <a href="#" class="edit-profile">Edit Profile</a>
                        </div>
                    </div>
                    <ul class="account__menu">
                        <li><a href="#"><i class="fa fa-bell"></i> Notifications</a></li>
                        <li class="active">
                            <a href="#"><i class="fa fa-user"></i> My Account</a>
                            <ul class="account__submenu">
                                <li class="active"><a href="#">Profile</a></li>
                                <li><a href="#">Banks & Cards</a></li>
                                <li><a href="#">Addresses</a></li>
                                <li><a href="#">Change Password</a></li>
                                <li><a href="#">Notification Settings</a></li>
                                <li><a href="#">Privacy Settings</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-ticket"></i> My Vouchers</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="account__content">
                    <h3>My Profile</h3>
                    <p>Manage and protect your account</p>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <form class="account__profile-form">
                                <table class="profile-table">
                                    <tr>
                                        <td class="label">Username</td>
                                        <td class="value"><?php echo htmlspecialchars($username); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Name</td>
                                        <td class="value">
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">Email</td>
                                        <td class="value">
                                            <div class="input-group">
                                                <span><?php echo htmlspecialchars($email); ?></span>
                                                <a href="#" class="btn-link">Change</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">Phone Number</td>
                                        <td class="value">
                                            <div class="input-group">
                                                <span><?php echo htmlspecialchars($phone_number); ?></span>
                                                <a href="#" class="btn-link">Add</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">Gender</td>
                                        <td class="value">
                                            <div class="gender-options">
                                                <label><input type="radio" name="gender" value="male"> Male</label>
                                                <label><input type="radio" name="gender" value="female" checked> Female</label>
                                                <label><input type="radio" name="gender" value="other"> Other</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">Date of Birth</td>
                                        <td class="value">
                                            <div class="input-group">
                                                <span><?php echo htmlspecialchars($date_of_birth); ?></span>
                                                <a href="#" class="btn-link">Change</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="profile-image-upload">
                                <img src="img/default-avatar.jpg" alt="" class="avatar">
                                <button type="button" class="btn btn-secondary">Select Image</button>
                                <p>File size: maximum 1 MB</p>
                                <p>File extension: JPEG, PNG</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once __DIR__ . '/layout/footer.php'; ?>