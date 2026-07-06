@include('admin.partials.table-actions', [
    'permissionPrefix' => 'contacts',
    'viewUrl' => route('admin.contacts.show', $contact),
    'viewTitle' => 'View',
    'deleteUrl' => route('admin.contacts.destroy', $contact),
    'deleteTitle' => 'Delete message?',
    'deleteText' => 'This contact message will be permanently removed.',
])
