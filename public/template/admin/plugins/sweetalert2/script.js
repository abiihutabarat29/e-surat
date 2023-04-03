const swalLogout = $(".swal-logout").data("swal");
if (swalLogout) {
    var Toast =  Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: 'success',
        title: swalLogout
    })
}
const swalLogin = $(".swal-login").data("swal");
if (swalLogin) {
    var Toast =  Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: 'warning',
        title: swalLogin
    })
}
const swalFlash = $(".swal").data("swal");
if (swalFlash) {
    var Toast =  Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: 'success',
        title: swalFlash
    })
}
const swalFlashErr = $(".swalErr").data("swal");
if (swalFlashErr) {
    var Toast =  Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: 'warning',
        title: swalFlashErr
    })
}

