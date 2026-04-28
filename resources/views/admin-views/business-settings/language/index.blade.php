@extends('layouts.admin.app')

@section('title', translate('Language'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 pb-2">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/business-setup.png')}}" alt="{{translate('business_setup')}}">
            <h2 class="page-header-title">{{translate('Business Setup')}}</h2>
        </div>

        <div class="inline-page-menu my-4">
            @include('admin-views.business-settings.partial._business-setup-tabs')
        </div>

        <div class="alert alert-danger mb-3" role="alert">
            {{translate('changing_some_settings_will_take_time_to_show_effect_please_clear_session_or_wait_for_60_minutes_else_browse_from_incognito_mode')}}
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{translate('language_table')}}</h5>
                <button class="btn btn-primary" data-toggle="modal"
                        data-target="#lang-modal">
                    <i class="tio-add"></i>
                    <span class="text">{{translate('add_new_language')}}</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('SL')}}</th>
                            <th>{{translate('name')}}</th>
                            <th>{{translate('Code')}}</th>
                            <th class="text-center">{{translate('status')}}</th>
                            <th class="text-center">{{translate('default')}} {{translate('status')}}</th>
                            <th class="text-center">{{translate('action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($language = App\CentralLogics\Helpers::get_business_settings('language'))
                    @if(isset($language))
                        @foreach($language as $key =>$data)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data['name']}}
                                </td>
                                <td>{{$data['code']}}</td>
                                <td class="text-center">
                                    <label class="switcher mx-auto">
                                        <input type="checkbox"
                                               data-route="{{route('admin.business-settings.language.update-status')}}"
                                               data-code="{{$data['code']}}"
                                                class="switcher_input language-status-change" {{$data['status']==1?'checked':''}}>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="switcher mx-auto">
                                        <input type="checkbox"
                                               data-route="{{route('admin.business-settings.language.update-default-status', ['code'=>$data['code']])}}"
                                                class="switcher_input change-status" {{ ((array_key_exists('default', $data) && $data['default']==true) ? 'checked': ((array_key_exists('default', $data) && $data['default']==false) ? '' : 'disabled')) }}>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        @if($data['code']!='en')
                                            <a href="#" class="action-btn btn btn-outline-primary" data-toggle="modal"
                                                data-target="#lang-modal-update-{{$data['code']}}">
                                                <i class="tio-edit" aria-hidden="true"></i>
                                            </a>
                                            @if($data['default'] != true)
                                                <button class="action-btn btn btn-outline-danger delete-language" id="delete"
                                                        data-route="{{ route('admin.business-settings.language.delete',[$data['code']]) }}">
                                                    <i class="tio-add-to-trash" aria-hidden="true"></i>
                                                </button>
                                            @endif
                                        @endif
                                        <a class="action-btn btn btn-outline-info"
                                            href="{{route('admin.business-settings.language.translate',[$data['code']])}}">
                                            <i class="tio-book-outlined"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="lang-modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom pb-3">
                        <h5 class="mb-0" id="exampleModalLabel">{{translate('new_language')}}</h5>
                        <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.business-settings.language.add-new')}}" method="post"
                          style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name">{{translate('language')}} </label>
                                <input type="text" class="form-control" id="recipient-name" name="name" required>
                            </div>
                            <div class="">
                                <label for="message-text">{{translate('country_code')}}</label>
                                <select class="form-control js-select2-custom w-100" name="code">
                                    <option value="en">English</option>
                                    <option value="pt">Portuguese - português</option>
                                    <option value="pt-BR">Portuguese (Brazil) - português (Brasil)</option>
                                    <option value="pt-PT">Portuguese (Portugal) - português (Portugal)</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('close')}}</button>
                            <button type="submit" class="btn btn-primary">{{translate('Add')}} <i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(isset($language))
            @foreach($language as $key =>$data)
                <div class="modal fade" id="lang-modal-update-{{$data['code']}}" tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom pb-3">
                                <h5 class="mb-0"
                                    id="exampleModalLabel">{{translate('update_language')}}</h5>
                                <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.business-settings.language.update')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name">{{translate('language')}} </label>
                                        <input type="text" class="form-control" value="{{$data['name']}}" name="name" required>
                                    </div>
                                    <div class="">
                                        <label for="message-text">{{translate('country_code')}}</label>
                                        <span></span>
                                        <select class="form-control w-100" name="code">
                                            <option value="en" {{ $data['code'] == 'en' ? 'selected' : 'style=display:none' }}>English</option>
                                            <option value="pt" {{ $data['code'] == 'pt' ? 'selected' : 'style=display:none' }}>Portuguese - português</option>
                                            <option value="pt-BR" {{ $data['code'] == 'pt-BR' ? 'selected' : 'style=display:none' }}>Portuguese (Brazil) - português (Brasil)</option>
                                            <option value="pt-PT" {{ $data['code'] == 'pt-PT' ? 'selected' : 'style=display:none' }}>Portuguese (Portugal) - português (Portugal)</option>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" value="{{$data['status']}}" name="status">
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{translate('close')}}</button>
                                    <button type="submit"
                                            class="btn btn-primary">{{translate('update')}}
                                        <i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@push('script_2')

    <script>
        "use strict";

        $(".language-status-change").on('click', function () {
            let route = $(this).data('route');
            let code = $(this).data('code');
            $.get({
                url: route,
                data: {
                    code: code,
                },
                success: function (data) {

                }
            });
        });

        $(".delete-language").on('click', function (){
            let route = $(this).data('route');

            Swal.fire({
                title: '{{translate('Are you sure to delete this')}}?',
                text: "{{translate('You will not be able to revert this')}}!",
                showCancelButton: true,
                confirmButtonColor: 'primary',
                cancelButtonColor: 'secondary',
                confirmButtonText: '{{translate('Yes, delete it')}}!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = route;
                }
            })
        })
    </script>

@endpush
