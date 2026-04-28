@extends('layouts.admin.app')

@section('title', translate('Verification List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="d-flex align-items-center gap-3 mb-3">
            <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/rating.png')}}" alt="{{ translate('customer') }}">
            <h2 class="page-header-title">{{translate('Customers')}}</h2>
        </div>

        <div class="card">
            <div class="card-header __wrap-gap-10">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="card-header-title">{{translate('Verification requests list')}}</h5>
                    <span class="badge badge-soft-secondary text-dark">{{ $customers->total() }}</span>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <form action="{{url()->current()}}" method="GET">
                        <div class="input-group">
                            <input id="datatableSearch_" type="search" name="search"
                                   class="form-control mn-md-w280"
                                   placeholder="{{translate('Search by Name')}}" aria-label="Search"
                                   value="{{$search}}" required autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{translate('Search')}}</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('admin.customer.add')}}" class="btn btn-primary">
                        <i class="tio-add"></i> {{translate('Add')}} {{translate('Customer')}}
                    </a>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table with-100-percent">
                    <thead class="thead-light">
                    <tr>
                        <th>{{translate('SL')}}</th>
                        <th>{{translate('name')}}</th>
                        <th>{{translate('contact')}}</th>
                        <th>{{translate('Identification Type')}}</th>
                        <th>{{translate('Identification Number')}}</th>
                        <th>{{translate('Identification Image')}}</th>
                        <th class="text-center">{{translate('action')}}</th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    @foreach($customers as $key=>$customer)
                        <tr>
                            <td>{{$customers->firstitem()+$key}}</td>
                            <td>
                                <a class="media gap-3 align-items-center text-dark" href="{{route('admin.customer.view',[$customer['id']])}}">
                                    <div class="avatar avatar-lg border rounded-circle">
                                        <img class="rounded-circle img-fit"
                                        src="{{$customer['image_fullpath']}}"
                                        alt="{{ translate('customer') }}">
                                    </div>
                                    <div class="media-body">
                                        {{$customer['f_name'].' '.$customer['l_name']}}
                                    </div>
                                </a>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <a href="tel:{{$customer['phone']}}" class="text-dark">{{$customer['phone']}}</a>
                                    @if(isset($customer['email']))
                                        <a class="text-dark" href="mailto:{{ $customer['email'] }}" class="text-primary">{{ $customer['email'] }}</a>
                                    @else
                                        <span class="badge badge-soft-danger text-danger">{{ translate('Email unavailable') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if(isset($customer['identification_type']))
                                    {{translate($customer['identification_type'])}}
                                @else
                                    <span class="badge badge-soft-danger text-danger">{{ translate('Type unavailable') }}</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($customer['identification_number']))
                                    {{ $customer['identification_number']  }}
                                @else
                                    <span class="badge badge-soft-danger text-danger">{{ translate('Number unavailable') }}</span>
                                @endif
                            </td>

                            <td>
                                @if ($customer['identification_image_fullpath'])
                                    <div class="identification-image-wrap">
                                        @foreach ($customer['identification_image_fullpath'] as $identificationImage)
                                            <div class="identification-image-slide">
                                                <img class="rounded cursor-pointer" src="{{ $identificationImage }}"
                                                     alt="{{ translate('identity-image') }}"
                                                     data-path="{{ $identificationImage }}">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge badge-soft-danger">{{ translate('Image unavailable') }}</span>
                                @endif
                            </td>

                            <td>
                                <div  class="d-flex justify-content-center gap-2">
                                    <a class="action-btn btn btn-outline-primary"
                                    href="{{route('admin.customer.view',[$customer['id']])}}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    @if($customer['is_kyc_verified'] == 0)
                                        <a class="action-btn btn btn-outline-success"
                                        href="{{route('admin.customer.kyc_status_update',[$customer['id'], 1])}}">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </a>
                                        <a class="action-btn btn btn-outline-danger"
                                        href="{{route('admin.customer.kyc_status_update',[$customer['id'], 2])}}">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    @elseif($customer['is_kyc_verified'] == 2)
                                        <span class="badge badge-soft-danger"> {{translate('Denied')}}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4 px-3">
                <div class="d-flex justify-content-end">
                    {!! $customers->links() !!}
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" id="identification_image_view_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div data-dismiss="modal">
                                <img alt="{{ translate('identity-image') }}"
                                     class="with-100-percent" id="identification_image_element">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg position-relative">
            <div class="modal-content text-center p-0">
                <div class="modal-body position-relative p-0">
                    <div class="d-flex align-items-center justify-content-between mb-2 px-3 py-2">
                        <h5 class="img_name text-white mb-0"></h5>
                        <button type="button" class="btn-close bg-transparent border-0 fs-24 p-0 btn-close-white"
                                data-dismiss="modal" aria-label="Close">
                            <i class="tio-clear"></i>
                        </button>
                    </div>

                    <div class="mx-4 max-height-700px">
                        <img id="preview-image" src="" class="img-fluid rounded user-select-none" alt="preview">
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-3 text-white px-3 pb-4">
                        <button
                            class="btn p-0 imagePreview_cmn_btn d-flex align-items-center justify-content-center btn-prev"><i
                                class="tio-chevron-left"></i></button>
                        <span id="image-counter"></span>
                        <button
                            class="btn p-0 imagePreview_cmn_btn d-flex align-items-center justify-content-center btn-next"><i
                                class="tio-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";

        // Image preview modal logic
        $(document).ready(function() {
            $('.identification-image-wrap').each(function() {
                const $wrap = $(this);
                const slides = $wrap.find('.identification-image-slide');
                const total = slides.length;

                // Hide extra slides
                if (total > 2) {
                    slides.slice(2).addClass('d-none');
                    const extraCount = total - 2;
                    slides.eq(1)
                        .addClass('overlay')
                        .attr('data-count', '+' + extraCount);
                }

                // Click event for any image
                slides.on('click', function() {
                    const allImages = $wrap.find(
                        '.identification-image-slide img'); // include hidden ones
                    let currentIndex = $(this).index();

                    const $previewImg = $('#preview-image');
                    const $counter = $('#image-counter');
                    const $imgName = $('.img_name');
                    const totalCount = allImages.length;

                    function showImage(index) {
                        const $img = $(allImages[index]);
                        const newSrc = $img.attr('data-path') || $img.attr('src');
                        const imgPath = newSrc.split('/').pop(); // extract image name
                        $previewImg.attr('src', newSrc);
                        $imgName.text(imgPath); // update name
                        $counter.text((index + 1) + ' / ' + totalCount);
                    }

                    // Show first clicked image
                    showImage(currentIndex);

                    function updateNavButtons() {
                        if (currentIndex <= 0) {
                            $('.btn-prev').prop('disabled', true);
                        } else {
                            $('.btn-prev').prop('disabled', false);
                        }

                        if (currentIndex >= totalCount - 1) {
                            $('.btn-next').prop('disabled', true);
                        } else {
                            $('.btn-next').prop('disabled', false);
                        }
                    }

                    updateNavButtons();

                    // Navigation
                    $('.btn-prev').off('click').on('click', function() {
                        if (currentIndex > 0) {
                            currentIndex--;
                            showImage(currentIndex);
                        }
                        updateNavButtons();
                    });

                    $('.btn-next').off('click').on('click', function() {
                        if (currentIndex < totalCount - 1) {
                            currentIndex++;
                            showImage(currentIndex);
                        }
                        updateNavButtons();
                    });


                    // Show modal
                    $('#imagePreviewModal').modal('show');
                });
            });
        });
    </script>
@endpush
