<?php

namespace App\Exports;

use App\Models\Cuti;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanCutiExport implements FromView, WithStyles, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $laporan = Cuti::with(['user.departemen', 'user.jabatan'])
            ->where('status', 'Approved')
            ->whereYear('created_at', date('Y', strtotime($this->bulan)))
            ->whereMonth('created_at', date('m', strtotime($this->bulan)))
            ->get();

        $namaBulan = date('F', strtotime($this->bulan));

        return view('admin.laporan-cuti-export', compact('laporan', 'namaBulan'));
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['argb' => 'A9D08E'],
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => '000000'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['argb' => 'A9D08E'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // Border untuk seluruh data
        $sheet->getStyle('A1:F' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        return $sheet;
    }
}
