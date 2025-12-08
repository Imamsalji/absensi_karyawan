<?php
return [
    // contoh: array IP statis atau CIDR (lebih baik pakai paket untuk CIDR kalau perlu)
    'allowed_ips' => [
        '192.168.1.0/24', // jika ingin cek subnet, lihat catatan di bawah
        '203.0.113.10',
    ],
];
