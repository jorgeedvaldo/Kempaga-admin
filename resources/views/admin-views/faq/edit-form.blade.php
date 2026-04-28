<div class="modal-header">
    <h5 class="modal-title" id="editFAQModalLabel">
        {{ translate('Edit FAQ') }} (Id #{{ $faq->readable_id }})
    </h5>
    <button type="button" class="close fs-28" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button></div>

<div class="modal-body">
    <form id="editFAQForm" method="POST" action="{{ route('admin.faq.update', $faq->id) }}">
        @csrf

        <div class="form-group">
            <label for="category">{{ translate('Category') }}</label>
            <select class="form-control" id="category" name="category_id">
                <option value="" selected disabled>{{ translate('Select Category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="question">{{ translate('Question') }}<span class="text-danger"> *</span></label>
            <textarea class="form-control" id="question" name="question" rows="3" maxlength="255" required>{{ $faq->question }}</textarea>
        </div>
        <div class="form-group">
            <label for="answer">{{ translate('Answer') }}<span class="text-danger"> *</span></label>
            <textarea class="form-control" id="answer" name="answer" rows="5" maxlength="1000" required>{{ $faq->answer }}</textarea>
        </div>
        <div class="d-flex justify-content-end gap-3 my-3 flex-wrap">
            <button type="reset" class="btn btn-secondary">{{translate('reset')}}</button>
            <button type="submit" class="btn btn-primary demo-form-submit">{{translate('update')}}</button>
        </div>
    </form>

</div>
