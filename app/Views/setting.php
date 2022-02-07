<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('_partials/header') ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <?= view('_partials/preloader') ?>
    <?= view('_partials/navbar') ?>
    <?= view('_partials/sidebar') ?>

    <div class="content-wrapper">
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Settings</h1>
            </div>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <?php if(has_permission('read-setting')): ?>
                                <?= form_open_multipart('setting/editSetting', 'id="editData" class="needs-validation"'); ?>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="site_name" class="form-label">Site Name *</label>
                                        <input type="text" class="form-control add-input" id="site_name" name="site_name" autocomplete="off" value="<?= $setting->site_name ?>">
                                        <div id="site_nameFeedback" class="form-feedback"></div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="site_logo">Site Logo</label>
                                        <div class="custom-file">
                                            <label for="site_logo" class="custom-file-label">Select Logo..</label>
                                            <input type="file" class="custom-file-input edit-input" id="site_logo" name="site_logo" accept=".gif,.jpg,.jpeg,.png">
                                        </div>
                                        <div id="coverFeedback" class="form-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="site_description" class="form-label">Site Description</label>
                                        <input type="text" class="form-control edit-input" id="site_description" name="site_description" autocomplete="off" value="<?= $setting->site_description ?>">
                                        <div id="site_descriptionFeedback" class="form-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="facebook_link" class="form-label">Facebook Link</label>
                                        <input type="text" class="form-control edit-input" id="facebook_link" name="facebook_link" autocomplete="off" value="<?= $setting->facebook_link ?>">
                                        <div id="facebook_linkFeedback" class="form-feedback"></div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="twitter_link" class="form-label">Twitter Link</label>
                                        <input type="text" class="form-control edit-input" id="twitter_link" name="twitter_link" autocomplete="off" value="<?= $setting->twitter_link ?>">
                                        <div id="twitter_linkFeedback" class="form-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="instagram_link" class="form-label">Instagram Link</label>
                                        <input type="text" class="form-control edit-input" id="instagram_link" name="instagram_link" autocomplete="off" value="<?= $setting->instagram_link ?>">
                                        <div id="instagram_linkFeedback" class="form-feedback"></div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="github_link" class="form-label">Github Link</label>
                                        <input type="text" class="form-control edit-input" id="github_link" name="github_link" autocomplete="off" value="<?= $setting->github_link ?>">
                                        <div id="github_linkFeedback" class="form-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-sm btn-primary btn-block">Save Setting</button>
                                    </div>
                                </div>
                                <?= form_close() ?>
                                <?php else: ?>
                                <span>You don't have permissions to view settings.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img width="100%" src="<?= $setting->site_logo ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?= view('_partials/footer') ?>
    <?= view('_partials/script') ?>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
    <script>
        $('#editData').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'setting/editSetting',
                type: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success('Setting Updated');
                },
                error: function(response){
                    if (response.status == 403)
                        toastr.error(response.responseJSON.messages.error)
                    $('.edit-input').closest('input.form-control').removeClass('is-invalid')
                    .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                    $.each(response.responseJSON.messages, function(key, value){
                        let element = $('.edit-input#' + key +'_edit');
                        element.closest('input.form-control')
                        .removeClass('is-valid')
                        .addClass('is-invalid');

                        $('div#'+ key +'EditFeedback.form-feedback')
                        .addClass('invalid-feedback').empty().append(value)
                        .removeClass('valid-feedback');
                    });
                }
            })
        });
    </script>
</body>
</html>
