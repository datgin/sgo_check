<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGO Media - Đăng Nhập</title>
    <link href="{{ asset('auth/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('auth/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('global/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>

<body>
    <div class="main-container">
        <div class="login-card">
            <div class="row g-0">
                <!-- Contact Section -->
                <div class="col-lg-6 col-md-6">
                    <div class="contact-section h-100">
                        <h2 class="contact-title">LIÊN HỆ VỚI CHÚNG TÔI</h2>
                        <div class="contact-box">
                            <div class="contact-item">
                                <span class="contact-label">Hỗ trợ kỹ thuật:</span>
                                <div class="contact-info">
                                    <div class="phone-number">(024) 62 927 089</div>
                                    <div class="time-info">(24/7)</div>
                                </div>
                            </div>

                            <div class="contact-item">
                                <span class="contact-label"></span>
                                <div class="contact-info">
                                    <div class="phone-number">0981 185 520</div>
                                    <div class="time-info">(24/7)</div>
                                </div>
                            </div>

                            <div class="contact-item">
                                <span class="contact-label">Hỗ trợ học đơn:</span>
                                <div class="contact-info">
                                    <div class="phone-number">(024) 62 927 089</div>
                                    <div class="time-info">(8h30 - 18h00)</div>
                                </div>
                            </div>

                            <div class="contact-item">
                                <span class="contact-label"></span>
                                <div class="contact-info">
                                    <div class="phone-number">0912 399 322</div>
                                    <div class="time-info">(8h30 - 18h00)</div>
                                </div>
                            </div>

                            <div class="contact-item">
                                <span class="contact-label">Hỗ trợ giá hạn:</span>
                                <div class="contact-info">
                                    <div class="phone-number">(024) 62 927 089</div>
                                    <div class="time-info">(8h30 - 18h00)</div>
                                </div>
                            </div>

                            <div class="contact-item">
                                <span class="contact-label"></span>
                                <div class="contact-info">
                                    <div class="phone-number">0981 185 520</div>
                                    <div class="time-info">(8h30 - 18h00)</div>
                                </div>
                            </div>

                            <div class="contact-item">
                                <span class="contact-label">Email:</span>
                                <div class="contact-info">
                                    <div class="phone-number">info@sgomedia.vn</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Section -->
                <div class="col-lg-6 col-md-6">
                    <div class="login-section">
                        <div class="logo-container text-center">
                            <img src="{{ asset('auth/images/logo.png') }}" alt="SGO Media" class="logo"
                                style="max-width: 180px;">
                        </div>

                        <form>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control py-2" id="email"
                                        placeholder="Địa chỉ Email">
                                    <small id="err-email" class="text-danger text-muted"></small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control py-2" id="password"
                                        placeholder="Password">
                                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </span>
                                </div>
                                <small id="err-email" class="text-danger text-muted"></small>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="remember" type="checkbox"
                                        id="rememberPassword">
                                    <label class="form-check-label" for="rememberPassword">
                                        Lưu mật khẩu
                                    </label>
                                </div>
                            </div>

                            <button type="submit" id="button-submit" class="btn btn-login">
                                ĐĂNG NHẬP
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loadingOverlay">
        <div id="loading"></div>
    </div>

    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('global/js/toastr.js') }}"></script>
    <script src="{{ asset('auth/js/script.js') }}"></script>
</body>

</html>
