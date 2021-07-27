@extends('templates/base-layout')

@section('title', 'Ajax Operations')

@section('body')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ajax Operations</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @include('templates.includes.messages')
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Products (Pagination is under process)</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target=".modal">Add Product</button>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Model Name</th>
                                        <th width="10%">Description</th>
                                        <th>Featured</th>
                                        <th>Availability</th>
                                        <th>Status (Active)</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="products-data">
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-2">
                            <div id="pagination">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->


{{-- MOdals --}}

<!--  Modal content for the above example -->
<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="add-product-form" action="{{ route('ajax.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="modal">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Enter Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Enter product name" value="">
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Enter Brand Name</label>
                                <input type="text" class="form-control" id="brand" name="brand"
                                    placeholder="Enter brand name" value="">
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Enter Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="Enter price" value="">
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="model_name" class="form-label">Enter Model Name</label>
                                <input type="text" class="form-control" id="model_name" name="model_name"
                                    placeholder="Enter model name" value="">
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Select Featured</label>
                                <select class="form-select" name="featured" id="featured">
                                    <option selected value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Select Availability</label>
                                <select class="form-select" name="available" id="available">
                                    <option selected value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Select Status</label>
                                <select class="form-select" name="active_flag" id="active_flag">
                                    <option selected value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <div class="invalid-feedback">
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Enter Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        <div class="invalid-feedback">
                            <strong></strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection


@section('js')

