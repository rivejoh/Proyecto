<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Medicamento;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario Admin
        User::factory()->create([
            'name' => 'Yinaperez',
            'email' => 'yinaperez@hotmail.com',
            'password' => bcrypt('123456789'),
            'is_admin' => true,
        ]);

        // Usuario Regular (sin acceso a admin)
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'usuario@example.com',
            'password' => bcrypt('123456789'),
            'is_admin' => false,
        ]);

        // Medicamentos de ejemplo por turno
        Medicamento::create([
            'name' => 'Vitamina D',
            'dosage' => '1000 IU',
            'frequency' => 'Una vez al día',
            'schedule_time' => '09:00:00',
            'instructions' => 'Tomar con desayuno',
            'active' => false,
        ]);

        Medicamento::create([
            'name' => 'Paracetamol',
            'dosage' => '500 mg',
            'frequency' => 'Cada 8 horas',
            'schedule_time' => '14:00:00',
            'instructions' => 'Tomar con agua',
            'active' => true,
        ]);

        Medicamento::create([
            'name' => 'Omeprazol',
            'dosage' => '20 mg',
            'frequency' => 'Una vez al día',
            'schedule_time' => '20:00:00',
            'instructions' => 'Tomar antes de dormir',
            'active' => true,
        ]);
    }
}
