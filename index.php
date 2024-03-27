<?php include_once("header.php"); ?>
<ul class="menu">
    <li>
    <style>
  a {
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    color: red;
    font-size: 30px;
  }
</style>
        <a href=>THONG TIN NHAN VIEN</a>
    </li>

    <?php
// Kết nối CSDL
$conn = mysqli_connect("localhost", "root", "", "ql_nhansu");

// Truy vấn lấy dữ liệu nhân viên
$sql = "SELECT * FROM nhanvien";
$result = mysqli_query($conn, $sql);



// Lấy tổng số nhân viên
$sql = "SELECT COUNT(*) AS total_employees FROM nhanvien";
$result = mysqli_query($conn, $sql);
$total_employees = mysqli_fetch_assoc($result)['total_employees'];

// Tính toán số trang
$num_pages = ceil($total_employees / 5);

// Xác định trang hiện tại
$current_page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int) $_GET['page'] : 1;

// Lấy thông tin nhân viên cho trang hiện tại
$sql = "SELECT * FROM nhanvien LIMIT " . (($current_page - 1) * 5) . ", 5";
$result = mysqli_query($conn, $sql);

echo "</table>";



// Hiển thị điều khiển phân trang



for ($i = 1; $i <= $num_pages; $i++) {
    
    echo "<a href='?page=$i'>Trang $i</a>";
    
}








// Tạo bảng HTML
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>";
echo "<th>Mã Nhân Viên</th>";
echo "<th>Tên Nhân Viên</th>";
echo "<th>Giới tính</th>";
echo "<th>Nơi Sinh</th>";
echo "<th>Tên Phòng</th>";
echo "<th>Lương</th>";
echo "</tr>";

// Duyệt qua kết quả và hiển thị từng nhân viên

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['Ma_NV'] . "</td>";
    echo "<td>" . $row['Ten_NV'] . "</td>";
    echo "<td>";
    if ($row['Phai'] == "NAM") {
        echo "<img src='man.jpg' alt='NAM'>";
    } else {
        echo "<img src='woman.jpg' alt='NU'>";
    }
    echo "</td>";
    
    echo "<td>" . $row['Noi_Sinh'] . "</td>";
    echo "<td>" . $row['Ma_Phong'] . "</td>";
    echo "<td>" . $row['Luong'] . "</td>";
    echo "</tr>";
}


echo "</table>";




// Đóng kết nối CSDL
mysqli_close($conn);
?>

    
</ul>
<?php include_once("footer.php");?>