<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{ asset('assets/js/axios-helper.js') }}"></script>
<script>
    const modal = document.getElementById('formModal');
    const modalInstance = new bootstrap.Modal(modal);
    const fields = ['id', 'product_name', 'brand', 'price', 'model_name', 'description', 'featured', 'available', 'active_flag', 'created_at', 'actions'];
    const form = document.getElementById('add-product-form');
    const modalTitle = document.querySelector('.modal-title');
    const submitBtn = form.querySelector('button[type="submit"]');

    document.addEventListener('DOMContentLoaded', function () {
        getProducts()
    });

    // Get All Products
    const getProducts = (searchTerm = '') => {
        getRequest(`${baseUrl}/ajax/get-products`)
        .then(res => {
            const appendTo = document.getElementById('products-data');
            appendTo.innerHTML = '';
            createTrAndAppend(res.data.data, appendTo);
            handlePagination(res.data);
        })
        .catch(res => {
            showMessage('Something went wrong!', 'error')
        });
    }

    // Add Product
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        let isUpdate = document.getElementById('product-id') ? true : false;

        submitBtn.innerText = 'Working ...';
        submitBtn.disabled = true;

        if (isUpdate) {
            // Update Product
            let productId = document.getElementById('product-id').value;
            postRequest(`${baseUrl}/ajax/${productId}`, formData)
            .then(res => {
                submitBtn.disabled = false;
                modalInstance.hide();
                getProducts();
                showMessage(res.data.message);
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Update Product';
                appendErrorMessages(error.response.data);
                showMessage('validation Error', 'error');
            });
        } else {
            // Add Product
            postRequest(`${baseUrl}/ajax/store`, formData)
            .then(res => {
                submitBtn.disabled = false;
                modalInstance.hide();
                getProducts();
                showMessage(res.data.message);
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Add Product';
                appendErrorMessages(error.response.data);
                showMessage('validation Error', 'error');
            });
        }

    })

    const showProduct = id => {
        alert(id)
    }

    // Get Product
    const editProduct = id => {
        const url = `${baseUrl}/ajax/${id}/edit`;
        getRequest(url)
        .then(res => {
            appendDataToModal(res.data);
            modalInstance.show();
        })
        .catch(res => {
            showMessage('Something went wrong!', 'error');
        });
    }

    // Delete Product
    const deleteProduct = id => {
        if(!confirm('Are you sure !')) return;

        const url = `${baseUrl}/ajax/${id}`;
        params = {
            '_token': csrfToken,
            '_method': 'DELETE'
        }
        postRequest(url, params)
        .then(res => {
            getProducts();
            showMessage(res.data.message);
        })
        .catch(error => {
            showMessage(error.response.data.message, 'error');
        });
    }

    const appendDataToModal = product => {

        modalTitle.innerText = 'Edit Product';
        submitBtn.innerText = 'Update Product';

        form.appendChild(createInputElement('hidden', '_method', 'PATCH', 'request-method'));
        form.appendChild(createInputElement('hidden', 'product_id', product.id, 'product-id'));

        for(let field of fields) {
            if (field !== 'id' && field !== 'actions' && field !== 'created_at') {
                let element = document.getElementById(field)
                if (element.type === 'select-one') {
                    for(let option of element.options) {
                        if (option.value === product[field].toLowerCase()) {
                            option.selected = true;
                        }
                    }
                } else {
                    element.value = product[field];
                }
            }
        }
    }

    const resetModalForm = () => {
        modalTitle.innerText = 'Add Product';
        submitBtn.innerText = 'Add Product';

        let requestMethod = document.getElementById("request-method")
        if (document.contains(requestMethod)) {
            requestMethod.remove();
        }

        let productId = document.getElementById("product-id")
        if (document.contains(productId)) {
            productId.remove();
        }
        clearErrorMessages();
        form.reset();
    }

    modal.addEventListener('hidden.bs.modal', function (event) {
        resetModalForm();
    })

    const createInputElement = (type, name, value, id) => {
        const element = document.createElement('input');
        element.type = type;
        element.name = name;
        element.value = value;
        element.id = id;

        return element;
    }

    const clearErrorMessages = () => {
        Array.from(document.querySelectorAll('.form-select.is-invalid')).forEach((el) => el.classList.remove('is-invalid'));
        Array.from(document.querySelectorAll('.form-control.is-invalid')).forEach((el) => el.classList.remove('is-invalid'));
        return;
    }

    const appendErrorMessages = errors => {
        for(let error in errors) {
            let element = document.getElementById(error);
            element.classList.add('is-invalid');
            element.nextElementSibling.children[0].innerHTML = errors[error][0];
        }
        return;
    }

    const createTrAndAppend = (data, element) => {
        for(let product of data) {
            let tr = document.createElement('tr');
            for(let field of fields) {
                if (field === 'actions') {
                    tr.appendChild(createActionsTd(product.id))
                } else {
                    tr.appendChild(createTd(product[field]));
                }
            }
            element.appendChild(tr);
        }
    }

    const createTd = value => {
        const td = document.createElement('td');
        td.innerHTML = value;
        return td;
    }

    const createActionsTd = value => {

        const td = document.createElement('td');

        const showLink = document.createElement('a');
        showLink.classList.add('btn', 'btn-info');
        showLink.href = 'javascript:void(0)';
        showLink.onclick = (function(value){
            return function (){
                showProduct(value);
            }
        })(value);

        const showLinkIcon = document.createElement('i');
        showLinkIcon.classList.add('fas', 'fa-eye');
        // showLinkIcon.setAttribute('aria-hidden', true);

        showLink.appendChild(showLinkIcon)
        td.appendChild(showLink);


        const editLink = document.createElement('a');
        editLink.classList.add('btn', 'btn-success');
        editLink.href = 'javascript:void(0)';
        editLink.onclick = (function(value){
            return function (){
                editProduct(value);
            }
        })(value);

        let editLinkIcon = document.createElement('i');
        editLinkIcon.classList.add('fas', 'fa-edit');
        // editLinkIcon.setAttribute('aria-hidden', true);

        editLink.appendChild(editLinkIcon)
        td.appendChild(editLink);

        let deleteLink = document.createElement('a');
        deleteLink.classList.add('btn', 'btn-danger');
        deleteLink.href = 'javascript:void(0)';
        deleteLink.onclick = (function(value){
            return function (){
                deleteProduct(value);
            }
        })(value);

        let deleteLinkIcon = document.createElement('i');
        deleteLinkIcon.classList.add('fas', 'fa-trash');
        // deleteLinkIcon.setAttribute('aria-hidden', true);

        deleteLink.appendChild(deleteLinkIcon);
        td.appendChild(deleteLink);

        return td
    }

    const handlePagination = result => {
        console.log(result);

        let paginationTemplate = `<nav>`;
        paginationTemplate += `<ul class="pagination">`;


        let links = '';

        for(link of result.links) {

            let label = link.label;

            if (label.includes('Previous')) {
                if (result.prev_page_url) {
                    links += `
                        <li class="page-item">
                            <a class="page-link" href="${result.prev_page_url}" rel="prev" aria-label="« Previous">›</a>
                        </li>`;
                } else {
                    links += `
                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                            <span class="page-link" aria-hidden="true">‹</span>
                        </li>`;
                }
            } else if (label.includes('Next')) {
                if (result.next_page_url) {
                    links += `
                        <li class="page-item">
                            <a class="page-link" href="${result.next_page_url}" rel="next" aria-label="Next »">›</a>
                        </li>`;
                } else {
                    links += `
                        <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                            <span class="page-link" aria-hidden="true">‹</span>
                        </li>`;
                }
            } else {
                if (link.active) {
                    links += `<li class="page-item active" aria-current="page"><span class="page-link">${link.label}</span></li>`;
                } else {
                    links += `<li class="page-item"><a class="page-link" href="${link.url}">${link.label}</a></li>`;
                }
            }

        }

        paginationTemplate += links;


        paginationTemplate += '</ul>';
        paginationTemplate += '</nav>';

        let paginationElement = document.getElementById('pagination');

        paginationElement.insertAdjacentHTML('beforeend', paginationTemplate);

        return true;

    }

</script>
@endsection
