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
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CheckingExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function collection()
    {
        // Mengambil data User
        $users = Checking::where('status', 'active')->where('checking_type', 'Standart')->get();

        // Mengonversi data menggunakan UserResource
        $data = CheckingExportResource::collection($users);

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
            'Teknisi',
            'Nomor WO',
            'Nomor Polisi',
            'Merek',
            'Service Advisor',
            'Status Kendaraan',
            'Tanggal Pre',
            'Hi-Press Pre',
            'Lo-Press Pre',
            'Suhu Pre',
            'Wind Pre',
            'Saran Pre',
            'PDF Pre',
            'Tanggal Post',
            'Hi-Press Post',
            'Lo-Press Post',
            'Suhu Post',
            'Wind Post',
            'Saran Post',
            'PDF Post',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $columns = range('A', 'T'); // Menghasilkan daftar kolom A sampai T
        foreach ($columns as $column) {
            $sheet->getStyle($column . '1')->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'e7eef8', // Ganti dengan kode warna yang Anda inginkan dalam format RGB
                    ],
                ],
            ]);
            $sheet->getStyle($column . '1')->getFont()->setBold(true);
        }
        $columnStyles = [
            'M' => ['alignment' => ['wrapText' => true]],
            'T' => ['alignment' => ['wrapText' => true]],
            'S' => ['alignment' => ['wrapText' => true]],
            'L' => ['alignment' => ['wrapText' => true]],
            'A' => ['alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP]],
            'B' => ['alignment' => ['wrapText' => true]],
            'C' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'D' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'E' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'F' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'G' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'H' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'I' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'J' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'K' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            
            'N' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'O' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'P' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'Q' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'R' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
        ];

        foreach ($columnStyles as $column => $style) {
            $sheet->getStyle($column)->applyFromArray($style);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
