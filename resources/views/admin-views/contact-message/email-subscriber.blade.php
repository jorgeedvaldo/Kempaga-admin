@extends('layouts.admin.app')

@section('title', translate('Subscribed Emails'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-3">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/banner.png')}}" alt="{{ translate('message') }}">
            <h2 class="page-header-title">{{translate('Subscribed Emails')}}</h2>
        </div>

        <div class="card">
            <div class="card-header __wrap-gap-10 flex-between">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="card-header-title">{{translate('Subscribed Emails Table')}}</h5>
                    <span class="badge badge-soft-secondary text-dark">{{ $subscribers->total() }}</span>
                </div>
                <div class="flex-between __wrap-gap-10 align-items-center">
                    <div>
                        <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-expanded="true">
                            <i class="tio-download-to"></i>
                            {{translate('Export')}}
                            <i class="tio-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{route('admin.export-subscribed-emails', ['search'=>$search])}}">
                                    <img width="20" src="{{dynamicAsset(path: 'public/assets/admin/img/media/excel.png')}}" alt="{{ translate('excel') }}">
                                    <span>{{ translate('excel') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <form action="{{url()->current()}}" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search"
                                       class="form-control mn-md-w280"
                                       placeholder="{{translate('Search by Email')}}" aria-label="Search"
                                       value="{{$search}}" required autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">{{translate('Search')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{translate('SL')}}</th>
                        <th>{{translate('name')}}</th>
                        <th>{{translate('Subscribed At')}}</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($subscribers as $key => $subscriber)
                        <tr>
                            <td>{{$subscribers->firstitem()+$key}}</td>
                            <td>
                                {{Str::limit($subscriber['email'],50,'...')}}
                            </td>
                            <td>{{date('d M Y h:m A '.config('timeformat'), strtotime($subscriber->created_at))}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4 px-3">
                <div class="d-flex justify-content-end">
                    {!! $subscribers->links() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        "use strict";

        $(".delete-contact-message").on('click', function (){
            let id =  $(this).data('id')

            Swal.fire({
                title: '{{translate('Are you sure delete this message')}}?',
                text: "{{translate('You will not be able to revert this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#014F5B',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{translate('Yes, delete it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.contact.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{translate('Contact message delete successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        })
    </script>
@endpush
