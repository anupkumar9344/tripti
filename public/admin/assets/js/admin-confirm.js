/**
 * Reusable SweetAlert2 delete confirmation for admin forms.
 *
 * Usage:
 * <form class="js-confirm-delete" data-title="Delete item?" data-text="This cannot be undone.">
 */
document.addEventListener('submit', function (event) {
    const form = event.target.closest('.js-confirm-delete');

    if (!form || form.dataset.confirmed === 'true') {
        return;
    }

    event.preventDefault();

    const swal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-light ms-2',
        },
        buttonsStyling: false,
    });

    swal.fire({
        title: form.dataset.title || 'Are you sure?',
        text: form.dataset.text || "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: form.dataset.confirmText || 'Yes, delete it!',
        cancelButtonText: form.dataset.cancelText || 'Cancel',
        reverseButtons: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            form.dataset.confirmed = 'true';
            form.submit();
        }
    });
});
