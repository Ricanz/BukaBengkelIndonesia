<?php

namespace App\Exports;

use App\Http\Resources\CheckingExportResource;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Resources\YourResource; // Gantilah dengan nama resource yang sesuai
use App\Models\Checking;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckingExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        // Mengambil data User
        $users = Checking::all();

        // Mengonversi data menggunakan UserResource
        // $data = CheckingExportResource::collection($users);

        // Mengubah data dari resource menjadi array
        // $dataArray = $data->toArray();
        $data = $users->map(function($user) {
            return (new CheckingExportResource($user))->toArray();
        });

        // Mengembalikan data sebagai koleksi
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
