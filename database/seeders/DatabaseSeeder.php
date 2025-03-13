<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Devisi;
use App\Models\User;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

      // Create 20 instances of Mahasiswa
      Mahasiswa::factory(20)->create();

  

     $devisi = [
      [
        "nama_devisi" => "Pemerintahan",
        "deskripsi" => "Bagian Pemerintahan",
      ],

      [
        "nama_devisi" => "Kesra",
        "deskripsi" => "Keistimewaan Aceh Dan Kesejahteraan Rakyat",
      ],
      [
        "nama_devisi" => "Hukum",
        "deskripsi" => "Bagian Hukum",
      ],
      [
        "nama_devisi" => "Perekonomian",
        "deskripsi" => "Bagian Perekonomian & Sumber Daya Alam",
      ],
      [
        "nama_devisi" => "Administrasi",
        "deskripsi" => "Bagian Administrasi Pembangunan",
      ],

      [
        "nama_devisi" => "Pengadaan",
        "deskripsi" => "Bagian Pengadaan Barang & Jasa",
      ],

      [
        "nama_devisi" => "Umum",
        "deskripsi" => "Bagian Umum",
      ],
      ];

      $admin = [

        [
          "nip" => 12345,
          "nama" =>"admin",
          "email" => "admin@gmail.com",
          "devisi_id" => 1,
          "alamat" => "Alamat Admin",
          "no_telp" => "123456789",          
        ],   

        [
          "nip" => 12345123,
          "nama" =>"super",
          "email" => "super@gmail.com",
          "devisi_id" => 1,
          "alamat" => "Alamat Super",
          "no_telp" => "123456789",          
        ], 
      ];

        $userData = [

       
          [
            "name" =>"Super Admin",
            "role" => "super",
            "admin_id" => 12345123,
            "email" => "super@gmail.com",
            "password" => "123456789",          
          ],
          [
            "name" =>"Rausyanul fikri",
            "role" => "admin",
            "admin_id" => 12345,
            "email" => "rausyan@gmail.com",
            "password" => "123456789",          
          ],
        
        ];

   
        foreach($devisi as $key => $value) {
          Devisi::create($value);
        } 

        foreach($admin as $key => $value) {
          Admin::create($value);
        } 

      foreach($userData as $key => $value) {
        User::create($value);
      }
    }

   
  }

