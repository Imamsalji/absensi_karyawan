<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 50px 20px;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            margin: 10px;
        }

        button:hover {
            background-color: #218838;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <h1>Selamat Datang di Sistem Absensi</h1>
        <p>Kelola kehadiran Anda dengan mudah dan cepat.</p>
    </header>

    <div class="container">
        <h2>Apa yang ingin Anda lakukan?</h2>
        <p>Aplikasi Absensi Karyawan ini dirancang untuk membantu perusahaan dalam melakukan pencatatan kehadiran
            karyawan secara otomatis dan akurat berbasis web. Sistem ini menyediakan fitur untuk melakukan pencatatan
            waktu masuk dan keluar (Clock In & Clock Out), monitoring real-time, serta pembuatan laporan yang dapat
            difilter sesuai kebutuhan.</p>
        <button onclick="window.location.href='{{ route('login') }}'">Masuk ke Sistem</button>
        <button onclick="window.location.href='{{ route('register') }}'">Registrasi Terlebih dahulu</button>
    </div>

    <footer>
        <p>&copy; 2023 Sistem Absensi. Semua hak dilindungi.</p>
    </footer>
</body>

</html>
