document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    fetch('traitement_upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('csvDisplay').innerHTML = data;
        // Après upload, récupère l'ID du fichier
        let fileId = data.match(/ID du fichier: (\d+)/)[1]; // Assurez-vous que votre réponse contient l'ID
        saveLastViewedFileId(fileId);
    })
    .catch(error => console.error('Error:', error));
});

function saveLastViewedFileId(fileId) {
    fetch('save_last_viewed_file.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ file_id: fileId })
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}
