window.handleSubmitButtonOnClick = function(button) {
    button.disabled = true;
    button.closest('form').submit();
};

window.copyLink = function (button, text) {
    const onCopySuccess = (btn) => {
        btn.textContent = 'Copied';
        setTimeout(() => {
            btn.textContent = 'Copy Link';
        }, 2000);
    };

    navigator.clipboard
        .writeText(text)
        .then(() => onCopySuccess(button));
}
