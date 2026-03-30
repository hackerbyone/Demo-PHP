<?php 
// 1. Kết nối database
include 'db.php'; 

// 2. Kiểm tra nếu người dùng nhấn nút "Lưu Phim"
if (isset($_POST['btn_save'])) {
    // Lấy dữ liệu từ các ô input
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $poster = $_POST['poster_url'];

    // Câu lệnh SQL để thêm mới
    $sql = "INSERT INTO movies (title, director, genre, release_year, rating, poster_url) 
            VALUES ('$title', '$director', '$genre', '$year', '$rating', '$poster')";
    
    // Thực hiện truy vấn
    if (mysqli_query($conn, $sql)) {
        // Nếu thành công, chuyển hướng về trang chủ index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Phim Mới - My Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">➕ Thêm Phim Mới Vào Hệ Thống</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên phim:</label>
                            <input type="text" name="title" class="form-control" placeholder="Ví dụ: Inception" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đạo diễn:</label>
                                <input type="text" name="director" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thể loại:</label>
                                <input type="text" name="genre" class="form-control" placeholder="Hành động, Viễn tưởng...">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Năm sản xuất:</label>
                                <input type="number" name="release_year" class="form-control" value="2026">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đánh giá (1.0 - 10):</label>
                                <input type="number" step="0.1" name="rating" class="form-control" placeholder="8.5">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-primary">Link ảnh poster (URL):</label>
                            <input type="text" name="poster_url" class="form-control" placeholder="https://link-anh.jpg">
                        </div>

                        <div class="d-grid gap-2 d-md-block text-end mt-4">
                            <a href="index.php" class="btn btn-secondary">Hủy bỏ</a>
                            <button type="submit" name="btn_save" class="btn btn-success px-4">Lưu phim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>