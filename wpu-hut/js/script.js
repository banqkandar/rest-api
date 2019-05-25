function tampilkanSemuaMenu() {
    $.getJSON('data/pizza.json', function (params) {
       let menu  = params.menu;
       $.each(menu, function (i, params) {
           $('#daftar-menu').append('<div class="col-md-4"><div class="card mb-3"><img src="img/menu/'+ params.gambar +'" class="card-img-top"><div class="card-body"><h5 class="card-title">'+ params.nama +'</h5><p class="card-text">'+ params.deskripsi +'</p><h5 class="card-title">Rp. '+ params.harga +'</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>')
       }); 
    });
}

tampilkanSemuaMenu();

$('.nav-link').on('click', function () {
    $('.nav-link').removeClass('active');
    $(this).addClass('active'); 

    let kategori = $(this).html();
    $('h1').html(kategori);

    if(kategori == 'All Menu') {
        $('#daftar-menu').html('');
        tampilkanSemuaMenu();
        return;
    }

    $.getJSON('data/pizza.json', function (params) {
        let menu = params.menu;
        let content = '';

        $.each(menu, function (i, params) {
           if( params.kategori == kategori.toLowerCase()) {
               content += '<div class="col-md-4"><div class="card mb-3"><img src="img/menu/'+ params.gambar +'" class="card-img-top"><div class="card-body"><h5 class="card-title">'+ params.nama +'</h5><p class="card-text">'+ params.deskripsi +'</p><h5 class="card-title">Rp. '+ params.harga +'</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>'
           } 
        });

        $('#daftar-menu').html(content);
    });
});