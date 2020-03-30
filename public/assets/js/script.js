$(document).ready(function(){

    // Select2
    $(".select2").select2();

    $('body').on('click', '.select-all', function () {
        var target = $(this).attr('data-select2-target');
        $("#"+target+" > option").prop("selected",true);
        $("#"+target).select2();
    });

    var loader = '<div class="loading"><div class="loader"></div></div>';
    function addLoader() {
        $('body').append(loader);
    }
    function removeLoarder() {
        $('.loading').hide(200).remove();
    }

    // General Update
    $('body').on('click', '.update-modal', function (event) {
        event.preventDefault();
        var url, targetModal;
        url = $(this).attr('href');
        targetModal = $('#update-modal');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#editModalLabel').html(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {
                
            }
        });

        // Show modal
        targetModal.modal();
    });

    // Courses Update
    $('body').on('click', '.courses-modal', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');

        // Get contents
        $.ajax({
            method:'GET', url:url,
            beforeSend:function () {addLoader();},
            success:function (data) {
                $('body').prepend(data.view);
                // Show modal
                $('#courses-modal').modal();
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {}
        });
    });

    // Show Certificates
    $('body').on('click', '.show-certificates', function (event) {
        event.preventDefault();
        var url, targetModal;

        url = $(this).attr('href');
        targetModal = $('#show-certificates');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#certiModalLabel').html(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {

            }
        });

        // Show modal
        targetModal.modal();
    });

    // Show Payments
    $('body').on('click', '.show-payments', function (event) {
        event.preventDefault();
        var url, targetModal;

        url = $(this).attr('href');
        targetModal = $('#show-payments');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#paymentsModalLabel').html(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {

            }
        });

        // Show modal
        targetModal.modal();
    });

    // Show Research
    $('body').on('click', '.show-research', function (event) {
        event.preventDefault();
        var url, targetModal;

        url = $(this).attr('href');
        targetModal = $('#show-research');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#researchModalLabel').html(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {

            }
        });

        // Show modal
        targetModal.modal();
    });

    // General Confirm Delete
    $('body').on('click', ".confirm-delete", function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        $('#confirm-delete-form').attr('action', link);
        $("#confirm_delete_modal").modal({backdrop: true});
    });
});