<?php


namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jurusanList = ['Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Teknik Mesin', 'Matematika', 'Fisika'];

        $imageId = $this->faker->numberBetween(1, 1000);

        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->email,
            'nim_nisn' => $this->faker->unique()->numerify('##########'),
            'sekolah_univ' => $this->faker->company(),
            'jurusan' => $this->faker->randomElement($jurusanList),
            'alamat' => $this->faker->address,
            'no_telp' => $this->faker->phoneNumber,
            'no_guru' => $this->faker->unique()->numerify('##########'),
            'tanggal_masuk' => $this->faker->dateTimeThisMonth(),
            'tanggal_keluar' => $this->faker->dateTimeThisMonth(),
            
        ];
    }
}