@extends('layouts.admin.app')

@section('title', translate('FAQ Priority Setup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
            <div class="d-flex align-items-center gap-3 pb-2">
                <img width="24" src="{{dynamicAsset(path: 'public/assets/admin/img/media/faq.svg')}}" alt="{{ translate('FAQ Priority Setup') }}">
                <h2 class="page-header-title">{{translate('priority_Setup')}}</h2>
            </div>
        </div>

        <div class="inline-page-menu my-4">
            <ul class="list-unstyled">
                <li class=""><a href="{{route('admin.faq.index')}}">{{translate('FAQ Page Setup')}}</a></li>
                <li class=""><a href="{{route('admin.faq.download')}}">{{translate('Download Button')}}</a></li>
                <li class="active"><a href="{{route('admin.faq.priority')}}">{{translate('Priority Setup')}}</a></li>
            </ul>
        </div>


        <form action="{{ route('admin.business-settings.update-business-setting-data') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h3>{{ translate('Categories') }}</h3>
                            <p>{{ translate('To set up and display the category list for an admin, website & app viewers, the admin manages categories with sorting and visibility options, while the website and app provide user-friendly navigation with sorting.') }}</p>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">{{ translate('Category sorting list') }}</h4>
                                </div>
                                <div class="card-body">
                                    @php($categoryPriority = \App\CentralLogics\helpers::get_business_settings('faq_category_priority_type'))
                                    <div class="d-flex flex-column gap-2">
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_category_priority_type" value="latest" {{ $categoryPriority == 'latest' ? 'checked' : '' }}>
                                            <span>{{ translate('Default') }} ({{ translate('Show Latest First') }})</span>
                                        </label>
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_category_priority_type" value="popularity" {{ $categoryPriority == 'popularity' ? 'checked' : '' }}>
                                            <span>{{ translate('Popularity') }} ({{ translate('Show Most Clicked First') }}) </span>
                                        </label>
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_category_priority_type" value="a_to_z" {{ $categoryPriority == 'a_to_z' ? 'checked' : '' }}>
                                            <span>{{ translate('Sort by Alphabetical') }} ({{ translate('A To Z') }})</span>
                                        </label>
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_category_priority_type"  value="z_to_a" {{ $categoryPriority == 'z_to_a' ? 'checked' : '' }}>
                                            <span>{{ translate('Sort by Alphabetical') }} ({{ translate('Z To A') }})</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-4">
                            <h3>{{ translate('FAQ List') }}</h3>
                            <p>{{ translate('To set up and display the FAQ list for an admin & website & app viewers, the admin manages FAQs with sorting options, while the website and app provide user-friendly navigation with sorting.') }}</p>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">{{ translate('FAQ sorting list') }}</h4>
                                </div>
                                <div class="card-body">
                                    @php($faqPriority = \App\CentralLogics\helpers::get_business_settings('faq_priority_type'))
                                    <div class="d-flex flex-column gap-2">
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_priority_type" value="latest" {{ $faqPriority == 'latest' ? 'checked' : '' }}>
                                            <span>{{ translate('Default') }} ({{ translate('Show Latest First') }})</span>
                                        </label>
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_priority_type" value="a_to_z" {{ $faqPriority == 'a_to_z' ? 'checked' : '' }}>
                                            <span>{{ translate('Sort by Alphabetical') }} ({{ translate('A To Z') }})</span>
                                        </label>
                                        <label class="d-flex gap-2 align-items-center">
                                            <input type="radio" name="faq_priority_type" value="z_to_a" {{ $faqPriority == 'z_to_a' ? 'checked' : '' }}>
                                            <span>{{ translate('Sort by Alphabetical') }} ({{ translate('Z To A') }})</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary demo-form-submit">{{translate('save')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

