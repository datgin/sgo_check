<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>{{ $user->company }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ $user->favicon }}">
    <link rel="icon" href="{{ $user->favicon }}">


    <style>
        body {
            background: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .certificate-card {
            max-width: 900px;
            margin: 15px auto;
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        @media (min-width: 768px) {
            .certificate-card {
                padding: 35px;
            }
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .certificate-header .check {
            font-size: 48px;
            color: #28a745;
        }

        .certificate-header h3 {
            margin-top: 12px;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .certificate-card img {
            max-width: 100%;
            height: auto;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.95rem;
        }

        .contact-buttons .btn {
            min-width: 130px;
            font-size: 0.95rem;
        }

        /* Icon màu đẹp */
        .btn i {
            margin-right: 6px;
        }

        .btn-call {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-email {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-website {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #fff;
        }

        .file-icon {
            color: #6c757d;
            margin-right: 8px;
        }

        .list-group-item:hover {
            background-color: #f0f0f0;
        }

        .section-divider {
            border-bottom: 1px solid #dee2e6;
            margin: 25px 0;
        }
    </style>
</head>

<body>

    <div class="certificate-card">
        <!-- Header -->
        <div class="certificate-header">
            <div class="check"><i class="fas fa-check-circle"></i></div>
            <h3>Sản phẩm chính hãng</h3>
            <p>Cảm ơn bạn đã mua hàng và tin tưởng chúng tôi!</p>
        </div>

        <div class="section-divider"></div>

        <!-- Company info -->
        <div class="mb-4">
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-4 text-center">
                    <img src="{{ $user->logo }}" alt="Logo doanh nghiệp" class="img-fluid" style="max-height:120px">
                </div>
                <div class="col-12 col-md-8 text-center text-md-start">
                    <h5 class="mb-1">{{ $user->company }}</h5>
                    <p class="mb-1">{{ $user->address }}</p>
                    <p class="mb-1">Mã số thuế: {{ $user->tax_number }}</p>
                    <p class="mb-1">Điện thoại: {{ $user->phone }}</p>
                    <p class="mb-0">Email: {{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>

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
                <p><strong>Mô tả ngắn:</strong> {{ $bill->short_description }}</p>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- File đính kèm -->
        @if (!empty($bill->files))
            <div class="mb-4">
                <h5>File đính kèm</h5>
                <div class="list-group">
                    @foreach ($bill->files as $file)
                        <a href="{{ Storage::url($file->file_path) }}" class="list-group-item list-group-item-action"
                            target="_blank" download>
                            <i class="fas fa-file-alt file-icon"></i> {{ basename($file->file_path) }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="section-divider"></div>

        <!-- Contact -->
        <div class="text-center mt-4">
            <p><strong>Liên hệ</strong></p>
            <p>Hotline: {{ $user->phone }} | Email: {{ $user->email }}</p>
            <div class="contact-buttons d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="tel:{{ $user->phone }}" class="btn btn-call text-light"><i class="fas fa-phone"></i> Gọi
                    ngay</a>
                <a href="mailto:{{ $user->email }}" class="btn btn-email text-light"><i class="fas fa-envelope"></i>
                    Email</a>
                <a href="{{ $user->website }}" class="btn btn-website text-dark"><i class="fas fa-globe"></i>
                    Website</a>
            </div>
        </div>
    </div>

</body>

</html>
