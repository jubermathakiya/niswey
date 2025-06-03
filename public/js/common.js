//toast message

//success
function successToast(message) {
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
    toastr.success(message);
}

//error
function errorToast(message) {
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
    toastr.error(message);
}

//info
function infoToast(message) {
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
    toastr.info(message);
}

//warning
function warningToast(message) {
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
    toastr.warning(message);
}