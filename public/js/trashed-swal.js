function swalAlert() {
    event.preventDefault();
    var form = event.target.form;
        swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus data ini.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        closeOnConfirm: false
        }, function(){
            form.submit();
        }
        );
}