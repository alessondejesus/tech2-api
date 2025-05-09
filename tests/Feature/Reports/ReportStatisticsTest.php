<?php

use App\Models\User;
use App\Models\EnergyReport;

test('it should list consumption grouped per year', function () {
    $user = User::factory()->create();
    EnergyReport::factory()->count(10)->create();

    $this->actingAs($user)
        ->getJson('api/reports/statistics/consumption-per-year')
        ->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'year',
                'total_energy_consumption_mwh',
                'total_co2_emissions_ton',
            ]
        ]);
});

test('it should list consumption grouped per sector', function () {
    $user = User::factory()->create();
    EnergyReport::factory()->count(10)->create();

    $this->actingAs($user)
        ->getJson('api/reports/statistics/consumption-per-sector')
        ->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'sector_name',
                'total_energy_consumption_mwh',
                'total_co2_emissions_ton',
            ]
        ]);
});

test('it should list consumption grouped per company', function () {
    $user = User::factory()->create();
    EnergyReport::factory()->count(10)->create();

    $this->actingAs($user)
        ->getJson('api/reports/statistics/consumption-per-company')
        ->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'company_name',
                'total_energy_consumption_mwh',
                'total_co2_emissions_ton',
            ]
        ]);
});

test('it should list current emission', function () {
    $user = User::factory()->create();
    EnergyReport::factory()->count(10)->create();

    $this->actingAs($user)
        ->getJson('api/reports/statistics/current-emission')
        ->assertStatus(200)
        ->assertJsonStructure([
            'total_all_time' => [
                'total_energy_consumption_mwh',
                'total_co2_emissions_ton',
                'total_consumption',
            ],
            'total_current_year' => [
                'total_energy_consumption_mwh',
                'total_co2_emissions_ton',
                'total_consumption',
            ],
        ]);
});
