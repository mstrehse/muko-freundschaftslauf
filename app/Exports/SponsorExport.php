<?php

namespace App\Exports;

use App\Models\Sponsor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class SponsorExport implements FromCollection, WithStrictNullComparison, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'ID',
            'Link',
            'Team',
            'Name',
            'Kontakt',
            'Straße',
            'Stadt',
            'E-Mail',
            'Telefonnummer',
            'Infos',
            'Spendenbetrag in €',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sponsor::all();
    }

    /**
     * @var Sponsor
     */
    public function map($sponsor): array
    {
        return [
            $sponsor->id,
            route('sponsor.edit', ['sponsor' => $sponsor]),
            $sponsor->team_id,
            $sponsor->name,
            $sponsor->contact,
            $sponsor->street,
            $sponsor->city,
            $sponsor->email,
            $sponsor->phone,
            $sponsor->infos,
            $sponsor->amount,
        ];
    }
}
