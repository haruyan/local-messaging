<script type="text/javascript">
function swal1(id) {
    
    event.preventDefault();
    var form = $('#js-sweetalert-'+id);
    
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
</script>