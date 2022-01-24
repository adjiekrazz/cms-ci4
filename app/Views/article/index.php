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
                <h1>Articles</h1>
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
                                <table id="article_table" class="table table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Created At</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Picture</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#addModal">Add Article</button>
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
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">Add Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('create')): ?>
                <div class="modal-body">
                    <?= form_open_multipart('article/addArticle', 'id="addData" class="needs-validation"'); ?>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control add-input" id="title" name="title" autocomplete="off">
                            <div id="titleFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="category" class="form-label">Category *</label>
                            <select name="category_id" id="category" class="custom-select add-input">
                                <option>Select Category</option>
                                <?php
                                    foreach($categories as $category){
                                        echo "<option value='$category[id]'>$category[name]</option>";
                                    }
                                ?>
                            </select>
                            <div id="category_idFeedback" class="form-feedback"></div>
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
                            <button name="status" class="btn btn-warning" onclick="addArticle('draft')">Draft</button>
                            <button name="status" class="btn btn-success" onclick="addArticle('publish')">Publish</button>
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
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('update')): ?>
                <div class="modal-body">
                    <?= form_open_multipart('article/editArticle', 'id="editData" class="needs-validation"'); ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control edit-input" id="name_edit" name="name" autocomplete="off">
                            <div id="nameEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="slug" class="form-label">Slug *</label>
                            <input type="text" class="form-control edit-input" id="slug_edit" name="slug" autocomplete="off">
                            <div id="slugFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Save Article</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
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
                    <h5 class="modal-title">Delete Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(has_permission('delete')): ?>
                <div class="modal-body target-edited">
                    Are you sure delete this article?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="return deleteArticle()">Delete it!</button>
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
    <script src="<?= base_url('plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
    <script>
        var article_table = null;
        var _deleteArticleId = null;
        
        loadArticle();

        $('#content').summernote({ height: 150 });
        bsCustomFileInput.init();

        function loadArticle(){
            let i = 0;
            article_table = $("#article_table").DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": {
                    "url": "article/getArticles",
                    "type": "POST"
                },
                "columns": [
                    { "render": (data, type, row) => {
                        i++;
                        return i;
                    }},
                    { "data": "created_at" },
                    { "data": "title" },
                    { "data": "author.username" },
                    { "data": "category.name" },
                    { "data": "cover" },
                    { "data": "status" },
                    { "render": (data, type, row) => {
                        var a = "'"
                        var s = "', '"
                        var html = '<a href="#editModal" data-toggle="modal" onclick="return editArticle('+a+row.id+s+row.name+s+row.slug+a+')"><span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="Edit Article">Edit</span></a>&nbsp;'
                        html += '<a href="#deleteConfirmationModal" data-toggle="modal" onclick="return deleteConfirm('+a+row.id+s+row.name+a+')"><span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="Delete Article">Delete</span></a>'
                        return html
                    }}
                ]
            });
            
            $.fn.dataTable.Debounce = function ( table, options ) {
                var tableId = table.settings()[0].sTableId;
                $('.dataTables_filter input[aria-controls="' + tableId + '"]') // select the correct input field
                    .unbind()
                    .bind('input', (delay(function (e) {
                        table.search($(this).val()).draw();
                        return;
                    }, 700)));
                }
            
            function delay(callback, ms) {
                var timer = 0;
                return function () {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }

            var debounce = new $.fn.dataTable.Debounce(article_table);
        }

        function addArticle(status){
            $('#addData').submit(function(e){
                e.preventDefault();
                var fa = $(this);
                var formData = new FormData(this);
                formData.append('status', status);

                $.ajax({
                    url: 'article/addArticle',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#addModal').modal('hide');
                        article_table.ajax.reload();
                        fa[0].reset();
                        $('.add-input').val('');
                        toastr.success('Article Added');
                        $('#content').summernote('code', '');
                    },
                    error: function(response){
                        $('.add-input').closest('input').removeClass('is-invalid')
                        .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                        $.each(response.responseJSON.messages, function(key, value){
                            var element = $('.add-input#' + key);
                            element.closest('input')
                            .removeClass('is-valid')
                            .addClass('is-invalid');

                            $('div#'+ key +'Feedback.form-feedback')
                            .addClass('invalid-feedback').empty().append(value)
                            .removeClass('valid-feedback');
                        });
                    }
                })
            });
        }

        function editArticle(id, name, slug){
            $('#editModal').on('shown.bs.modal', function(event){
                var modal = $(this);
                modal.find('input[id="id_edit"]').val(id)
                modal.find('input[id="name_edit"]').val(name)
                modal.find('input[id="slug_edit"]').val(slug)
            });
        }

        $('#editData').submit(function(e){
            e.preventDefault();
            var fa = $(this);

            $.ajax({
                url: 'article/editArticle',
                type: 'POST',
                data: fa.serialize(),
                dataType: 'JSON',
                success: function(response) {
                    $('#editModal').modal('hide');
                    article_table.ajax.reload();
                    fa[0].reset();
                    $('.edit-input').val('');
                    toastr.success('Article Updated');
                },
                error: function(response){
                    $('.edit-input').closest('input.form-control').removeClass('is-invalid')
                    .addClass('is-valid').find('div.form-feedback').removeClass('invalid-feedback').addClass('valid-feedback')
                    $.each(response.responseJSON.messages, function(key, value){
                        var element = $('.edit-input#' + key +'_edit');
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
                var modal = $(this);
                modal.find('div.target-edited').replaceWith("<div class='modal-body target-edited'>Are you sure delete article " + name + " ?</div>")
            });
            _deleteArticleId = id;
        }

        function deleteArticle(){
            if (_deleteArticleId){
                $.ajax({
                    url: "article/deleteArticle/" + _deleteArticleId,
                    type: "POST",
                    dataType: "JSON",
                    complete: function(response){
                        article_table.ajax.reload();
                        $('#deleteConfirmationModal').modal('hide');
                        toastr.success('Article Deleted');
                    }
                })
            }
        }
    </script>
</body>
</html>
