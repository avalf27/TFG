document.addEventListener('DOMContentLoaded', function () {
    const favoritoButton = document.getElementById('favoritoButton');
    const favoritoForm = document.getElementById('favoritoForm');

    if (favoritoButton) {
        favoritoButton.addEventListener('click', function (e) {
            e.preventDefault();
            favoritoForm.submit();
        });
    }
});
