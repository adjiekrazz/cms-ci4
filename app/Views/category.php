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
                <h1>Categories</h1>
            </div>
            </div>
        </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <?php if(has_permission('read-category')): ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <table id="category_table" class="table table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#addModal">Add Category</button>
                            </div>
                        </div>
                        <?php else: ?>
                        <span>You don't have permissions to view categories.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addModal" role="dialog" arial-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('create-category')): ?>
                <div class="modal-body">
                    <?= form_open('category/addCategory', 'id="addData" class="needs-validation"'); ?>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control add-input" id="name" name="name" autocomplete="off">
                            <div id="nameFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Add Category</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to add categories.
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
                    <h5 class="modal-title" id="editLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if(has_permission('update-category')): ?>
                <div class="modal-body">
                    <?= form_open('category/editCategory', 'id="editData" class="needs-validation"'); ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control edit-input" id="name_edit" name="name" autocomplete="off">
                            <div id="nameEditFeedback" class="form-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Save Category</button>
                            <button type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </div>                        
                    <?= form_close() ?>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to edit categories.
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
                    <h5 class="modal-title">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(has_permission('delete-category')): ?>
                <div class="modal-body target-edited">
                    Are you sure delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="return deleteCategory()">Delete it!</button>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="modal-text">
                        You don't have permissions to delete categories.
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
    <script>
        let category_table = null;
        let _deleteCategoryId = null;
        
        loadCategory();

        function loadCategory(){
            category_table = $("#category_table").DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": {
                    "url": "category/getCategories",
                    "type": "POST"
                },
                "order": [[1, 'asc']],
                "columnDefs": [
                    { "width": 25, "targets": 0},
                    { "orderable": false, "targets": [0, 2, 3]}
                ],
                "columns": [
                    { "render": (data, type, row, meta) => {
                        return meta.row + 1;
                    }},
                    { "data": "name" },
                    { "data": "slug" },
                    { "render": function(data, type, row){
                        let a = "'"
                        let s = "', '"
                        let html = '<a href="#editModal" data-toggle="modal" onclick="return editCategory('+a+row.id+s+row.name+s+row.slug+a+')"><span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="Edit Category">Edit</span></a>&nbsp;'
                        html += '<a href="#deleteConfirmationModal" data-toggle="modal" onclick="return deleteConfirm('+a+row.id+s+row.name+a+')"><span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="Delete Category">Delete</span></a>'
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

            let debounce = new $.fn.dataTable.Debounce(category_table);
        }

        $('#addData').submit(function(e){
            e.preventDefault();
            let fa = $(this);

            $.ajax({
                url: 'category/addCategory',
                type: 'POST',
                data: fa.serialize(),
                dataType: 'JSON',
                success: function(response) {
                    $('#addModal').modal('hide');
                    category_table.ajax.reload();
                    fa[0].reset();
                    $('.add-input').val('');
                    toastr.success('Category Added');
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

        function editCategory(id, name, slug){
            $('#editModal').on('shown.bs.modal', function(event){
                let modal = $(this);
                modal.find('input[id="id_edit"]').val(id)
                modal.find('input[id="name_edit"]').val(name)
                modal.find('input[id="slug_edit"]').val(slug)
            });
        }

        $('#editData').submit(function(e){
            e.preventDefault();
            let fa = $(this);

            $.ajax({
                url: 'category/editCategory',
                type: 'POST',
                data: fa.serialize(),
                dataType: 'JSON',
                success: function(response) {
                    $('#editModal').modal('hide');
                    category_table.ajax.reload();
                    fa[0].reset();
                    $('.edit-input').val('');
                    toastr.success('Category Updated');
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
                modal.find('div.target-edited').replaceWith("<div class='modal-body target-edited'>Are you sure delete category " + name + " ?</div>")
            });
            _deleteCategoryId = id;
        }

        function deleteCategory(){
            if (_deleteCategoryId){
                $.ajax({
                    url: "category/deleteCategory/" + _deleteCategoryId,
                    type: "POST",
                    dataType: "JSON",
                    complete: function(response){
                        category_table.ajax.reload();
                        $('#deleteConfirmationModal').modal('hide');
                        toastr.success('Category Deleted');
                    }
                })
            }
        }
    </script>
</body>
</html>
