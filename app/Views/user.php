<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('_partials/header') ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
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
                <h1>Users</h1>
            </div>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <?php if(has_permission('read')): ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <table id="user_table" class="table table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Group</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#addModal">Add User</button>
                            </div>
                        </div>
                        <?php else: ?>
                        <span>You don't have permissions to view resources.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addModal" role="dialog" arial-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('create')): ?>
                <div class="modal-body">
                    <?= form_open('user/addUser', 'id="addData" class="needs-validation"'); ?>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username" class="form-label">Username *</label>
                            <input type="text" class="form-control add-input" id="username" name="username" autocomplete="off">
                            <div id="usernameFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="text" class="form-control add-input" id="email" name="email" autocomplete="off">
                            <div id="emailFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" class="form-control add-input" id="password" name="password" autocomplete="off">
                            <div id="passwordFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="password_confirmation" class="form-label">Password Confirmation *</label>
                            <input type="password" class="form-control add-input" id="password_confirmation" name="password_confirmation" autocomplete="off">
                            <div id="password_confirmationFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="auth_groups" class="form-label">Roles</label>
                            <div class="select2-purple">
                                <select class="form-control select2 add-input" multiple="multiple" id="auth_groups" name="auth_groups" data-dropdown-css-class="select2-purple" style="width:100%">
                                    <?php 
                                        foreach($auth_groups as $group){
                                            echo "<option value='$group->id'>$group->name</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div id="auth_groupsFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Create User</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to add resources.
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" role="dialog" arial-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(has_permission('update')): ?>
                <div class="modal-body">
                    <?= form_open('user/editUser', 'id="editData" class="needs-validation"'); ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username_edit" class="form-label">Username *</label>
                            <input type="text" class="form-control edit-input" id="username_edit" name="username" autocomplete="off">
                            <div id="usernameEditFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="email_edit" class="form-label">Email *</label>
                            <input type="text" class="form-control edit-input" id="email_edit" name="email" autocomplete="off">
                            <div id="emailEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password_edit" class="form-label">Password*</label>
                            <input type="password" class="form-control edit-input" id="password_edit" name="password" autocomplete="off">
                            <div id="passwordEditFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="password_confirmation_edit" class="form-label">Password Confirmation *</label>
                            <input type="password" class="form-control edit-input" id="password_confirmation_edit" name="password_confirmation" autocomplete="off">
                            <div id="password_confirmationEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="auth_groups_edit" class="form-label">Roles</label>
                            <div class="select2-purple">
                                <select class="form-control select2 edit-input" multiple="multiple" id="auth_groups_edit" name="auth_groups" data-dropdown-css-class="select2-purple" style="width:100%">
                                    <?php 
                                        foreach($auth_groups as $group){
                                            echo "<option value='$group->id'>$group->name</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div id="auth_groupsEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Update User</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to edit resources.
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" role="dialog" arial-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(has_permission('delete')): ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 target-edited">
                            Are you sure delete this user?
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Transfer articles ownership to :</label>
                            <div class="select2-purple">
                                <select class="form-control select2bs4" id="transfer_ownership" data-dropdown-css-class="select2-purple" style="width:100%">
                                    <?php 
                                        foreach($users as $user){
                                            echo "<option value='$user->id'>$user->username</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="return deleteUser()">Delete it!</button>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to delete resources.
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
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
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js') ?>"></script>
    <script>
        let user_table = null;
        let _deleteUserId = null;
        
        loadUser();
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        function loadUser(){
            user_table = $("#user_table").DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": {
                    "url": "user/getUsers",
                    "type": "POST"
                },
                "columns": [
                    { "data": "username" },
                    { "data": "email" },
                    { "render": (data, type, row) => {
                        let roles = [];
                        Object.keys(row.roles).forEach((key) => {
                            roles.push(row.roles[key]);
                        })
                        return roles.join(', ');
                    }},
                    { "render": (data, type, row) => {
                        return new Date(row.created_at.date).toLocaleDateString('id-ID') + ' ' + new Date(row.created_at.date).toLocaleTimeString('en-GB');
                    } },
                    { "render": (data, type, row) => {
                        let roles = [];
                        Object.keys(row.roles).forEach((key) => {
                            roles.push(key);
                        })
                        let a = "'"
                        let s = "', '"
                        let html = '<a href="#editModal" data-toggle="modal" onclick="return editUser('+a+row.id+s+row.username+s+row.email+s+roles+a+')"><span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="Edit User">Edit</span></a>&nbsp;'
                        if (row.id != <?= user()->id ?>){
                            html += '<a href="#deleteConfirmationModal" data-toggle="modal" onclick="return deleteConfirm('+a+row.id+s+row.username+a+')"><span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="Delete User">Delete</span></a>'
                        }
                        return html
                    } }
                ]
            });
            
            $.fn.dataTable.Debounce = function ( table, options ) {
                let tableId = table.settings()[0].sTableId;
                $('.dataTables_filter input[aria-controls="' + tableId + '"]') // select the correct input field
                    .unbind()
                    .bind('input', (delay(function (e) {
                        table.search($(this).val()).draw();
                        return;
                    }, 700)));
                }
            
            function delay(callback, ms) {
                let timer = 0;
                return function () {
                    let context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }

            let debounce = new $.fn.dataTable.Debounce(user_table);
        }

        $('#addData').submit(function(e){
            e.preventDefault();
            let fa = $(this);
            let formData = new FormData(this);
            formData.set('auth_groups', $('#auth_groups').select2('val'));

            $.ajax({
                url: 'user/addUser',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addModal').modal('hide');
                    user_table.ajax.reload();
                    fa[0].reset();
                    $('.add-input').val('');
                    $('.select2#auth_groups').val(null).trigger('change');
                    toastr.success('User Added');
                },
                error: function(response){
                    $('.add-input').closest('input, select').removeClass('is-invalid')
                    .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                    $.each(response.responseJSON.messages, function(key, value){
                        let element = $('.add-input#' + key);
                        element.closest('input, select')
                        .removeClass('is-valid')
                        .addClass('is-invalid');

                        $('div#'+ key +'Feedback.form-feedback')
                        .addClass('invalid-feedback').empty().append(value)
                        .removeClass('valid-feedback');
                    });
                }
            })
        });

        function editUser(id, username, email, roles){
            let arrayRoles = roles.split(',');
            $('#editModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('input[id="id_edit"]').val(id);
                modal.find('input[id="username_edit"]').val(username);
                modal.find('input[id="email_edit"]').val(email);
                modal.find('select[id="auth_groups_edit"]').val(arrayRoles).trigger('change');
            });
        }

        $('#editData').submit(function(e){
            e.preventDefault();
            let fa = $(this);
            let formData = new FormData(this);
            formData.set('auth_groups', $('#auth_groups_edit').select2('val'));
            formData.delete('email');
            formData.delete('username');

            $.ajax({
                url: 'user/editUser',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editModal').modal('hide');
                    user_table.ajax.reload();
                    fa[0].reset();
                    $('.edit-input').val('');
                    $('.select2#auth_groups_edit').val(null).trigger('change');
                    toastr.success('User Updated');
                },
                error: function(response){
                    $('.edit-input').closest('input, select').removeClass('is-invalid')
                    .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                    $.each(response.responseJSON.messages, function(key, value){
                        let element = $('.edit-input#' + key +'_edit');
                        element.closest('input, select')
                        .removeClass('is-valid')
                        .addClass('is-invalid');

                        $('div#'+ key +'EditFeedback.form-feedback')
                        .addClass('invalid-feedback').empty().append(value)
                        .removeClass('valid-feedback');
                    });
                }
            })
        });

        function deleteConfirm(id, name){
            $('#deleteConfirmationModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('div.target-edited').replaceWith("<div class='col-md-12 target-edited'>Are you sure delete user " + name + " ?</div>")
            });
            _deleteUserId = id;
        }

        function deleteUser(){
            if (_deleteUserId){
                let formData = {
                    'transfer_ownership': $('#transfer_ownership').select2('val')
                };

                $.ajax({
                    url: "user/deleteUser/" + _deleteUserId,
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    success: function(response){
                        user_table.ajax.reload();
                        $('#deleteConfirmationModal').modal('hide');
                        toastr.success('User Deleted');
                    },
                    error: (response) => {
                        if (response.status == 400)
                            toastr.error(response.responseJSON.messages.error)
                    }
                })
            }
        }
    </script>
</body>
</html>
