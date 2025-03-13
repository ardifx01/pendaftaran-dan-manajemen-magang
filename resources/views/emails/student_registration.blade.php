<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:wght@100;400;500;700;800&family=Poppins:ital,wght@0,100;0,400;0,600;0,700;0,800;0,900;1,400&display=swap"
        rel="stylesheet">
    <title>Pendaftaran Magang</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin-top: 20px;
            float: left;
            padding: 20px;
            background-color: #252525;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 20px;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #fff;
            margin-right: 10px;
        }

        .info-value {
            flex-grow: 1;
            color: #fff;
        }
    </style>

</head>

<body>

    <div class="container">
        <h1>Informasi Permintaan</h1>

        <div class="info-section">
            <span class="info-label">Nama:</span>
            <span class="info-value">{{ $permintaan->nama }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">Email:</span>
            <span class="info-value">{{ $permintaan->email }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">NIM/NISN:</span>
            <span class="info-value">{{ $permintaan->nim_nisn }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">Sekolah/Universitas:</span>
            <span class="info-value">{{ $permintaan->sekolah_univ }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">Jurusan:</span>
            <span class="info-value">{{ $permintaan->jurusan }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">Alamat:</span>
            <span class="info-value">{{ $permintaan->alamat }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">No.Hp:</span>
            <span class="info-value">{{ $permintaan->no_telp }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">No.hp Guru:</span>
            <span class="info-value">{{ $permintaan->no_guru }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">Tanggal Masuk:</span>
            <span
                class="info-value">{{ \Carbon\Carbon::parse($permintaan->tanggal_masuk)->translatedFormat('d F Y') }}</span>
        </div>

        <div class="info-section">
            <span class="info-label">Tanggal Keluar:</span>
            <span
                class="info-value">{{ \Carbon\Carbon::parse($permintaan->tanggal_keluar)->translatedFormat('d F Y') }}</span>
        </div>

        {{-- Image (Jika ada) --}}

    </div>

</body>

</html>
