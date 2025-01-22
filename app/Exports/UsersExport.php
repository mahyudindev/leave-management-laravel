<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    /**
     * Mengambil data untuk diekspor
     */
    public function collection()
    {
        return User::with(['departemen', 'jabatan'])
            ->get()
            ->map(function ($user) {
                return [
                    'Nik' => $user->nik,
                    'Nama' => $user->name,
                    'Email' => $user->email,
                    'Departemen' => $user->departemen->nama ?? 'Tidak Ada', // Ambil nama departemen
                    'Jabatan' => $user->jabatan->nama ?? 'Tidak Ada',     // Ambil nama jabatan
                ];
            });
    }

    /**
     * Header kolom
     */
    public function headings(): array
    {
        return [
            'Nik',
            'Nama',
            'Email',
            'Departemen',
            'Jabatan',
        ];
    }

    /**
     * Lokasi sel pertama untuk data
     */
    public function startCell(): string
    {
        return 'A5'; // Data dimulai dari sel A5
    }

    /**
     * Gaya untuk worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Header utama
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'PT UNIVAL'); // Judul perusahaan
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A2', 'LAPORAN DATA KARYAWAN');
        $sheet->mergeCells('A3:E3');
        $sheet->setCellValue('A3', 'Untuk Tahun 2025');

        // Gaya header utama
        $sheet->getStyle('A1:A3')->getFont()->setBold(true); // Menebalkan font
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal('center'); // Teks rata tengah

        // Gaya untuk header kolom
        $sheet->getStyle('A5:E5')->getFont()->setBold(true);
        $sheet->getStyle('A5:E5')->getAlignment()->setHorizontal('center');
    }
}
