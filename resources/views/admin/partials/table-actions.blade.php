@php
    $viewTitle = $viewTitle ?? 'View';
    $editTitle = $editTitle ?? 'Edit';
    $deleteTitle = $deleteTitle ?? 'Delete item?';
    $deleteText = $deleteText ?? 'This item will be permanently removed.';
@endphp

<div class="admin-table-actions">
    @if (!empty($viewUrl))
        <a href="{{ $viewUrl }}" class="btn btn-sm btn-outline-primary" title="{{ $viewTitle }}" @if (!empty($viewTarget)) target="{{ $viewTarget }}" @endif>
            <i class="las la-eye"></i>
        </a>
    @endif

    @if (!empty($editUrl))
        <a href="{{ $editUrl }}" class="btn btn-sm btn-outline-secondary" title="{{ $editTitle }}">
            <i class="las la-pen"></i>
        </a>
    @endif

    @if (!empty($deleteUrl))
        <form action="{{ $deleteUrl }}" method="POST" class="js-confirm-delete" data-title="{{ $deleteTitle }}" data-text="{{ $deleteText }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                <i class="las la-trash-alt"></i>
            </button>
        </form>
    @endif
</div>
