<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UserExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = User::select(
                'employees.fullname',
                'users.email',
                'clients.title',
                'employees.is_kabeng'
            )
            ->join('employees', 'users.id', 'employees.id')
            ->join('clients', 'employees.client_id', 'clients.id')
            ->where('users.status', 'active')
            ->get();

        return $data;
    }

    public function title(): string
    {
        return 'Data User';
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Email',
            'Bengkel',
            'Kabeng',
        ];
    }
}
