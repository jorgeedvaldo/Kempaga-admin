<div class="modal-body p-5 p-lg-7">
    <button type="button" class="close position-absolute right-16 top-16" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="border rounded p-3">
        <div class="d-flex justify-content-between gap-3 flex-wrap">
            <h5 class="fs-20">
                {{ translate('FAQ') }} ({{ translate('Id') }} #{{ $faq->readable_id }})
            </h5>

        </div>
        <div class="d-flex justify-content-between gap-3 my-3 flex-wrap">
            <p class="mb-0">{{ translate('Created At') }} : {{ $faq->created_at->format('d/m/Y, h:i A') }}</p>
            <p class="mb-0">{{ translate('Last Modified At') }} : {{ $faq->updated_at->format('d/m/Y, h:i A') }}</p>
        </div>
    </div>



    <div class="bg-light my-3 d-flex align-items-center gap-2 p-3 rounded">
        <div>{{ translate('Category') }} :</div>
        <div class="{{ $faq->category_id ? ($faq->faqCategory ?  '' : 'badge badge-danger text-white p-2' ): 'fs-16' }}">{{ $faq->category_id ? ($faq->faqCategory ?  $faq->faqCategory->name : translate('Category Deleted')) : '-' }}</div>
    </div>

    <div class="border rounded p-3">
        <h4 class="fs-20">{{ $faq->question }}</h4>
        <p>{{ $faq->answer }}</p>
    </div>
</div>
