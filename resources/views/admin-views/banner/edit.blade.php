@extends('layouts.admin.app')

@section('title', translate('Update Banner'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-3">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/banner.png')}}" alt="{{ translate('banner') }}">
            <h2 class="page-header-title">{{translate('Update Banner')}}</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.banner.update',[$banner['id']])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('title')}}</label>
                                <input type="text" name="title" class="form-control" placeholder="{{translate('title')}}" value="{{$banner['title']}}" required>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{translate('URL')}}</label>
                                <input type="text" name="url" class="form-control" placeholder="{{translate('URL')}}" value="{{$banner['url']}}"  required>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{translate('receiver')}}</label>
                                <select name="receiver" class="form-control js-select2-custom" id="receiver">
                                    <option value="" selected disabled>{{translate('Update receiver')}}</option>
                                    <option value="all" {{$banner->receiver == 'all' ? 'selected' : ''}}>{{translate('All')}}</option>
                                    <option value="customers" {{$banner->receiver == 'customers' ? 'selected' : ''}}>{{translate('Customers')}}</option>
                                    <option value="agents" {{$banner->receiver == 'agents' ? 'selected' : ''}}>{{translate('Agents')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <label class="text-dark mb-0">{{ translate('banner_Image') }}<span class="text-danger"> *</span></label>

                                    <p>{{ implode(', ', array_column(IMAGE_EXTENSIONS, 'key')) }} : Max {{ readableUploadMaxFileSize('image') }}
                                        <strong class="text-dark font-weight-bold">(3:1)</strong>
                                    </p>
                                    <div class="upload-file new auto profile-image-upload-file">
                                        <!-- Edit -->
                                        <button type="button" class="upload-file__edit-btn btn rounded-circle btn-outline-primary"
                                                aria-label="add file">
                                            <i class="tio-edit"></i>
                                        </button>
                                        <!-- Edit End -->
                                        <input type="file" name="image" class="upload-file__input"
                                               accept=".{{ implode(',.', array_column(IMAGE_EXTENSIONS, 'key')) }}"
                                               data-maxFileSize="{{ readableUploadMaxFileSize('image') }}"
                                            {{$banner->image ? '' : 'required'}}>
                                        <div
                                            class="upload-file__img banner border-gray d-flex justify-content-center align-items-center mw-100 w-450 h-150 p-0 bg-light">
                                            <div class="upload-file__textbox text-center">
                                                <img height="34" src="{{dynamicAsset(path: 'public/assets/admin/img/upload.svg')}}" alt=""
                                                     class="svg ratio-2">
                                                <h6 class="mt-2 fw-semibold">
                                                    <span class="text-info">{{ translate('Click to upload') }}</span>
                                                    <br>
                                                    {{ translate('or drag and drop') }}
                                                </h6>
                                            </div>
                                            <img src="{{$banner['image_fullpath']}}" class="upload-file__img__img h-100 ratio-2" width="180" height="180" loading="lazy" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 justify-content-end">
                        <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                        <button type="submit" class="btn btn-primary">{{translate('update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{dynamicAsset(path: 'public/assets/admin/js/image-upload.js')}}"></script>
@endpush
