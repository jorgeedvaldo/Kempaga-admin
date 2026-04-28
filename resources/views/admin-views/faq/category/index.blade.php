{{-- Offcanvas --}}
<div class="navbar-collapse offcanvas-collapse offcanvas-collapse-index">
    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap p-3">
        <h5 class="m-0">{{ translate('category_Setup') }}</h5>
        <button class="navbar-toggler p-0 border-0 offcanvas-close" type="button" data-toggle="offcanvas">
            <i class="tio-clear"></i>
        </button>
    </div>

    <div class="p-3">
        <div class="p-4 bg-fafafa rounded">
            <form id="categoryForm" action="{{ route('admin.faq.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="category_name">{{ translate('Category_Name') }}</label>
                    <input type="text" name="name" class="form-control" id="category_name" placeholder="{{ translate('type_Category_Name') }}" required>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="reset" class="btn btn-secondary min-w-120">{{translate('Reset')}}</button>
                    <button type="submit" class="btn btn-primary min-w-120">{{translate('submit')}}</button>
                </div>
            </form>
        </div>

        <div class="mt-5 search-table">
            <div class="d-flex justify-content-between gap-3 align-items-center flex-wrap mb-3">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="card-header-title">{{ translate('category_List') }}</h5>
                    <span class="badge badge-soft-secondary text-dark category-count"> {{ $categories->count() }}</span>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <form id="category-search-form" method="GET">
                        <div class="input-group overflow-hidden rounded">
                            <input type="search" name="search" class="form-control datatable-search" placeholder="Search category" aria-label="Search" value="" autocomplete="off">
                            <button type="button" class="btn btn-primary px-3 rounded-0 datatable-search"><span class="tio-search"></span></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive table-body__scrolable border rounded overflow-hidden category-table">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" id="faqCategoryTable">
                    <thead class="thead-light">
                        <tr>
                            <th>{{translate('SL')}}</th>
                            <th>{{ translate('category') }}</th>
                            <th>{{ translate('status') }}</th>
                            <th class="text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @include('admin-views.faq.category.partials.table-rows')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" style="z-index: 999999">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <img src="{{ dynamicAsset(path: 'public/assets/admin/svg/components/delete.svg') }}" alt="Delete Icon" style="width: 50px;">
                </div>
                <h4>Are you sure you want to delete this category?</h4>
                <p class="text-muted">Once you delete it, this will permanently remove it from the category list and can't be accessed.</p>
            </div>
            <div class="d-flex justify-content-center gap-3 my-3 flex-wrap">
                <button type="button" id="confirmDelete" class="btn btn-danger">Yes, Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Now</button>
            </div>
        </div>
    </div>
</div>

<!-- Status Change Modal -->
<div class="modal fade" id="categoryStatusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true" style="z-index: 999999">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5 pt-0">
                <div class="max-349 mx-auto">
                    <div>
                        <div class="text-center">
                            <img alt="" class="mb-4" id="icon"
                                 src="{{dynamicAsset(path: 'public/assets/admin-module/img/svg/blocked_customer.svg')}}">
                            <h5 class="modal-title mb-3" id="modalTitle">{{translate("Are you sure?")}}</h5>
                        </div>
                        <div class="text-center mb-4 pb-2">
                            <p id="subTitle">{{translate("Want to change status")}}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-primary min-w-120" id="modalConfirmBtn">{{translate('Ok')}}</button>
                        <button type="button" class="btn btn-secondary min-w-120" id="modalCancelBtn">{{translate('Not Now')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-630" role="document">
        <form action="#" method="post" enctype="multipart/form-data" id="updateCategoryForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h5 class="mb-0">Update Category Setup</h5>
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fs-28">&times;</span></button>
                </div>
                <div class="modal-body px-xxl-5 px-4 pt-2 mb-0 pb-0">
                    <div class="p-4 bg-fafafa rounded">
                        <div class="form-group">
                            <label class="input-label text-capitalize d-flex flex-wrap align-items-center column-gap-2" for="category_name">{{ translate('Category_Name') }}</label>
                            <input type="text" name="name" class="form-control" id="updateCategoryName" placeholder="{{ translate('type_Category_Name') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer gap-2 mt-4 border-0 pt-1 px-xxl-5 px-4 pb-xxl-5 pb-4">
                    <button type="reset" class="btn btn-secondary min-w-120" >{{translate('reset')}}</button>
                    <button type="submit" class="btn btn-primary min-w-120">{{translate('Update')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

