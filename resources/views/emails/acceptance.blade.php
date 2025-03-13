@component('mail::message')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Gaya untuk elemen-elemen email */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #252525;
                color: #ffffff;
                margin: 0;
                padding: 20px;
            }

            .container {
                max-width: 600px;
                float: left;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #3498db;
            }

            p {
                line-height: 1.6;
            }

         
           iconify-icon{
            color: #58f000;
            margin-right: 10px;
           }
           
        </style>
    </head>

    <body>

        <div class="container">
            <h1>Selamat {{ $mahasiswaData['nama'] }}!</h1>

            <p>Anda diterima untuk magang di kantor Wali Kota. Anda dapat segera datang ke kantor untuk memulai magang.</p>

            <p>Untuk informasi lebih lanjut, Anda bisa menghubungi kami di nomor berikut:</p>

            <ul>
                <a href="https://wa.me/6283843743203" class="whatsapp-button"></li>
                    <iconify-icon icon="ri:whatsapp-fill"></iconify-icon>
                    Hubungi Kami
                </a>
            </ul>

            <p>Terima kasih dan selamat magang!</p>

            
        </div>
        {{-- iconify icons --}}
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </body>

    </html>
