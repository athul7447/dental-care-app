$(function () {
    $(document).on("click", ".js-datatable-delete", function (event) {
        event.preventDefault();

        const button = $(this);
        const table = button.closest(".js-data-table");
        const url = button.data("delete-url");

        Swal.fire({
            title: "Are you sure you wish to delete this?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-secondary",
            },
            buttonsStyling: true,
            confirmButtonText: "Delete",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                let currentOptions = {
                    url: url,
                    method: "DELETE",
                    disableLoader: false,
                };
                const options = $.extend(
                    {},
                    getDefaultAjaxOptions(),
                    currentOptions
                );
                return $.ajax(options)
                    .done(function (data, textStatus, jqXHR) {
                        /* execute on success */
                        Swal.fire("Deleted!", data.message, "success").then(
                            () => {
                                const tableId = table.attr("id");
                                window.LaravelDataTables[tableId].draw();
                            }
                        );
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        const handler = defaultAjaxErrorHandler.bind(this);
                        handler(jqXHR, textStatus, errorThrown);
                    });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        });
    });

    /* multiple status changing */
    $(".multiple-status").on("change", function () {
        multipleStatusChanging($(this));
    });

    $(".select-all").on("click", function (e) {
        if ($(this).is(":checked")) {
            $(".select-custom").prop("checked", true);
            $(".multiple-actions").removeClass("d-none");
        } else {
            $(".select-custom").prop("checked", false);
            $(".multiple-actions").addClass("d-none");
        }
    });

    $(document).on("click", ".select-custom", function (e) {
        var users = [];
        $(".select-custom:checked").each(function () {
            users.push($(this).attr("data-id"));
        });
        if (users.length <= 0) {
            $(".multiple-actions").addClass("d-none");
            $(".select-all").prop("checked", false);
        } else {
            $(".multiple-actions").removeClass("d-none");
        }
    });

    /* delete multiple items */
    $(document).on("click", ".multiple-delete", function (event) {
        event.preventDefault();
        var data = $(this);
        const url = data.data("delete-url");
        var idArray = [];
        $(".select-custom:checked").each(function () {
            idArray.push($(this).attr("data-id"));
        });
        Swal.fire({
            title: "Are you sure you wish to delete all selections?",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-secondary",
            },
            buttonsStyling: true,
            confirmButtonText: "Delete",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                let currentOptions = {
                    url: url,
                    data: {
                        ids: idArray,
                    },
                    method: "DELETE",
                    disableLoader: false,
                };
                const options = $.extend(
                    {},
                    getDefaultAjaxOptions(),
                    currentOptions
                );
                return $.ajax(options)
                    .done(function (responseData, textStatus, jqXHR) {
                        Swal.fire({
                            title: "Deleted successfully",
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: true,
                        }).then(() => {
                            window.LaravelDataTables[
                                $(".js-data-table").attr("id")
                            ].draw();
                            $(".multiple-actions").addClass("d-none");
                            $(".select-all").prop("checked", false);
                        });
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        const handler = defaultAjaxErrorHandler.bind(this);
                        handler(jqXHR, textStatus, errorThrown);
                    });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        });
    });
});

/* status changing */
function changeStatus(data) {
    const statusButton = data;
    statusButton.prop("disabled", true);
    const url = statusButton.data("status-change-url");
    const status = statusButton.is(":checked") ? 1 : 0;
    Swal.fire({
        title: "Are you sure you wish to change this status?",
        icon: "warning",
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-secondary",
        },
        buttonsStyling: true,
        confirmButtonText: "Change",
        showLoaderOnConfirm: true,
        didClose: () => {
            statusButton.prop("disabled", false);
        },
        preConfirm: () => {
            let currentOptions = {
                url: url,
                data: {
                    status: status,
                },
                method: "POST",
                disableLoader: false,
            };
            const options = $.extend(
                {},
                getDefaultAjaxOptions(),
                currentOptions
            );
            return $.ajax(options)
                .done(function (responseData, textStatus, jqXHR) {
                    Swal.fire({
                        title: "Status updated successfully",
                        icon: "success",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        buttonsStyling: true,
                    });
                    statusButton.prop("checked", status == 1);
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    const handler = defaultAjaxErrorHandler.bind(this);
                    handler(jqXHR, textStatus, errorThrown);
                })
                .always(function () {
                    statusButton.prop("disabled", false);
                });
        },
        allowOutsideClick: () => !Swal.isLoading(),
    });
}

function multipleStatusChanging(data) {
    const status = data.val();
    const url = data.data("url");
    var idArray = [];
    $(".select-custom:checked").each(function () {
        idArray.push($(this).attr("data-id"));
    });
    if (status == "") {
        Swal.fire({
            title: "Please select a action",
            icon: "warning",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
        });
    } else {
        Swal.fire({
            title: "Are you sure you wish to apply this status for all selections?",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-secondary",
            },
            buttonsStyling: true,
            confirmButtonText: "Change",
            showLoaderOnConfirm: true,
            didClose: () => {
                data.val("").trigger("change.select2");
            },
            preConfirm: () => {
                let currentOptions = {
                    url: url,
                    data: {
                        status: status,
                        ids: idArray,
                    },
                    method: "POST",
                    disableLoader: false,
                };
                const options = $.extend(
                    {},
                    getDefaultAjaxOptions(),
                    currentOptions
                );
                return $.ajax(options)
                    .done(function (responseData, textStatus, jqXHR) {
                        Swal.fire({
                            title: "Status updated successfully",
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: true,
                        }).then(() => {
                            window.LaravelDataTables[
                                $(".js-data-table").attr("id")
                            ].draw();
                            $(".multiple-actions").addClass("d-none");
                            $(".select-all").prop("checked", false);
                            $(".multiple-status")
                                .val("")
                                .trigger("change.select2");
                        });
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        const handler = defaultAjaxErrorHandler.bind(this);
                        handler(jqXHR, textStatus, errorThrown);
                    });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        });
    }
}
