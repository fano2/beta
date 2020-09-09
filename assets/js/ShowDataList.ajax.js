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

$(document).ready(function () {
    $("#btn_specialiste_chose_form2").click(function () {
        var dataC = {
            'premier': $("#premier").val(),
            'deuxieme': $("#deuxieme").val(),
            'troisieme': $('#troisieme').val(),
            'quatrieme': $('#quatrieme').val(),
            'cinqieme': $('#cinqieme').val(),
            'sixieme': $('#sixieme').val(),
            'septieme': $('#septieme').val(),
            'huitieme': $('#huitieme').val(),
        };
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/date/choice?p="+$("#premier").val(),
            data : dataC,
            success: function(data){
                alert(data);
            } 
        });
    });
});


