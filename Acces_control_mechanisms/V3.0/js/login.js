document.addEventListener('DOMContentLoaded', function() {
    fetch('../procesos/check_season.php')
        .then(response => {
            if (response.status === 403) {
                window.location.href = '../vistas/index.html';
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
                window.location.href = '../vistas/index.html';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.location.href = '../vistas/index.html';
        });
});