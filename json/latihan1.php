<?php
$mahasiswa = [
    [
        "nama" => "mohammad iskandar",
        "nim" => "10116291",
        "jurusan" => "if"
    ],
    [
        "nama" => "abdul buhori",
        "nim" => "10172917",
        "jurusan" => "si"
    ]
];

    $data = json_encode($mahasiswa);
    echo $data;

?>