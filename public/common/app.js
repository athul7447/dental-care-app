"use strict";

const body = document.getElementsByTagName("body")[0];

/*******************************************************
 *
 * Loader Start
 *
 *******************************************************/

const startLoader = function () {
    body.classList.add("page-loading");
};
const stopLoader = function () {
    body.classList.remove("page-loading");
};

/*******************************************************
 *
 * Loader End
 *
 *******************************************************/

/*******************************************************
 *
 * Button Loader Start
 *
 *******************************************************/

const startButtonLoader = function (btn, disable = true) {
    const button = $(btn);
    if (button.length) {
        if (disable) {
            button.prop("disabled", true);
        }
        button.prepend(
            '<span class="spinner-border spinner-border-sm align-middle me-2 js-button-loader"></span></span>'
        );
    }
};
const stopButtonLoader = function (btn, disable = true) {
    const button = $(btn);
    if (button.length) {
        if (disable) {
            button.prop("disabled", false);
        }
        const loader = button.find(".js-button-loader");
        if (loader.length) {
            loader.remove();
        }
    }
};

/*******************************************************
 *
 * Button Loader End
 *
 *******************************************************/

/*******************************************************
 *
 * Jquery Ajax Methods and options Start
 *
 *******************************************************/

const appendCsrfHeader = function (xhr) {
    xhr.setRequestHeader("X-CSRF-TOKEN", $("#csrfToken").attr("content"));
};

const appendAcceptJsonHeader = function (xhr, settings) {
    if (settings.acceptJson) {
        xhr.setRequestHeader("Accept", "application/json");
    }
};

const appendSpoofMethodHeader = function (xhr, settings) {
    if (settings.spoofMethod) {
        xhr.setRequestHeader("X-HTTP-METHOD-OVERRIDE", settings.spoofMethod);
    }
};

const prependBaseUrl = function (xhr, settings) {
    /** @link https://stackoverflow.com/a/19709846 */
    var r = new RegExp("^(?:[a-z]+:)?//", "i");
    // If url is not absolute url, then append baseurl
    if (!r.test(settings.url)) {
        settings.url =
            removeTrailingSlash(window.appConfig.adminBaseUrl) +
            addLeadingSlash(settings.url);
    }
};

const defaultAjaxBeforeSend = function (xhr, settings) {
    prependBaseUrl(xhr, settings);
    appendSpoofMethodHeader(xhr, settings);
    appendCsrfHeader(xhr, settings);
    appendAcceptJsonHeader(xhr, settings);
};

const getDefaultAjaxOptions = function () {
    return {
        acceptJson: true,
        beforeSend: defaultAjaxBeforeSend,
        error: defaultAjaxErrorHandler,
    };
};

const defaultAjaxErrorHandler = function (xhr, status, error) {
    const statusCode = xhr.status;
    const response = xhr.responseJSON;

    if (statusCode == 400) {
        show400Popup(response.message);
    } else if (statusCode == 401) {
        show401Popup();
    } else if (statusCode == 403) {
        show403Popup(response.message);
    } else if (statusCode == 404) {
        show404Popup(response.message);
    } else if (statusCode == 405) {
        show405Popup();
    } else if (statusCode == 408) {
        show408Popup();
    } else if (statusCode == 409) {
        show409Popup(response.message);
    } else if (statusCode == 419) {
        show419Popup();
    } else if (statusCode == 422) {
        renderValidationErrors(response, this.validator);
    } else if (statusCode == 429) {
        show429Popup();
    } else if (statusCode == 500) {
        show500Popup(response.message);
    } else if (statusCode == 503) {
        show503Popup();
    } else {
        showDefaultErrorPopup(response.message);
    }
};

const renderValidationErrors = function (response, validator = null) {
    if (validator && response.errors) {
        validator.showErrors(response.errors);
    } else {
        showDefaultErrorPopup(response.message);
    }
};

const errorPopup = Swal.mixin({
    title: "Error",
    text: "Something went wrong",
    icon: "error",
    customClass: {
        confirmButton: "btn btn-primary",
    },
    buttonsStyling: true,
    confirmButtonText: "Ok",
});

const show400Popup = function (message) {
    errorPopup.fire({
        title: "Error",
        text: message,
    });
};

const show401Popup = function () {
    errorPopup.fire({
        title: "Session Expired",
        text: "Session Expired. Please login again",
        willClose: () => {
            window.location.href = window.appConfig.loginUrl;
        },
    });
};

const show403Popup = function (message) {
    errorPopup.fire({
        title: "Blocked",
        text: message || "You do not have permission to perform this action",
    });
};

const show404Popup = function (message) {
    errorPopup.fire({
        title: "Not Found",
        text: message,
    });
};

