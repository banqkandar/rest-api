// let mahasiswa = {
//     nama : "iskandar",
//     nim  : "10116121",
//     email : "bangkandar@unikom.ac.id"
// }

// console.log(JSON.stringify(mahasiswa));


let xhr = new XMLHttpRequest();
xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 & xhr.status == 200) {
        let mahasiswa = JSON.parse(this.responseText);
        console.log(mahasiswa);

    }
    
}
xhr.open('GET', 'coba.json', true);
xhr.send();