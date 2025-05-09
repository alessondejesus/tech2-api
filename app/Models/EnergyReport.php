<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyReport extends Model
{
    use HasUuids, HasFactory, HasFactory;

    protected $fillable = [
        'id',
        'year',
        'company_name',
        'sector_name',
        'energy_consumption_mwh',
        'co2_emissions_ton',
    ];
}
