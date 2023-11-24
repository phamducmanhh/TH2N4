<?php

session_start();
include('../db/dbhelper.php'); // Assuming the function is defined in a file named 'dbhelper.php' in the same directory as 'create_order.php'

if (isset($_SESSION['ten_dangnhap'])) {
  $ten_dangnhap = $_SESSION['ten_dangnhap'];
  $sql = 'select * from khachhang where ten_dangnhap="' . $ten_dangnhap . '"';
  $infoCus = executeSingleResult($sql);

  $tong_tien = 0;
  
  if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
  } else {
    $cart = [];
  }

  foreach ($cart as $value) {
      $tong_tien += $value['qty'] * $value['price'];
  }

// Tạo danh sách các sản phẩm được chọn
    $listProduct = array_filter($cart, function ($value) {
        return $value['qty'] > 0;
    });
    
  

  // Tạo đơn hàng
  $order = [
    'id_khachhang' => $infoCus['id'],
    'tong_tien' => $tong_tien,
    'ngay_tao' => date('Y/m/d H:i:s'),
    'chi_tiet' => $listProduct,
  ];
  // Tạo id cho đơn hàng
  $id_hoadon = executeSingleResult('SELECT id FROM hoadon ORDER BY ngay_tao DESC LIMIT 0, 1')['id'] + 1;

  // Lưu đơn hàng vào cơ sở dữ liệu
//   execute('INSERT INTO hoadon (id, id_khachhang, tong_tien, ngay_tao) VALUES (' . $id_hoadon . ', ' . $infoCus['id'] . ', ' . $tong_tien . ', "' . date('Y/m/d H:i:s') . '")');

  // Lưu chi tiết đơn hàng vào cơ sở dữ liệu
  foreach ($listProduct as $key => $value) {
    execute('INSERT INTO cthoadon (id_hoadon, id_sanpham, so_luong) VALUES (' . $id_hoadon . ', ' . $key . ', ' . $value['qty'] . ')');
    }
  // Cập nhật số lượng sản phẩm
  foreach ($cart as $key => $value) {
    $sl = executeSingleResult('SELECT so_luong FROM sanpham WHERE id = ' . $key)['so_luong'];
    $sldabancu = executeSingleResult('SELECT sl_da_ban FROM sanpham WHERE id = ' . $key)['sl_da_ban'];
    execute('UPDATE sanpham SET so_luong="' . ($sl - $value['qty']) . '", sl_da_ban="' . ($value['qty'] + $sldabancu) . '" WHERE id = ' . $key);
    }
    // Lưu tổng tiền của đơn hàng vào cơ sở dữ liệu
    execute('UPDATE hoadon SET tong_tien="' . $tong_tien . '" WHERE id=' . $id_hoadon);

  // Xóa giỏ hàng sau khi thanh toán
  unset($_SESSION['cart']);
}

// Hiển thị thông báo đặt hàng thành công
echo '<script>alert("Đặt hàng thành công");</script>';
$orderStatus = 'success';

// Chuyển về trang index.php
header('Location:../index.php');
?>