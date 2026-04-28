@forelse($categories as $key => $category)
    <tr id="category-row-{{ $category->id }}">
        <td>{{  $loop->iteration }}</td>
        <td>
            <div class="media gap-3 align-items-center text-dark">
                {{ $category->name }}
            </div>
        </td>
        <td>
            <label class="switcher">
                <input type="checkbox" name="status" class="switcher_input change-category-status"
                       data-url="{{route('admin.blog.category.status',$category->id)}}"
                       data-icon="{{ dynamicAsset(path: 'public/assets/admin/svg/components/info.svg')}}"
                       data-title="{{ $category->status == 1 ? translate('Are you sure to turn off the category') . '? ' : translate('Are you sure to turn on the category status?') . '? ' }}"
                       data-sub-title="{{ $category->status == 1 ? translate('Once you turn off, it will not be accessed when selecting the category') : translate('When you turn on this category, It can be accessed and visible for selection') }}"
                       data-confirm-btn="{{ $category->status == 1 ? translate('Yes, Off') : translate('Yes, On') }}"

                    {{ $category->status == 1 ? 'checked' : '' }}>
                <span class="switcher_control"></span>
            </label>
        </td>
        <td>
            <div class="d-flex justify-content-center gap-2">
                <a class="action-btn btn btn-outline-info edit-category-btn"
                   data-url="{{route('admin.blog.category.update',$category->id)}}"
                   data-name="{{$category->name}}"
                   data-toggle="modal" data-target="#editModal">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <button class="action-btn btn btn-outline-danger delete-category-btn" data-id="{{ $category->id }}" data-toggle="modal" data-target="#deleteModal">
                    <i class="tio-add-to-trash"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4">
            <div class="d-flex flex-column gap-2 align-items-center py-8 px-3 rounded">
                <img width="44" class="mb-2" src="{{dynamicAsset(path: 'public/assets/admin/img/media/unavailable.png')}}" alt="{{ translate('unavailable') }}">
                <p class="text-muted">{{ translate('Currently no Blog Category available in this list') }}</p>
            </div>
        </td>
    </tr>
@endforelse
