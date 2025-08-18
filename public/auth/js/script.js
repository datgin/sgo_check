function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

$(function () {
    $("form").on("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: window.location.href,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: () => {
                $("#loadingOverlay").show();
            },
            success: (res) => {

                window.location.href = res.data;
            },
            error: (xhr) => {
                datgin.error(
                    xhr.responseJSON?.message ??
                        "Đã có lỗi xảy ra, vui lòng thử lại sau!"
                );
            },
            complete: function () {
                $("#loadingOverlay").hide();
            },
        });
    });
});
