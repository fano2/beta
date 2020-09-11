import $ from 'jquery';

$(function () {
    $("#example1").DataTable({ "responsive": true, "autoWidth": false });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});

//proprietaire
$(document).ready(function () {
    $("table tbody tr td .modif_p").click(function () {
        var dataC = $(this).val();
        $.ajax({
            type: "POST",
            url: "https://localhost:8000/proprietaire/modify-proprietaire/"+dataC,
            data : dataC,
            success: function(data){
                $("#modif_view_p").empty().append(data).fadeIn(0);
            } 
        });
    });

    $("table tbody tr td .delete_p").click(function () {
        var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "https://localhost:8000/proprietaire/confirmDelete/"+id,
                data : id,
                success: function(data){
                    $("#id_p_delete").empty().append(data).fadeIn(0);
                } 
            });
    });
});

//Horse
$(document).ready(function () {
    $("table tbody tr td .modif_h").click(function () {
        var dataC = $(this).val();
        $.ajax({
            type: "POST",
            url: "https://localhost:8000/horse/loadHorse/"+dataC,
            data : dataC,
            success: function(data){
                $("#modif_view_h").empty().append(data).fadeIn(0);
            } 
        });
    });

    $("table tbody tr td .delete_h").click(function () {
        var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "https://localhost:8000/horse/cofirmdeletehorse/"+id,
                data : id,
                success: function(data){
                    $("#id_h_delete").empty().append(data).fadeIn(0);
                } 
            });
    });
});