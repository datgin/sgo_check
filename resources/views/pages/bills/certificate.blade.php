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
            margin: 15px auto;
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
            font-size: 1.4rem;
        }

        .certificate-card img {
            max-width: 100%;
            height: auto;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .contact-buttons .btn {
            min-width: 110px;
            font-size: 0.9rem;
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
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-4 text-center">
                    <img src="{{ $decoded['logo'] }}" alt="Logo doanh nghiệp" class="img-fluid"
                        style="max-height:120px">
                </div>
                <div class="col-12 col-md-8 text-center text-md-start">
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
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <img src="{{ $bill->image }}" alt="Ảnh sản phẩm" class="img-fluid border rounded w-100">
            </div>
            <div class="col-12 col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <p><strong>Mô tả ngắn:</strong> {{ $bill->short_description }}</p>

        <!-- Contact -->
        <div class="text-center mt-4">
            <p><strong>Liên hệ</strong></p>
            <p>Hotline: {{ $decoded['phone'] }} | Email: {{ $decoded['email'] }}</p>
            <div class="contact-buttons d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="tel:{{ $decoded['phone'] }}" class="btn btn-success">📞 Gọi ngay</a>
                <a href="mailto:{{ $decoded['email'] }}" class="btn btn-primary">✉ Gửi Email</a>
                <a href="{{ $decoded['website'] }}" class="btn btn-warning text-white">🌐 Website</a>
            </div>
        </div>
    </div>

</body>

</html>
