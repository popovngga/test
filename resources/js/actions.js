window.handleSubmitButtonOnClick = function(button) {
    button.disabled = true;
    button.closest('form').submit();
};

document.addEventListener('DOMContentLoaded', () => {
    const expiresAt = document.querySelector('meta[name="token-expires-at"]')?.content;

    if (!expiresAt) return;

    const expiresTimestamp = parseInt(expiresAt) * 1000;
    const now = Date.now();
    const msLeft = expiresTimestamp - now;

    if (msLeft <= 0) {
        logoutUser();
        return;
    }

    setTimeout(logoutUser, msLeft);

    function logoutUser() {
        window.location.href = '/logout';
    }
});
