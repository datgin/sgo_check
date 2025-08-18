<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chứng nhận sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .certificate-card {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .certificate-header .check {
            font-size: 40px;
            color: green;
        }

        .certificate-header h3 {
            margin-top: 10px;
            font-weight: bold;
        }

        .product-info img {
            max-width: 100px;
        }

        .table td {
            vertical-align: middle;
        }

        .cert-images img {
            max-height: 80px;
            margin-right: 10px;
        }

        .contact-buttons .btn {
            min-width: 120px;
            margin: 5px;
        }
    </style>
</head>

<body>

    <div class="certificate-card">
        <!-- Header -->
        <div class="certificate-header">
            <div class="check">✔</div>
            <h3>Sản phẩm chính hãng</h3>
            <p>Cảm ơn bạn đã mua hàng và tin tưởng chúng tôi!</p>
        </div>

        <!-- Company info -->
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $decoded['logo'] }}" alt="Logo doanh nghiệp" class="me-3" width="80">
                <div>
                    <h5 class="mb-1">{{ $decoded['company'] }}</h5>
                    <p class="mb-1">{{ $decoded['address'] }}</p>
                    <p class="mb-1">Mã số thuế: {{ $decoded['tax_number'] }}</p>
                    <p class="mb-1">Điện thoại: {{ $decoded['phone'] }}</p>
                    <p class="mb-0">Email: {{ $decoded['email'] }}</p>
                </div>
            </div>
        </div>

        <!-- Product detail -->
        <h5 class="mb-3">Thông tin chi tiết sản phẩm</h5>
        <div class="row mb-3">
            <div class="col-md-3">
                <img src="{{ $bill->image }}" alt="Ảnh sản phẩm" class="img-fluid border rounded">
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Tên sản phẩm</strong></td>
                        <td>{{ $bill->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Xuất xứ</strong></td>
                        <td>{{ $bill->origin }}</td>
                    </tr>
                    <tr>
                        <td><strong>Đơn vị sản xuất</strong></td>
                        <td>{{ $bill->manufacturer ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mã sản phẩm</strong></td>
                        <td>{{ $bill->product_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Ngày sản xuất</strong></td>
                        <td>{{ $bill->production_date ? \Carbon\Carbon::parse($bill->production_date)->format('d/m/Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Bảo hành</strong></td>
                        <td>{{ $bill->guarantee ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Thông tin khác</strong></td>
                        <td>
                            @if (is_array($bill->other_information))
                                {{ implode(', ', $bill->other_information) }}
                            @else
                                {{ $bill->other_information }}
                            @endif
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <p><strong>Mô tả ngắn:</strong> {{ $bill->short_description }}</p>

        <!-- Certification -->
        {{-- <h5 class="mb-3">Chứng nhận xuất xứ hàng hóa</h5>
        <div class="cert-images d-flex mb-4">
            <img src="cert1.png" alt="Chứng nhận 1">
            <img src="cert2.png" alt="Chứng nhận 2">
        </div> --}}

        <!-- Contact -->
        <div class="text-center">
            <p><strong>Liên hệ</strong></p>
            <p>Hotline: {{ $decoded['phone'] }} | Email: {{ $decoded['email'] }}</p>
            <div class="contact-buttons">
                <a href="tel:0909999999" class="btn btn-success">📞 Gọi ngay</a>
                <a href="mailto:{{ $decoded['email'] }}" class="btn btn-primary">✉ Gửi Email</a>
                <a href="{{ $decoded['website'] }}" class="btn btn-warning text-white">🌐 Website</a>
            </div>
        </div>
    </div>

</body>

</html>
