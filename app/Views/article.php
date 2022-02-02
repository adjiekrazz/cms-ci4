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
                        <?php if(has_permission('read-article')): ?>
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
                        <span>You don't have permissions to view articles.</span>
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

                <?php if(has_permission('create-article')): ?>
                <div class="modal-body">
                    <?= form_open_multipart('article/addArticle', 'id="addData" class="needs-validation"'); ?>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control add-input" id="title" name="title" autocomplete="off">
                            <div id="titleFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="category_id" class="form-label">Category *</label>
                            <select name="category_id" id="category_id" class="custom-select add-input">
                                <option value="">Select Category</option>
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
                            <button name="status" value="draft" class="btn btn-warning">Draft</button>
                            <button name="status" value="publish" class="btn btn-success">Publish</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to add articles.
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
                    <h5 class="modal-title" id="editLabel">Edit Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('update-article')): ?>
                <div class="modal-body">
                    <?= form_open_multipart('article/editArticle', 'id="editData" class="needs-validation"'); ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control add-input" id="title_edit" name="title" autocomplete="off">
                            <div id="titleFeedback" class="form-feedback"></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="category_id" class="form-label">Category *</label>
                            <select name="category_id" id="category_id_edit" class="custom-select add-input">
                                <option value="">Select Category</option>
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
                                <input type="file" class="custom-file-input add-input" id="cover_edit" name="cover" accept=".gif,.jpg,.jpeg,.png">
                            </div>
                            <div id="coverFeedback" class="form-feedback"></div>
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
                            <button name="status" class="btn btn-warning" value="draft">Save As Draft</button>
                            <button name="status" class="btn btn-success" value="publish">Save As Publish</button>
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
                <?php if(has_permission('delete-article')): ?>
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
                        You don't have permissions to delete articles.
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
        let article_table = null;
        let _deleteArticleId = null;
        
        loadArticle();

        $('#content, #content_edit').summernote({ height: 150 });
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
                        let content = escapeHtml(row.content);
                        let a = "'"
                        let s = "', '"
                        let html = '<a href="#editModal" data-toggle="modal" onclick="return showEditArticleModal('+a+row.id+s+row.title+s+row.category_id+s+content+a+')"><span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="Edit Article">Edit</span></a>&nbsp;'
                        html += '<a href="#deleteConfirmationModal" data-toggle="modal" onclick="return deleteConfirm('+a+row.id+s+row.title+a+')"><span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="Delete Article">Delete</span></a>'
                        return html
                    }}
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

            let debounce = new $.fn.dataTable.Debounce(article_table);
        }

        $('#addData').submit(function(e){
            e.preventDefault();
            let status = e.originalEvent.submitter.attributes.value.nodeValue;
            let formData = new FormData(this);
            formData.set('content', $('#content').summernote('code'));
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
                    $('.add-input').val('');
                    toastr.success('Article Added');
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

        function showEditArticleModal(id, title, category, content){
            $('#editModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('input[id="id_edit"]').val(id);
                modal.find('input[id="title_edit"]').val(title);
                modal.find('select[id="category_id_edit"]').val(category);
                modal.find('input[id="content_edit"]').summernote('code', content);
            });
        }

        $('#editData').submit(function(e){
            e.preventDefault();
            let status = e.originalEvent.submitter.attributes.value.nodeValue;
            let formData = new FormData(this);
            formData.set('content', $('#content_edit').summernote('code'));
            formData.append('status', status);

            $.ajax({
                url: 'article/editArticle',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editModal').modal('hide');
                    article_table.ajax.reload();
                    $('.edit-input').val('');
                    toastr.success('Article Updated');
                    $('#content_edit').summernote('code', '');
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
