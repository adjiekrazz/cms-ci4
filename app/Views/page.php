<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('_partials/header') ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/summernote/summernote-bs4.min.css') ?>">
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
                <h1>Pages</h1>
            </div>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <?php if(has_permission('read-page')): ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <table id="page_table" class="table table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Slug</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#addModal">Add Page</button>
                            </div>
                        </div>
                        <?php else: ?>
                        <span>You don't have permissions to view pages.</span>
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
                    <h5 class="modal-title" id="addLabel">Add Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('create-page')): ?>
                <div class="modal-body">
                    <?= form_open('page/addPage', 'id="addData" class="needs-validation"'); ?>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name" class="form-label">Title *</label>
                            <input type="text" class="form-control add-input" id="title" name="title" autocomplete="off">
                            <div id="titleFeedback" class="form-feedback"></div>
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
                            <button type="submit" class="btn btn-success">Publish Page</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to add pages.
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
                    <h5 class="modal-title" id="editLabel">Edit Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('update-page')): ?>
                <div class="modal-body">
                    <?= form_open('page/editPage', 'id="editData" class="needs-validation"'); ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name" class="form-label">Title *</label>
                            <input type="text" class="form-control edit-input" id="title_edit" name="title" autocomplete="off">
                            <div id="titleEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="content" class="form-label">Content *</label>
                            <input type="text" class="form-control add-input" id="content_edit" name="content" autocomplete="off">
                            <div id="contentFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Save Page</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>                        
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to edit pages.
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
                    <h5 class="modal-title">Delete Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(has_permission('delete-page')): ?>
                <div class="modal-body target-edited">
                    Are you sure delete this page?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="return deletePage()">Delete it!</button>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to delete pages.
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
    <script>
        let page_table = null;
        let _deletePageId = null;
        
        loadPage();
        $('#content, #content_edit').summernote({ height: 150 });

        function loadPage(){
            page_table = $("#page_table").DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": {
                    "url": "page/getPages",
                    "type": "POST"
                },
                "columns": [
                    { "render": (data, type, row, meta) => {
                        return meta.row + 1;
                    }},
                    { "data": "title" },
                    { "data": "slug" },
                    { "render": function(data, type, row){
                        let content = escapeHtml(row.content);
                        let a = "'"
                        let s = "', '"
                        let html = '<a href="#editModal" data-toggle="modal" onclick="return editPage('+a+row.id+s+row.title+s+content+a+')"><span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="Edit Page">Edit</span></a>&nbsp;'
                        html += '<a href="#deleteConfirmationModal" data-toggle="modal" onclick="return deleteConfirm('+a+row.id+s+row.title+a+')"><span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="Delete Page">Delete</span></a>'
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

            let debounce = new $.fn.dataTable.Debounce(page_table);
        }

        $('#addData').submit(function(e){
            e.preventDefault();
            let fa = $(this);
            let formData = new FormData(this);
            formData.set('content', $('#content').summernote('code'));

            $.ajax({
                url: 'page/addPage',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addModal').modal('hide');
                    page_table.ajax.reload();
                    fa[0].reset();
                    $('.add-input').val('');
                    toastr.success('Page Added');
                },
                error: function(response){
                    $('.add-input').closest('input.form-control').removeClass('is-invalid')
                    .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                    $.each(response.responseJSON.messages, function(key, value){
                        let element = $('.add-input#' + key);
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

        function editPage(id, title, content){
            $('#editModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('input[id="id_edit"]').val(id)
                modal.find('input[id="title_edit"]').val(title)
                modal.find('input[id="content_edit"]').summernote('code', content)
            });
        }

        $('#editData').submit(function(e){
            e.preventDefault();
            let fa = $(this);
            let formData = new FormData(this);
            formData.set('content', $('#content_edit').summernote('code'));

            $.ajax({
                url: 'page/editPage',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editModal').modal('hide');
                    page_table.ajax.reload();
                    fa[0].reset();
                    $('.edit-input').val('');
                    toastr.success('Page Updated');
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
                modal.find('div.target-edited').replaceWith("<div class='modal-body target-edited'>Are you sure delete page " + name + " ?</div>")
            });
            _deletePageId = id;
        }

        function deletePage(){
            if (_deletePageId){
                $.ajax({
                    url: "page/deletePage/" + _deletePageId,
                    type: "POST",
                    dataType: "JSON",
                    complete: function(response){
                        page_table.ajax.reload();
                        $('#deleteConfirmationModal').modal('hide');
                        toastr.success('Page Deleted');
                    }
                })
            }
        }
    </script>
</body>
</html>
