<?php 
include 'db.php'; 

// 1. Lấy ID của phim cần sửa từ thanh địa chỉ (URL)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 2. Truy vấn lấy thông tin hiện tại của phim đó
    $result = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Không tìm thấy phim!");
    }
}

// 3. Xử lý khi nhấn nút "Cập nhật"
if (isset($_POST['btn_update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $poster = $_POST['poster_url'];

    // Lệnh UPDATE để sửa dữ liệu dựa trên ID
    $sql_update = "UPDATE movies SET 
                    title='$title', 
                    director='$director', 
                    genre='$genre', 
                    release_year='$year', 
                    rating='$rating', 
                    poster_url='$poster' 
                   WHERE id=$id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Phim - My Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">✏️ Chỉnh Sửa Thông Tin Phim</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên phim:</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đạo diễn:</label>
                                <input type="text" name="director" class="form-control" value="<?php echo $row['director']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thể loại:</label>
                                <input type="text" name="genre" class="form-control" value="<?php echo $row['genre']; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Năm sản xuất:</label>
                                <input type="number" name="release_year" class="form-control" value="<?php echo $row['release_year']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Đánh giá:</label>
                                <input type="number" step="0.1" name="rating" class="form-control" value="<?php echo $row['rating']; ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link ảnh poster:</label>
                            <input type="text" name="poster_url" class="form-control" value="<?php echo $row['poster_url']; ?>">
                        </div>

                        <div class="d-grid gap-2 d-md-block text-end mt-4">
                            <a href="index.php" class="btn btn-secondary">Hủy bỏ</a>
                            <button type="submit" name="btn_update" class="btn btn-info px-4">Cập nhật ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>