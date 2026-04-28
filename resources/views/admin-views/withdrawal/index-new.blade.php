@extends('layouts.admin.app')

@section('title', translate('Add_withdrawal_methods'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-4">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/cash-withdrawal.png')}}" alt="{{ translate('withdrawal_method') }}">
            <div class="d-flex align-items-center gap-2">
                <h1 class="page-header-title mb-0">
                    {{translate('Withdrawal Method Add')}}
                </h1>
                <i class="tio-info text-primary cursor-pointer" data-toggle="tooltip" data-placement="top"
                    title="{{translate('Agent/Customer/Merchant will use these methods to withdraw their money directly from admin')}}">
                </i>
            </div>
        </div>

        <form action="{{route('admin.withdrawal_methods.store')}}" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="card card-body mb-3">
                @csrf
                <div class="d-flex align-items-end gap-3 bg-fafafa rounded p-xxl-4 p-3 mb-4">
                    <div class="flex-grow-1">
                        <label class="input-label">{{translate('Method Name')}} <span class="text-danger">*</span></label>
                        <input type="text" maxlength="255" name="method_name" id="method_name" class="form-control" placeholder="Ex: " required>
                    </div>
                    <button type="button" class="btn btn-primary d-none text-nowrap px-3 add-field">{{translate('Add Field')}} <i class="fa fa-plus fs-12"></i></button>
                </div>
                <div class="method-field-demo">
                    <div class="d-flex align-items-center gap-2 flex-wrap justify-content-between mb-3">
                        <h4 class="m-0 text-dark">Input Fields</h4>
                        <button type="button" class="btn btn-primary text-nowrap px-3 add-field-custom add-field">{{translate('Add Field')}} <i class="fa fa-plus fs-12"></i></button>
                    </div>
                    <div class="bg-fafafa rounded p-xxl-4 p-3 text-center method-filed-demo-inner">
                        <p class="mb-3 fs-14 text-pragraph fw-medium">{{translate('Click Add Button to Create')}}</p>
                        <button type="button" class="add-field-stork-btn add-field">
                            {{translate('Add input fileds')}} <i class="fa fa-plus fs-12"></i>
                        </button>
                    </div>
                </div>
                <div id="method-field">

                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="button" class="btn btn-secondary" id="reset">{{translate('Reset')}}</button>
                <button type="submit" class="btn btn-primary">{{translate('Submit')}}</button>
            </div>
        </form>

        <div class="card overflow-hidden">
            <div class="table-responsive datatable-custom">
                <table
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{translate('SL')}}</th>
                        <th>{{translate('Method Name')}}</th>
                        <th>{{translate('Fields')}}</th>
                        <th class="text-center">{{translate('Status')}}</th>
                        <th class="text-center">{{translate('action')}}</th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    @foreach($withdrawalMethods as $key=>$withdrawal_method)
                        <tr>
                            <td>{{$withdrawalMethods->firstitem()+$key}}</td>
                            <td>
                                {{$withdrawal_method['method_name']}}
                            </td>
                            <td>
                                @foreach($withdrawal_method['method_fields'] as $key=>$fields)
                                    <span class="badge badge-pill badge-light">
                                        {{translate('Name') . ': ' . $fields['input_name'] . ' | ' . translate('Type') . ': ' . $fields['input_type'] . ' | ' . translate('Placeholder') . ': ' . $fields['placeholder']}}
                                    </span><br/>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <label class="switcher mx-auto" for="status_2">
                                    <input type="checkbox" name="status" class="switcher_input" id="status_2" checked="">
                                    <span class="switcher_control"></span>
                                </label>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <!-- <button class="action-btn btn btn-outline-danger delete-withdraw-method"
                                            data-id="{{ $withdrawal_method->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button> -->
                                    <div class="dropdown dropdown-custom-wrap">
                                        <button class="action-btn btn btn-outline-primary" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                           <i class="tio-more-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                            <li>
                                                <button type="button" class="btn active p-0 border-0 outline-none text-pragraph fs-14 fw-medium d-flex align-items-center gap-2">
                                                    <i class="tio-checkmark-circle-outlined"></i> Mark As Default
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn p-0 border-0 outline-none text-pragraph fs-14 fw-medium d-flex align-items-center gap-2" data-toggle="modal" data-target="#myModal">
                                                    <i class="tio-visible text-primary"></i> View Details
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn p-0 border-0 outline-none text-pragraph fs-14 fw-medium d-flex align-items-center gap-2">
                                                    <i class="tio-edit theme-clr"></i> Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn p-0 border-0 outline-none text-pragraph fs-14 fw-medium d-flex align-items-center gap-2 delete-withdraw-method"  data-id="{{ $withdrawal_method->id }}">
                                                    <i class="tio-delete text-danger" aria-hidden="true"></i> Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4 px-3">
                <div class="d-flex justify-content-end">
                    {!! $withdrawalMethods->links() !!}
                </div>
            </div>
        </div>
    </div>

 

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fs-28">&times;</span></button>
                </div>
                <div class="modal-body px-xxl-5 px-4 pt-2 mb-0 pb-0">
                    <div class="border rounded mb-20 p-xxl-4 p-3 d-flex align-items-start justify-content-between flex-wrap gap-3">
                        <div>
                            <h2 class="text-uppercase page-header-title text-dark mb-2">BKASH</h2>
                            <p class="fs-12 text-semi-dark mb-1">
                                Created At <span>: 23/12/2024, 3:33 PM</span>
                            </p>
                            <p class="fs-12 text-semi-dark mb-0">
                                Last Modified At <span>: 23/12/2024, 3:33 PM</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded border py-1 px-2 d-flex align-items-center gap-3">
                                <span class="fs-14 text-dark">Status</span>
                                <label class="switcher" for="__status">
                                    <input type="checkbox" name="status" class="switcher_input" id="__status" checked="">
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                            <button type="button" class="action-btn size-32 btn btn-outline-danger border">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="border rounded p-xxl-4 p-3">
                        <h4 class="mb-3 text-dark">Input Field</h4>
                        <div class="d-flex flex-column gap-3">
                            <div class="bg-fafafa rounded p-lg-3 p-2">
                                <h5 class="text-dark mb-md-3 mb-2">Field Type : String</h5>
                                <div class="bg-white rounded p-10px d-flex flex-column gap-1">
                                    <div class="d-flex align-items-cente mx-450-wrap gap-2">
                                        <span class="name__fix text-semi-dark">Name</span>
                                        <span class="fs-14 text-dark">Account Name</span>
                                    </div>
                                    <div class="d-flex align-items-cente mx-450-wrap gap-2">
                                        <span class="name__fix text-semi-dark">Placeholder</span>
                                        <span class="fs-14 text-dark">Enter your card holder name</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-fafafa rounded p-lg-3 p-2">
                                <h5 class="text-dark mb-md-3 mb-2">Field Type : Email</h5>
                                <div class="bg-white rounded p-10px d-flex flex-column gap-1">
                                    <div class="d-flex align-items-cente mx-450-wrap gap-2">
                                        <span class="name__fix text-semi-dark">Name</span>
                                        <span class="fs-14 text-dark">Account Name</span>
                                    </div>
                                    <div class="d-flex align-items-cente mx-450-wrap gap-2">
                                        <span class="name__fix text-semi-dark">Placeholder</span>
                                        <span class="fs-14 text-dark">Enter your card holder name</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer gap-2 mt-5 border-0 pt-0 px-xxl-5 px-4 pb-xxl-5 pb-4">
                    <button type="button" class="btn btn-secondary min-w-120" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary min-w-120">Edit</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script_2')
    <script>
        function delete_input_field(row_id) {
            $( `#field-row--${row_id}` ).remove();
            count--;
        }

        jQuery(document).ready(function ($) {
            count = 1;
            $('.add-field').on('click', function (event) {
                if(count <= 15) {
                    event.preventDefault();

                    $('#method-field').append(
                        `<div class="d-flex position-relative align-items-end gap-3 mb-3 bg-fafafa rounded p-xxl-4 p-3 flex-wrap" id="field-row--${count}">
                            <div class="flex-grow-1">
                                <div>
                                    <label class="input-label">{{translate('Input Field Type')}} </label>
                                    <select class="form-control" name="field_type[]" id="field_type_${count}" required onchange="fieldTypeChange(${count})">
                                        <option value="string">{{translate('String')}}</option>
                                        <option value="number">{{translate('Number')}}</option>
                                        <option value="date">{{translate('Date')}}</option>
                                        <option value="password">{{translate('Password')}}</option>
                                        <option value="email">{{translate('Email')}}</option>
                                        <option value="phone">{{translate('Phone')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <label class="input-label">{{translate('Input Field Name')}} </label>
                                    <input type="text" name="field_name[]" class="form-control" maxlength="255" placeholder="" id="field_name_${count}" required>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <label class="input-label">{{translate('Input Field Placeholder/Hints')}} </label>
                                    <input type="text" name="placeholder[]" class="form-control" maxlength="255" placeholder="" required>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <div class="form-control requird-input-custom d-flex align-items-center gap-1 justify-content-between">
                                        <label class="form-check-label" for="req">
                                           Is Required ?
                                        </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="req" checked>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute right-16 top-0 mt-2 cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{translate('Remove the input field')}}">
                                <div class="border-0 p-0 text-danger" onclick="delete_input_field(${count})">
                                    <i class="tio-clear-circle m-0 p-0 fs-28"></i>
                                </div>
                            </div>
                        </div>`
                    );

                    count++;
                } else {
                    Swal.fire({
                        title: '{{translate('Reached maximum')}}',
                        confirmButtonText: '{{translate('ok')}}',
                    });
                }
            })

            $('#reset').on('click', function (event) {
                $('#method-field').html("");
                $('#method_name').val("");
                count=1;
            })
        });

        $(".delete-withdraw-method").on('click', function (){
            let id = $(this).data('id');

            Swal.fire({
                title: '{{translate('Are you sure')}}?',
                text: "{{translate('You will not be able to revert this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#174F5B',
                cancelButtonColor: '#EA295E',
                confirmButtonText: '{{translate('Yes, delete it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.withdrawal_methods.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{translate('Removed successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        })


        //New code 
        $(document).ready(function () {
            $('.method-filed-demo-inner').removeClass('d-none').addClass('d-block');

            $('.add-field-stork-btn').on('click', function () {
                $(this).closest('.method-filed-demo-inner')
                    .removeClass('d-block')
                    .addClass('d-none');

                $('.add-field-custom').addClass('active');
            });

            $('#reset').on('click', function () {
                $('.method-filed-demo-inner').removeClass('d-none').addClass('d-block');
                $('.add-field-custom').removeClass('active');
            });
        });


    </script>
@endpush

