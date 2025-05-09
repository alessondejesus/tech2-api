<?php

namespace Database\Factories;

use App\Models\EnergyReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EnergyReport>
 */
class EnergyReportFactory extends Factory
{
    protected $model = EnergyReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => fake()->numberBetween(2015, 2025),
            'company_name' => fake()->randomElement([
                'Alpha Corp', 'Beta Ltd', 'Gamma Solutions', 'Delta Group', 'Epsilon Inc',
                'Zeta Enterprises', 'Eta Systems', 'Theta Co', 'Iota Global', 'Kappa Ventures',
                'Lambda Tech', 'Mu Partners', 'Nu Logistics', 'Xi Power', 'Omicron Labs',
                'Pi Industries', 'Rho Digital', 'Sigma Networks', 'Tau Energy', 'Upsilon Media',
                'Phi Electric', 'Chi Foods', 'Psi Tools', 'Omega Holdings', 'Apex Dynamics',
                'Core Fusion', 'Nexus Electric', 'Quantum Solutions', 'Vertex Ltd', 'Zenith Group'
            ]),
            'sector_name' => fake()->randomElement([
                'Energia Elétrica',
                'Petróleo e Gás',
                'Indústria Química',
                'Mineração',
                'Siderurgia e Metalurgia',
                'Transporte e Logística',
                'Construção Civil',
                'Agroindústria',
                'Tratamento de Água e Esgoto',
                'Resíduos e Reciclagem',
            ]),
            'energy_consumption_mwh' => fake()->randomFloat(2, 1000, 100000),
            'co2_emissions_ton' => fake()->randomFloat(2, 500, 50000),
        ];
    }
}
