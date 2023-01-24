<?php

return [
    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk sahasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas sahasi. Beberapa aturan mempunyai banyak versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    'accepted'             => ':attribute boleh diterima.',
    'active_url'           => ':attribute URL tidak sah.',
    'after'                => ':attribute perlu diisi selepas :date.',
    'after_or_equal'       => ':attribute  perlu diisi selepas atau sama dengan :date.',
    'alpha'                => ':attribute format huruf.',
    'alpha_dash'           => ':attribute format huruf, angka, strip, dan garis bawah.',
    'alpha_num'            => ':attribute format huruf dan angka.',
    'array'                => ':attribute format  array.',
    'before'               => ':attribute perlu diisi sebelum :date.',
    'before_or_equal'      => ':attribute perlu diisi sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => ':attribute perlu bernilai antara :min sampai :max.',
        'file'    => ':attribute perlu berukuran antara :min sampai :max kilobita.',
        'string'  => ':attribute perlu berisi antara :min sampai :max karakter.',
        'array'   => ':attribute perlu memiliki :min sampai :max anggota.',
    ],
    'boolean'              => ':attribute perlu bernilai true atau false',
    'confirmed'            => 'Pengesahan :attribute tidak sama.',
    'date'                 => ':attribute Format Tarikh tidak sah.',
    'date_equals'          => ':attribute tarikh perlu sama dengan :date.',
    'date_format'          => ':attribute tidak sama dengan format :format.',
    'different'            => ':attribute dan :other perlu berbeda.',
    'digits'               => ':attribute perlu terdiri dari :digits angka.',
    'digits_between'       => ':attribute perlu terdiri dari :min sampai :max angka.',
    'dimensions'           => ':attribute tidak memiliki dimensi gambar yang sah.',
    'distinct'             => ':attribute memiliki nilai yang sama.',
    'email'                => ':attribute perlu alamat email yang sah.',
    'ends_with'            => ':attribute perlu diakhiri salah satu dari berikut: :values',
    'exists'               => ':attribute yang dipilih tidak sah.',
    'file'                 => ':attribute perlu format sebuah file.',
    'filled'               => ':attribute perlu memiliki nilai.',
    'gt'                   => [
        'numeric' => ':attribute perlu bernilai lebih besar dari :value.',
        'file'    => ':attribute perlu berukuran lebih besar dari :value kilobita.',
        'string'  => ':attribute perlu berisi lebih besar dari :value karakter.',
        'array'   => ':attribute perlu memiliki lebih dari :value anggota.',
    ],
    'gte'                  => [
        'numeric' => ':attribute perlu bernilai lebih besar dari atau sama dengan :value.',
        'file'    => ':attribute perlu berukuran lebih besar dari atau sama dengan :value kilobita.',
        'string'  => ':attribute perlu berisi lebih besar dari atau sama dengan :value karakter.',
        'array'   => ':attribute perlu terdiri dari :value anggota atau lebih.',
    ],
    'image'                => ':attribute perlu format gambar.',
    'in'                   => ':attribute yang dipilih tidak sah.',
    'in_array'             => ':attribute tidak ada di dalam :other.',
    'integer'              => ':attribute perlu format bilangan bulat.',
    'ip'                   => ':attribute perlu format alamat IP yang sah.',
    'ipv4'                 => ':attribute perlu format alamat IPv4 yang sah.',
    'ipv6'                 => ':attribute perlu format alamat IPv6 yang sah.',
    'json'                 => ':attribute perlu format JSON string yang sah.',
    'lookup'               => ':attribute perlu format lookup yang sah.',
    'lt'                   => [
        'numeric' => ':attribute perlu bernilai kurang dari :value.',
        'file'    => ':attribute perlu berukuran kurang dari :value kilobita.',
        'string'  => ':attribute perlu berisi kurang dari :value karakter.',
        'array'   => ':attribute perlu memiliki kurang dari :value anggota.',
    ],
    'lte'                  => [
        'numeric' => ':attribute perlu bernilai kurang dari atau sama dengan :value.',
        'file'    => ':attribute perlu berukuran kurang dari atau sama dengan :value kilobita.',
        'string'  => ':attribute perlu berisi kurang dari atau sama dengan :value karakter.',
        'array'   => ':attribute perlu tidak lebih dari :value anggota.',
    ],
    'max'                  => [
        'numeric' => ':attribute maskimal bernilai :max.',
        'file'    => ':attribute maksimal berukuran :max kilobita.',
        'string'  => ':attribute maskimal berisi :max karakter.',
        'array'   => ':attribute maksimal terdiri dari :max anggota.',
    ],
    'mimes'                => ':attribute perlu format berkas berjenis: :values.',
    'mimetypes'            => ':attribute perlu format berkas berjenis: :values.',
    'min'                  => [
        'numeric' => ':attribute minimal bernilai :min.',
        'file'    => ':attribute minimal berukuran :min kilobita.',
        'string'  => ':attribute minimal :min karakter.',
        'array'   => ':attribute minimal terdiri dari :min anggota.',
    ],
    'not_in'               => ':attribute yang dipilih tidak sah.',
    'not_regex'            => 'Format :attribute tidak sah.',
    'numeric'              => ':attribute perlu format angka.',
    'password'             => 'Kata Laluan salah.',
    'present'              => ':attribute wajib ada.',
    'regex'                => 'Format :attribute tidak sah.',
    'required'             => ':attribute wajib diisi.',
    // 'required_if'          => ':attribute wajib diisi bila :other adalah :value.',
    'required_if'          => ':attribute wajib diisi',
    'required_unless'      => ':attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => ':attribute wajib diisi bila terdapat :values.',
    'required_with_all'    => ':attribute wajib diisi bila terdapat :values.',
    'required_without'     => ':attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => ':attribute wajib diisi bila sama sekali tidak terdapat :values.',
    'same'                 => ':attribute dan :other perlu sama.',
    'size'                 => [
        'numeric' => ':attribute perlu berukuran :size.',
        'file'    => ':attribute perlu berukuran :size kilobyte.',
        'string'  => ':attribute perlu berukuran :size karakter.',
        'array'   => ':attribute perlu mengandung :size anggota.',
    ],
    'starts_with'          => ':attribute perlu diawali salah satu dari berikut: :values',
    'string'               => ':attribute perlu format string.',
    'timezone'             => ':attribute perlu berisi zona waktu yang sah.',
    'unique'               => 'Data sudah wujud.',
    'regex'                => ':attribute salah format.',
    'uploaded'             => ':attribute gagal dimuat naik',
    'url'                  => 'Format :attribute tidak sah.',
    'uuid'                 => ':attribute perlu merupakan UUID yang sah.',

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk sahasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan sahasi untuk atribut sesuai keinginan dengan
    | menggunakan konvensi "attribute.rule" dalam penamaan barisnya. Hal ini mempercepat
    | dalam menentukan baris bahasa kustom yang spesifik untuk aturan atribut yang diberikan.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom sahasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar 'placeholder' atribut dengan sesuatu
    | yang lebih mudah dimengerti oleh pembaca seperti "Alamat Surel" daripada "surel" saja.
    | Hal ini membantu kita dalam membuat pesan menjadi lebih ekspresif.
    |
    */

    'attributes' => [
    ],
];
