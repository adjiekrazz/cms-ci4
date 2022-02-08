<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('_partials/header') ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/summernote/summernote-bs4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
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
                <h1>Portfolios</h1>
            </div>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <?php if(has_permission('read-portfolio')): ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <table id="portfolio_table" class="table table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Cover</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#addModal">Add Portfolio</button>
                            </div>
                        </div>
                        <?php else: ?>
                        <span>You don't have permissions to view portfolios.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addModal" role="dialog" arial-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">Add Portfolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('create-portfolio')): ?>
                <div class="modal-body">
                    <?= form_open_multipart('portfolio/addPortfolio', 'id="addData" class="needs-validation"'); ?>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control add-input" id="title" name="title" autocomplete="off">
                            <div id="titleFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Date</label>
                            <div class="input-group date" id="date" data-target-input="nearest">
                                <input type="text" name="date" id="date" class="form-control datetimepicker-input add-input" data-target="#date"/>
                                <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div id="dateFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Cover Picture</label>
                            <div class="custom-file">
                                <label for="cover" class="custom-file-label">Select Picture..</label>
                                <input type="file" class="custom-file-input add-input" id="cover" name="cover" accept=".gif,.jpg,.jpeg,.png">
                            </div>
                            <div id="coverFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="content" class="form-label">Content *</label>
                            <input type="text" class="form-control add-input" id="content" name="content" autocomplete="off">
                            <div id="contentFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Add Portfolio</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to add portfolios.
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" role="dialog" arial-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit Portfolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('update-portfolio')): ?>
                <div class="modal-body">
                    <?= form_open('portfolio/editPortfolio', 'id="editData" class="needs-validation"'); ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control edit-input" id="title_edit" name="title" autocomplete="off">
                            <div id="titleEditFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Date</label>
                            <div class="input-group date" id="date_edit" data-target-input="nearest">
                                <input type="text" name="date" id="date_edit" class="form-control datetimepicker-input edit-input" data-target="#date_edit"/>
                                <div class="input-group-append" data-target="#date_edit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div id="dateEditFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Cover Picture</label>
                            <div class="custom-file">
                                <label for="cover" class="custom-file-label">Select Picture..</label>
                                <input type="file" class="custom-file-input add-input" id="cover_edit" name="cover" accept=".gif,.jpg,.jpeg,.png">
                            </div>
                            <div id="coverEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="content" class="form-label">Content *</label>
                            <input type="text" class="form-control add-input" id="content_edit" name="content" autocomplete="off">
                            <div id="contentEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Save Portfolio</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>                        
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to edit portfolios.
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
                    <h5 class="modal-title">Delete Portfolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(has_permission('delete-portfolio')): ?>
                <div class="modal-body target-edited">
                    Are you sure delete this portfolio?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="return deletePortfolio()">Delete it!</button>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to delete portfolios.
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
    <script src="<?= base_url('plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
    <script src="<?= base_url('plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <script>
        let portfolio_table = null;
        let _deletePortfolioId = null;
        
        $('#content, #content_edit').summernote({ height: 150 });
        $('#date, #date_edit').datetimepicker({
            format: 'L',
        });
        loadPortfolio();

        function loadPortfolio(){
            portfolio_table = $("#portfolio_table").DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": {
                    "url": "portfolio/getPortfolios",
                    "type": "POST"
                },
                "order": [[1, 'asc']],
                "columnDefs": [
                    { "width": 25, "targets": 0},
                    { "orderable": false, "targets": [0, 3, 4]}
                ],
                "columns": [
                    { "render": (data, type, row, meta) => {
                        return meta.row + 1;
                    }},
                    { "data": "date" },
                    { "data": "title" },
                    { "data": "slug" },
                    { "render": (data, type, row) => {
                        return '<img width="150" height="150" src="' + row.cover + '" />';
                    }},
                    { "render": function(data, type, row){
                        let content = escapeHtml(row.content);
                        let a = "'"
                        let s = "', '"
                        let html = '<a href="#editModal" data-toggle="modal" onclick="return editPortfolio('+a+row.id+s+row.title+s+content+s+row.date+a+')"><span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="Edit Portfolio">Edit</span></a>&nbsp;'
                        html += '<a href="#deleteConfirmationModal" data-toggle="modal" onclick="return deleteConfirm('+a+row.id+s+row.title+a+')"><span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="Delete Portfolio">Delete</span></a>'
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

            let debounce = new $.fn.dataTable.Debounce(portfolio_table);
        }

        $('#addData').submit(function(e){
            e.preventDefault();
            let date = $('#date').datetimepicker('viewDate');
            let formData = new FormData(this);
            formData.set('content', $('#content').summernote('code'));
            formData.set('date', moment(date).format('YYYY-MM-DD'));

            $.ajax({
                url: 'portfolio/addPortfolio',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addModal').modal('hide');
                    portfolio_table.ajax.reload();
                    $('.add-input').val('');
                    toastr.success('Portfolio Added');
                    $('#content').summernote('code', '');
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

        function editPortfolio(id, title, content, date){
            $('#editModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('input[id="id_edit"]').val(id)
                modal.find('input[id="title_edit"]').val(title)
                modal.find('input[id="content_edit"]').summernote('code', content);
                modal.find('input[id="date_edit"]').val(date)
            });
        }

        $('#editData').submit(function(e){
            e.preventDefault();
            let date = $('#date_edit').datetimepicker('viewDate');
            let formData = new FormData(this);
            formData.set('content', $('#content_edit').summernote('code'));
            formData.set('date', moment(date).format('YYYY-MM-DD'));

            $.ajax({
                url: 'portfolio/editPortfolio',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editModal').modal('hide');
                    portfolio_table.ajax.reload();
                    $('.edit-input').val('');
                    toastr.success('Portfolio Updated');
                    $('#content').summernote('code', '');
                },
                error: function(response){
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

        function deleteConfirm(id, name){
            $('#deleteConfirmationModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('div.target-edited').replaceWith("<div class='modal-body target-edited'>Are you sure delete portfolio " + name + " ?</div>")
            });
            _deletePortfolioId = id;
        }

        function deletePortfolio(){
            if (_deletePortfolioId){
                $.ajax({
                    url: "portfolio/deletePortfolio/" + _deletePortfolioId,
                    type: "POST",
                    dataType: "JSON",
                    complete: function(response){
                        portfolio_table.ajax.reload();
                        $('#deleteConfirmationModal').modal('hide');
                        toastr.success('Portfolio Deleted');
                    }
                })
            }
        }
    </script>
</body>
</html>
