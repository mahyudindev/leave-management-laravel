<?php

namespace App\Exports;

use App\Models\Cuti;
use Carbon\Carbon;
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
            ->whereYear('tanggal_awal', date('Y', strtotime($this->bulan)))
            ->whereMonth('tanggal_awal', date('m', strtotime($this->bulan)))
            ->get()
            ->map(function ($item) {
                $item->tanggal_awal = Carbon::parse($item->tanggal_awal)->format('d/m/Y');
                $item->tanggal_akhir = Carbon::parse($item->tanggal_akhir)->format('d/m/Y');
                return $item;
            });

        $namaBulan = Carbon::createFromFormat('Y-m', $this->bulan)->isoFormat('MMMM Y');

        return view('admin.laporan-cuti-export', compact('laporan', 'namaBulan'));
    }

    public function styles(Worksheet $sheet)
    {
        // Header style
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // Column headers style
        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['argb' => 'F2F2F2'],
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ]);

        // Data cells borders
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:F' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ]);

        // Print date style
        $sheet->getStyle('A' . ($lastRow + 1) . ':F' . ($lastRow + 1))->applyFromArray([
            'font' => [
                'italic' => true,
            ],
            'alignment' => [
                'horizontal' => 'right',
            ],
        ]);
    }
}
