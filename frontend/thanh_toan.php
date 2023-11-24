<?php
session_start();
    include('../db/dbhelper.php');
    if(isset($_SESSION['ten_dangnhap'])){
        $ten_dangnhap=$_SESSION['ten_dangnhap'];
        $sql='select * from khachhang where ten_dangnhap="'.$ten_dangnhap.'"';
        // Tạo ID đơn hàng
        $id_hoadon = executeSingleResult('SELECT id FROM hoadon ORDER BY ngay_tao DESC LIMIT 0, 1')['id'] + 1;
        $tong_tien=0;
        $infoCus=executeSingleResult($sql);
        if(isset($_SESSION['cart'])) $cart=$_SESSION['cart'];
        $totalPrice = 0;
        $totalPriceArr = []; // Tạo một mảng trống để lưu tổng giá

        foreach ($cart as $value) {
            $totalPrice = $value['qty'] * $value['price'];
            $totalPriceArr[] = ['name' => $value['name'], 'price' => $totalPrice]; // Lưu tổng giá cho mỗi mặt hàng trong mảng
        }
        $totalPriceAll = 0;
        foreach ($cart as $item) {
        $totalPriceAll += $item['qty'] * $item['price'];
        }
        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $ngay_tao_HD=date('Y/m/d H:i:s');
        $sql='insert into hoadon (id_khachhang, tong_tien, ngay_tao) value ("'.$infoCus['id'].'", "'.$totalPriceAll.'", "'.$ngay_tao_HD.'")';
        execute($sql);
        $id_hoadon=executeSingleResult('SELECT id FROM hoadon ORDER BY ngay_tao DESC LIMIT 0, 1')['id'];
        foreach($cart as $key => $value){
            execute('INSERT INTO cthoadon (id_hoadon, id_sanpham, so_luong) VALUE ("'.$id_hoadon.'", "'.$key.'", "'.$value['qty'].'")');
            $sl=executeSingleResult('SELECT so_luong FROM sanpham WHERE id='.$key)['so_luong'];
            $sldabancu=executeSingleResult('SELECT sl_da_ban FROM sanpham WHERE id='.$key)['sl_da_ban'];
            execute('UPDATE sanpham SET so_luong="'.($sl-$value['qty']).'", sl_da_ban="'.($value['qty']+$sldabancu).'" WHERE id='.$key);
            
        }
        
        // Lưu chi tiết đơn hàng
        // foreach ($cart as $key => $value) {
        // execute('INSERT INTO cthoadon (id_hoadon, id_sanpham, so_luong) VALUE ("'.$id_hoadon.'", "'.$key.'", "'.$value['qty'].'")');
        // }

        // Cập nhật số lượng sản phẩm
        foreach ($cart as $key => $value) {
            $sl = executeSingleResult('SELECT so_luong FROM sanpham WHERE id = ' . $key)['so_luong'];
            $sldabancu = executeSingleResult('SELECT sl_da_ban FROM sanpham WHERE id = ' . $key)['sl_da_ban'];
            execute('UPDATE sanpham SET so_luong="' . ($sl - $value['qty']) . '", sl_da_ban="' . ($value['qty'] + $sldabancu) . '" WHERE id = ' . $key);
        }
          
        $tong_tien_muahang=executeSingleResult('select tong_tien_muahang as s from khachhang where id='.$infoCus['id'])['s'];//TỔng tiền hiện tại khách hàng đã mua
        execute('UPDATE khachhang SET tong_tien_muahang="'.($tong_tien_muahang+$tong_tien).'" WHERE id='.$infoCus['id']);//Cập nhật lại tổng tiền mau hàng
        //Cập nhật lại sô lượng sản phẩm theo thể loại
        $listCate=executeResult('SELECT * FROM theloai WHERE 1');
        foreach($listCate as $item){
            $tongSPtheoTheLoai=executeSingleResult('SELECT SUM(so_luong) AS sl FROM sanpham WHERE id_the_loai='.$item['id'])['sl'];
            execute('UPDATE theloai SET tong_sp="'.$tongSPtheoTheLoai.'" WHERE id='.$item['id']);
        }
        // Xóa giỏ hàng sau khi thanh toán
        unset($_SESSION['cart']);
    }
          
?>
<style>

</style>
<h2>Thông tin đơn hàng</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart as $item) { ?>
        <tr>
            <td><?php echo $item['name'] ?></td>
            <td><?php echo $item['qty'] ?></td>
            <td><?php echo number_format($item['price'], 0, ',', '.') ?></td>
            <?php $totalPrice = 0;
            $totalPrice = $item['qty'] * $item['price'];
            $tong_tien += $totalPrice;
            foreach ($totalPriceArr as $totalPriceItem) {
                if ($totalPriceItem['name'] == $item['name']) {
                    $totalPrice = $totalPriceItem['price'];
                    break;
                }
            }
            echo '<td>' . number_format($totalPrice, 0, ',', '.') . '</td>'; ?>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"></td>
            <td><strong>Tổng tiền:</strong></td>
            <td><?php echo number_format($tong_tien, 0, ',', '.'); ?></td>
        </tr>
    </tbody>
</table>
<h2>Phương thức thanh toán</h2>
<?php
$totalPrice = 0;
foreach ($cart as $item) {
$totalPrice += $item['qty'] * $item['price'];
}

// Tạo form submit
echo '<form method="POST" action="xulythanhtoanmomo.php">';

    // Thêm input hidden
    echo '<input type="hidden" name="amount" value="' . $totalPrice . '">';

    // Thêm button submit momo
    echo '<button type="submit">Thanh toán MOMO</button>';

    // Đóng form
    echo '</form>';	
    echo ' <form action="create_order.php" method="post">';
    echo '<input type="submit" value="Thanh toán" onclick="createOrder();">';
    echo '</form>';

?>
