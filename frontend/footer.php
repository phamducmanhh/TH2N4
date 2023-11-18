<style>
	#footer {
	background-color: #34495e;
    color: #ecf0f1;
    padding: 20px 0;
    margin-top: auto;
    width: 100%;
    transition: background-color 0.3s ease;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

#footer:hover {
    background-color: #2c3e50;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 10px; /* Khoảng cách giữa các cột trong footer */
}

.footer-column {
    flex: 1;
    max-width: 350px;
    padding: 15px;
    box-sizing: border-box;
    border-radius: 8px; /* Góc bo tròn cho khung footer */
	text-align: center;
}

.footer-column h3 {
    color: #bf5f00;
    border-bottom: 2px dashed #fff; /* Đường gạch ngắn */
    padding-bottom: 8px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.footer-column p,
.footer-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
    line-height: 1.8;
}

.footer-column a {
    color: #bf5f00;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-column a:hover {
    color: #ecf0f1;
    transform: scale(1.1);
}

.logo-container img {
    max-width: 25px; /* Điều chỉnh kích thước tối đa chiều rộng của logo */
    height: auto; /* Giữ tỷ lệ khung hình */
    margin: 5px; /* Tạo khoảng cách giữa các logo */
}

.centered-image {
    display: block;
    margin: 0 auto; /* Canh giữa theo chiều ngang */
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
    }

    .footer-column {
        max-width: 100%;
        margin-bottom: 15px;
    }
}
</style>

<div id="footer" style="background-color:#070707">
            <div class="footer-container">
                <div class="footer-column">
                    <h3>Thông tin liên hệ</h3>
                    <p>Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, Thành phố Hồ Chí Minh</p>
                    <p>Email: th2n4@example.com</p>
                    <p>Điện thoại: 0387.985.987</p>
                    <p>Nhóm TH2N4</p>
                </div>

                <div class="footer-column">
                    <h3>Chính sách</h3>
                    <ul>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                        <li><a href="#">Chính sách vận chuyển</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Theo dõi chúng tôi</h3>
                    <p>Theo dỗi nhóm Đoàn Kết để biết thêm nhiều chi tiết về cửa hàng</p>
                    <!-- Chèn logo liên kết -->
                    <div class="logo-container">
                        <a href="#" target="_blank">
                            <img src="img/Facebook_Logo_(2019).png" alt="Logo Liên Kết 1">
                        </a>
                        <a href="link-to-your-page2" target="_blank">
                            <img src="img/Instagram_logo_2016.svg.png" alt="Logo Liên Kết 2">
                        </a>

                        <a href="link-to-your-page2" target="_blank">
                            <img src="img/LinkedIn_icon_circle.svg.png" alt="Logo Liên Kết 2">
                        </a>
                        <a href="link-to-your-page2" target="_blank">
                            <img src="img/logo-black.png.twimg.1920.png" alt="Logo Liên Kết 2">
                        </a>
                        <!-- Thêm nhiều logo khác nếu cần -->
                    </div>
                </div>
            </div>
 </div>