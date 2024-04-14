function showSuccessToast(message) {
    Swal.fire({
        icon: "success",
        title: "Success!",
        text: message,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
}

function showErrorToast(message) {
    Swal.fire({
        icon: "error",
        title: "Error!",
        text: message,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
}
