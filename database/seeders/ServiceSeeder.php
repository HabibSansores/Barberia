<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'             => 'Corte Clásico',
                'description'      => 'Corte tradicional a tijera o máquina con acabado limpio y profesional.',
                'price'            => 120,
                'duration_minutes' => 30,
                'image_path'       => null,
            ],
            [
                'name'             => 'Fade Premium',
                'description'      => 'Degradado moderno con transición perfecta, ideal para cualquier tipo de cabello.',
                'price'            => 180,
                'duration_minutes' => 45,
                'image_path'       => null,
            ],
            [
                'name'             => 'Corte + Barba',
                'description'      => 'Combo completo de corte de cabello y arreglo profesional de barba.',
                'price'            => 220,
                'duration_minutes' => 60,
                'image_path'       => null,
            ],
            [
                'name'             => 'Arreglo de Barba',
                'description'      => 'Perfilado, recorte y definición de barba con navaja y productos premium.',
                'price'            => 100,
                'duration_minutes' => 20,
                'image_path'       => null,
            ],
            [
                'name'             => 'Tratamiento Capilar',
                'description'      => 'Hidratación profunda y cuidado del cuero cabelludo para un cabello saludable.',
                'price'            => 150,
                'duration_minutes' => 40,
                'image_path'       => null,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
