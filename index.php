<?php
// 1. Bật hiển thị lỗi để dễ kiểm tra (Xóa khi hoàn thành dự án)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Kết nối database
require_once __DIR__ . '/db.php';

// 3. Truy vấn lấy dữ liệu từ bảng movies
$sql = "SELECT * FROM movies ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Kiểm tra nếu truy vấn lỗi
if (!$result) {
    die("Lỗi truy vấn SQL: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Phim - My Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .movie-img { width: 60px; height: 90px; object-fit: cover; border-radius: 4px; }
        .table img { box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">🎬 Danh Sách Phim Hệ Thống</h4>
            <a href="create.php" class="btn btn-light btn-sm fw-bold">+ Thêm Phim Mới</a>
        </div>
        <div class="card-body">
            
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Poster</th>
                        <th>Tên Phim</th>
                        <th>Thể Loại</th>
                        <th>Năm</th>
                        <th>Đánh Giá</th>
                        <th class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Kiểm tra xem có dữ liệu nào không
                    if (mysqli_num_rows($result) > 0): 
                        while($row = mysqli_fetch_assoc($result)): 
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <img src="<?php echo $row['poster_url']; ?>" 
                                     alt="No Image" class="movie-img" 
                                     onerror="this.src='https://via.placeholder.com/60x90?text=No+Image'">
                            </td>
                            <td><strong><?php echo $row['title']; ?></strong></td>
                            <td><?php echo $row['genre']; ?></td>
                            <td><?php echo $row['release_year']; ?></td>
                            <td><span class="badge bg-warning text-dark">⭐ <?php echo $row['rating']; ?></span></td>
                            <td class="text-center">
                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Sửa</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa phim này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Chưa có dữ liệu phim. Hãy nhấn "Thêm Phim Mới" để bắt đầu!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
    
    <p class="text-center mt-4 text-muted small">© 2026 My Cinema Project - CRUD PHP & MySQL</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>