@foreach ($categories as $category)
    <tr class="child-category   @if ($category->children->isNotEmpty())  @endif" data-id="{{ $category->id }}"
        data-parent-id="{{ $parentId }}" style="display: none;">
        <th scope="row" class="ps-{{ $level * 3 }}">
            <div class="form-check ps-5">
                <input class="form-check-input fs-15 chk_child" type="checkbox" name="chk_child[]"
                    value="{{ $category->id }}" />
            </div>
        </th>
        <td>{{ $parentIndex }}.{{ $loop->iteration }}</td>
        <td>{!! str_repeat('&mdash; ', $level) !!} {{ $category->name }}</td>
        <td>
            @if (!empty($category->description))
                {{ Str::limit($category->description, 50, '...') }}
            @else
                N/A
            @endif
        </td>
        <td>
            <span
                class="badge {{ $category->status == 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} text-uppercase">
                {{ $category->status == 'Active' ? 'Active' : 'Inactive' }}
            </span>
        </td>
        <td>
            <div class="dropdown d-inline-block">

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="#!" class="dropdown-item view-item-btn" data-id="{{ $category->id }}"
                            data-url="{{ route('categories.show', $category->id) }}">
                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                            View
                        </a>
                    </li>
                    <li> <a href="#!" class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                            data-bs-target="#editModal" data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}" data-description="{{ $category->description }}"
                            data-parent-id="{{ $parentId }}"
                            @if ($category->parent) data-grandparent-id="{{ $category->parent->parent_id }}" @endif
                            data-url="{{ route('categories.update', $category->id) }}"
                            data-status="{{ $category->status }}">
                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                            Edit
                        </a>
                    </li>




                    <li>
                        <a href="#!" class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteRecordModal" data-id="{{ $category->id }}"
                            data-url="{{ route('categories.destroy', $category->id) }}">
                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                            Delete
                        </a>
                    </li>
                </ul>
                <button class="btn btn-soft-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown">
                    <i class="ri-more-fill align-middle"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <!-- Action Buttons (View, Edit, Delete) -->
                @if ($category->children->isNotEmpty())
                    <button class="btn btn-soft-secondary btn-sm toggle-category" type="button"
                        data-id="{{ $category->id }}">
                        <i class="ri-arrow-up-s-line rotate-icon"></i>
                    </button>
                @endif
            </div>
        </td>
    </tr>

    <!-- Include Grandchild Categories -->
    @if ($category->children->isNotEmpty())
        @include('admin.categories.partials.category-table', [
            'categories' => $category->children,
            'parentIndex' => $parentIndex . '.' . $loop->iteration,
            'level' => $level + 1,
            'parentId' => $category->id,
        ])

        <style>
            tr {
                background: "000"
            }
        </style>
    @endif
@endforeach
