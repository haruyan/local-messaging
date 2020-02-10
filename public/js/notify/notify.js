function notifyThis(pengirim, id) {
    $.notify({
        offset: 50,
        title: "<strong>Surat masuk dari:</strong>",
        message: pengirim,
        url: "/surat/detail/"+id,
        target: "_self"
});
}

function welcomeThis(count) {
    $.notify({
        offset: 50,
        title: "<strong>Anda memiliki :</strong>",
        message: count + " pesan belum terbaca",
        url: "/inbox",
        target: "_self",
    },{
        type: 'success',
    });
}
