<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@uks.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas PMR',
            'email' => 'petugas@uks.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        // Seed Kelas
        $kelasData = [
            'X-A', 'X-B', 'X-C',
            'XI-A', 'XI-B', 'XI-C',
            'XII-A', 'XII-B', 'XII-C',
        ];

        foreach ($kelasData as $nama) {
            Kelas::create(['nama' => $nama]);
        }

        // Seed Medicines
        $medicines = [
            ['nama_obat' => 'Paracetamol', 'satuan' => 'Tablet', 'stok' => 100],
            ['nama_obat' => 'Amoxicillin', 'satuan' => 'Kapsul', 'stok' => 50],
            ['nama_obat' => 'Betadine', 'satuan' => 'Botol', 'stok' => 20],
            ['nama_obat' => 'Minyak Kayu Putih', 'satuan' => 'Botol', 'stok' => 15],
            ['nama_obat' => 'Perban', 'satuan' => 'Roll', 'stok' => 30],
            ['nama_obat' => 'Hansaplast', 'satuan' => 'Lembar', 'stok' => 50],
            ['nama_obat' => 'Oralit', 'satuan' => 'Sachet', 'stok' => 40],
            ['nama_obat' => 'Antangin', 'satuan' => 'Sachet', 'stok' => 25],
            ['nama_obat' => 'Promag', 'satuan' => 'Tablet', 'stok' => 35],
            ['nama_obat' => 'Madu', 'satuan' => 'Botol', 'stok' => 10],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
