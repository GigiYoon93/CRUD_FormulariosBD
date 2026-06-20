
let modalLoaded = false;

document.getElementById('myModal').addEventListener('click', function () {
    if (!modalLoaded) {
        fetch('./includes/modals/modal-producto.html')
            .then(response => {
                if (!response.ok) throw new Error('No se pudo cargar el modal');
                return response.text();
            })
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                modalLoaded = true;
                const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                modal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar el modal.');
            });
    } else {
        const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        modal.show();
    }
});
