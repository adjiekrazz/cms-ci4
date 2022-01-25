<!DOCTYPE html>
<html lang="en">
<head>
<?= view('_partials/header') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <?= view('_partials/preloader') ?>
    <?= view('_partials/navbar'); ?>
    <?= view('_partials/sidebar'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-solid">
                            <div class="card-header">
                                <h4>Account Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" readonly value="<?= $user->email ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" readonly value="<?= $user->username ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="registration_date" class="form-label">Registration Date</label>
                                    <input type="text" class="form-control" id="registration_date" readonly value="<?= $user->created_at ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-solid">
                            <div class="card-header">
                                <h4>Change Password</h4>
                            </div>
                            <div class="card-body">
                                <?= form_open('profile/change-password', 'id="changePassword" class="needs-validation"'); ?>
                                    <div class="form-group">
                                        <label for="oldPassword">Old Password</label>
                                        <input type="password" name="old_password" class="form-control cp-input" id="old_password" placeholder="Old Password">
                                        <div id="old_passwordFeedback" class="form-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New Password</label>
                                        <input type="password" name="new_password" class="form-control cp-input" id="new_password" placeholder="New Password">
                                        <div id="new_passwordFeedback" class="form-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="newPasswordConfirmation">New Password Confirmation</label>
                                        <input type="password" name="new_password_confirmation" class="form-control cp-input" id="new_password_confirmation" placeholder="New Password Confirmation">
                                        <div id="new_password_confirmationFeedback" class="form-feedback"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?= view('_partials/footer') ?>
    <?= view('_partials/script') ?>
    <script type="text/javascript">
        $('#changePassword').submit(function(e){
            e.preventDefault();
            let fa = $(this);
            $.ajax({
                url: 'profile/change-password',
                type: 'POST',
                data: fa.serialize(),
                dataType: 'JSON',
                success: function(response) {
                    fa[0].reset();
                    toastr.success('Password changed');
                },
                error: function(response){
                    $('.cp-input').closest('input.form-control').removeClass('is-invalid')
                    .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                    $.each(response.responseJSON.messages, function(key, value){
                        let element = $('.cp-input#' + key);
                        element.closest('input.form-control')
                        .removeClass('is-valid')
                        .addClass('is-invalid');

                        $('div#'+ key +'Feedback.form-feedback')
                        .addClass('invalid-feedback').empty().append(value)
                        .removeClass('valid-feedback');
                    });
                }
            })
        });
    </script>
</body>
</html>
