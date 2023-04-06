$('.register-btn').click(function (e) {
    e.preventDefault();
    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();
    let confirm_password = $('input[name="confirm_password"]').val();
    let email = $('input[name="email"]').val();
    let name = $('input[name="name"]').val();
    let register = $('input[name="register"]').val();

    $.ajax({
        url: '../Controller/UserRegister.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
            confirm_password: confirm_password,
            email: email,
            name: name,
            register: register
        },
        success: function (data) {
            $('.login_error').text(data.login_error);
            $('.login_error_preg').text(data.login_error_preg);
            $('.login_exists_error').text(data.login_exists_error);
            $('.password_error').text(data.password_error);
            $('.password_error_preg').text(data.password_error_preg);
            $('.confirm_password_error').text(data.confirm_password_error);
            $('.email_error').text(data.email_error);
            $('.email_exists_error').text(data.email_exists_error);
            $('.name_error').text(data.name_error);

            console.log(data);
        }
    });
});

$('.auth-btn').click(function (e) {
    e.preventDefault();
    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();

    $.ajax({
        url: '../Controller/LoginUser.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success: function (data) {
            $('.login_exists_error').text(data.login_exists_error);
            $('.password_exists_error').text(data.password_exists_error);

            if (document.cookie.indexOf("login") !== -1) {
                window.location.href = "../pages/Welcome.php";
            }

            console.log(data);
        }
    });
});
