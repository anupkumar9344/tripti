/**
 * Reusable SweetAlert2 confirmation for admin forms.
 *
 * Usage:
 * <form class="js-confirm-delete" data-title="Delete item?" data-text="This cannot be undone.">
 * <form class="js-confirm-logout" data-title="Log out?" data-text="Are you sure you want to end your session?">
 */
document.addEventListener('submit', function (event) {
    const form = event.target.closest('.js-confirm-delete, .js-confirm-logout');

    if (!form || form.dataset.confirmed === 'true') {
        return;
    }

    event.preventDefault();

    const isLogout = form.classList.contains('js-confirm-logout');

    const swal = Swal.mixin({
        customClass: {
            confirmButton: isLogout ? 'btn btn-primary' : 'btn btn-danger',
            cancelButton: 'btn btn-light ms-2',
        },
        buttonsStyling: false,
    });

    swal.fire({
        title: form.dataset.title || (isLogout ? 'Log out?' : 'Are you sure?'),
        text: form.dataset.text || (isLogout ? 'Are you sure you want to end your session?' : "You won't be able to revert this!"),
        icon: isLogout ? 'question' : 'warning',
        showCancelButton: true,
        confirmButtonText: form.dataset.confirmText || (isLogout ? 'Yes, log out' : 'Yes, delete it!'),
        cancelButtonText: form.dataset.cancelText || 'Cancel',
        reverseButtons: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            form.dataset.confirmed = 'true';
            form.submit();
        }
    });
});