const show405Popup = function () {
    errorPopup.fire({
        title: "Technical Error",
        text: "Oops, A technical error has occurred. Please inform developers",
    });
};

const show408Popup = function () {
    errorPopup.fire({
        title: "Timeout",
        text: "Request timeout. Please try again",
    });
};

const show409Popup = function (message) {
    errorPopup.fire({
        title: "Error",
        text: message,
    });
};

const show419Popup = function () {
    errorPopup.fire({
        title: "Page Expired",
        text: "Looks like the page has expired. Please Refresh the page and try again",
        confirmButtonText: "Refresh",
        willClose: () => {
            location.reload();
        },
    });
};

const show429Popup = function () {
    errorPopup.fire({
        title: "Too many requests",
        text: "We received too many request from you in a short time. Please wait for some time and try again",
    });
};

const show500Popup = function (message = null) {
    errorPopup.fire({
        title: "Server Error",
        text: message || "Technical Error. Please try again after some time",
    });
};

const show503Popup = function () {
    errorPopup.fire({
        title: "Server under maintenance",
        text: "Looks like the server is down or under maintenance right now. Please try again after some time",
    });
};
const showDefaultErrorPopup = function (message) {
    errorPopup.fire({
        title: "Something went wrong",
        text: message || "Technical Error. Please try again after some time",
    });
};

/*******************************************************
 *
 * Jquery Ajax Methods and options End
 *
 *******************************************************/

/*******************************************************
 *
 * Miscellaneous Start
 *
 *******************************************************/

const removeTrailingSlash = function (string) {
    return string.replace(/\/+$/, "");
};

const removeLeadingSlash = function (string) {
    return string.replace(/^\/+/, "");
};

const addLeadingSlash = function (string) {
    if (string) {
        return "/" + removeLeadingSlash(string);
    }
    return string;
};

const getDefaultCkeditorConfig = function () {
    return {
        image: {
            upload: {
                types: ["png", "jpeg", "gif", "webp"],
            },
            toolbar: [
                "imageStyle:block",
                "imageStyle:inline",
                "imageStyle:side",
                "imageStyle:alignLeft",
                "imageStyle:alignRight",
                "imageStyle:alignBlockLeft",
                "imageStyle:alignCenter",
                "|",
                "toggleImageCaption",
                "imageTextAlternative",
                "|",
                "linkImage",
            ],
        },
        fontSize: {
            options: [
                2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 40,
                48, 56, 64, 72,
            ],
            supportAllValues: true,
        },
        simpleUpload: {
            // The URL that the images are uploaded to.
            uploadUrl: window.IMAGE_UPLOAD_URL,

            // Enable the XMLHttpRequest.withCredentials property.
            withCredentials: true,

            // Headers sent along with the XMLHttpRequest to the upload server.
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf"]')
                    .getAttribute("content"),
            },
        },
    };
};

window.generateCkeditorConfig = function (options = {}) {
    return $.extend({}, getDefaultCkeditorConfig(), options);
};

/*******************************************************
 *
 * Miscellaneous End
 *
 *******************************************************/

$(function () {
    $.validator.setDefaults({
        normalizer: function (value) {
            return $.trim(value);
        },
        ignore: [],
        // is-invalid is for elements with form-control class. text-danger is for the error message under the input
        errorClass: "validation-error is-invalid text-danger",
        errorPlacement: function (error, element) {
            if (element.data("select2")) {
                element.parent().append(error);
            } else if (element.hasClass("js-custom-file-input")) {
                error.appendTo(
                    element
                        .closest(".js-image-input-wrapper")
                        .find(".validation-error-wrapper")
                );
            } else if (element.parent().hasClass("input-group")) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        },
        showErrors: function (errorMap, errorList) {
            this.defaultShowErrors();
        },
    });

    /*
     * When you change the value the select via select2, it triggers
     * a 'change' event, but the jquery validation plugin
     * only re-validates on 'blur', so even if we change the
     * select will still show as invalid
     * So when value changes, we will trigger blur so that
     * jquery validate will revallidate it
     *
     */
    $(document).on("change", 'select[data-control="select2"]', function () {
        $(this).trigger("blur");
    });

    $(document).on("click", ".logout", function (event) {
        event.preventDefault();
        event.stopPropagation();

        let currentOptions = {
            url: window.appConfig.logoutUrl,
            method: "POST",
            disableLoader: false,
        };

        const options = $.extend({}, getDefaultAjaxOptions(), currentOptions);
        $.ajax(options)
            .done(function (data, textStatus, jqXHR) {
                // execute on success
                window.location.href = window.appConfig.loginUrl;
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                // execute on error
                const handler = defaultAjaxErrorHandler.bind(this);
                handler(jqXHR, textStatus, errorThrown);
            })
            .always(function () {
                // always execute
            });
    });
});
