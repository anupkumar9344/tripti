@include('admin.partials.table-actions', [
    'viewUrl' => route('admin.contacts.show', $contact),
    'viewTitle' => 'View',
    'deleteUrl' => route('admin.contacts.destroy', $contact),
    'deleteTitle' => 'Delete message?',
    'deleteText' => 'This contact message will be permanently removed.',
])
