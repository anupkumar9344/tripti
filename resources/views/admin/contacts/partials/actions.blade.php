<a href="{{ route('admin.contacts.show', $contact) }}" class="me-2" title="View">
    <i class="las la-eye text-secondary font-16"></i>
</a>
<form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline js-confirm-delete" data-title="Delete message?" data-text="This contact message will be permanently removed.">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link p-0 border-0" title="Delete">
        <i class="las la-trash-alt text-secondary font-16"></i>
    </button>
</form>
