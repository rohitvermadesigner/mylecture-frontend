function logout() {
    localStorage.removeItem('studentToken');
    toastr.success('Logout Successfully');
    setTimeout(function() {
        window.location.replace('/');
    }, 1000);
}