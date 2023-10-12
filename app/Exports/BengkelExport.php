<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BengkelExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $param = request()->route()->parameter('date');
        $date_from = substr($param, 0, 10);
        $date_until = substr($param, 11, 21);

        $data = Client::select(
            'title',
            'code',
            'address',
            'city',
            )->where('status', 'active')->get();
        return $data;
    }

    public function title(): string
    {
        return 'Bengkel';
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kode Bengkel',
            'Alamat',
            'Kota',
        ];
    }
}
