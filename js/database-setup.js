$(document).ready(function() {
    $('#file-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
        },
        "order": [], // Désactiver le tri par défaut si nécessaire
        "columnDefs": [{
            "targets": [3], // Index de la colonne Actions
            "orderable": false, // Désactiver le tri pour cette colonne
            "searchable": false // Désactiver la recherche pour cette colonne
        }]
    });
});
