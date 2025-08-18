<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chứng nhận sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- responsive meta -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .certificate-card {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .certificate-card {
                padding: 30px;
            }
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

        .certificate-card img {
            max-width: 100%;
            height: auto;
        }

        .table td {
            vertical-align: middle;
        }

        .contact-buttons .btn {
            min-width: 120px;
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
            <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                <img src="{{ $decoded['logo'] }}" alt="Logo doanh nghiệp" class="me-md-3 mb-3 mb-md-0"
                    style="max-width:180px">
                <div class="text-center text-md-start">
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
            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <img src="{{ $bill->image }}" alt="Ảnh sản phẩm" class="img-fluid border rounded">
            </div>
            <div class="col-12 col-md-9">
                <div class="table-responsive">
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
        </div>

        <p><strong>Mô tả ngắn:</strong> {{ $bill->short_description }}</p>

        <!-- Contact -->
        <div class="text-center mt-4">
            <p><strong>Liên hệ</strong></p>
            <p>Hotline: {{ $decoded['phone'] }} | Email: {{ $decoded['email'] }}</p>
            <div class="contact-buttons d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="tel:{{ $decoded['phone'] }}" class="btn btn-success">📞 Gọi ngay</a>
                <a href="mailto:{{ $decoded['email'] }}" class="btn btn-primary">✉ Gửi Email</a>
                <a href="{{ $decoded['website'] }}" class="btn btn-warning text-white">🌐 Website</a>
            </div>
        </div>
    </div>

</body>

</html>
