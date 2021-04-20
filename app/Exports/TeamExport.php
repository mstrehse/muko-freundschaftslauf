<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class TeamExport implements FromCollection, WithStrictNullComparison, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'ID',
            'Link',
            'km',
            'Spende in €',
            'Läufer',
            'Teamname',
            'Geschlecht',
            'Vorname',
            'Nachname',
            'Straße',
            'Stadt',
            'Land',
            'Email',
            'Telefonnummer',
            'Geburtsdatum',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Team::all();
    }

    /**
     * @var Team
     */
    public function map($team): array
    {
        $km = 0;

        if ($team->results) {
            foreach ($team->results as $result) {
                $km += $result->km;
            }
        }

        $amount = 0;

        if ($team->sponsors) {
            foreach ($team->sponsors as $sponsor) {
                $amount += $sponsor->amount;
            }
        }

        return [
            $team->id,
            route('team.show', ['team' => $team]),
            $km,
            $amount,
            count($team->members) + 1,
            $team->name,
            $team->gender,
            $team->firstname,
            $team->lastname,
            $team->street,
            $team->city,
            $team->country,
            $team->email,
            $team->phone,
            $team->dayofbirth,
        ];
    }
}
