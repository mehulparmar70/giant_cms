$(window).on('load', function() {

    if ($('#full_description').val() != undefined && $('#full_description').val() != "") {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.setData($('#full_description').val());
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
    }
    
});

$(document).ready(function() {
    // $('.remove-image').click(function(e) {
    //     e.preventDefault();
    //     var url = $(this).attr('data-url');
    //     var field = $(this).data('field');
    //     var table = $(this).data('table');
    //     var id = $(this).data('id');
    //     var el = $(this);
    //     $.ajax({
    //         type: "POST",
    //         url: url,
    //         data: { 'table': table, 'field': field, 'id': id },
    //         success: function(result) {
    //             toastr[result.status](result.message);
    //         },
    //         error: function(result) {
    //             alert('error');
    //         }
    //     });
    // });

    $(".category-color span:nth-child(1)").addClass("bg-primary");
    $(".category-color span:nth-child(2)").addClass("bg-danger");
    $(".category-color span:nth-child(3)").addClass("bg-warning");

    $(".status-switch").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });

    $(".checkAll").click(function(e) {
        $('.checkList').each(function() {
            this.checked = !this.checked;
        });
    });

   
    

    window.onunload = refreshParent;

    function refreshParent() {
        window.opener.location.reload();
    }
});
