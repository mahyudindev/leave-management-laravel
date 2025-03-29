<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanCutiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m'));
        $namaBulan = Carbon::createFromFormat('Y-m', $bulan)->isoFormat('MMMM Y');

        $laporan = Cuti::with(['user.departemen', 'user.jabatan'])
            ->whereYear('tanggal_awal', substr($bulan, 0, 4))
            ->whereMonth('tanggal_awal', substr($bulan, 5, 2))
            ->where('status', 'Approved')
            ->get()
            ->map(function ($item) {
                $item->tanggal_awal = Carbon::parse($item->tanggal_awal)->format('d/m/Y');
                $item->tanggal_akhir = Carbon::parse($item->tanggal_akhir)->format('d/m/Y');
                return $item;
            });

        return view('admin.laporan-cuti', compact('laporan', 'bulan', 'namaBulan'));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m'));
        $namaBulan = Carbon::createFromFormat('Y-m', $bulan)->isoFormat('MMMM Y');

        $laporan = Cuti::with(['user.departemen', 'user.jabatan'])
            ->whereYear('tanggal_awal', substr($bulan, 0, 4))
            ->whereMonth('tanggal_awal', substr($bulan, 5, 2))
            ->where('status', 'Approved')
            ->get();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'LAPORAN CUTI BULAN ' . strtoupper($namaBulan));
        $sheet->mergeCells('A1:F1');
        
        $sheet->setCellValue('A2', 'Nama Karyawan');
        $sheet->setCellValue('B2', 'Departemen');
        $sheet->setCellValue('C2', 'Jabatan');
        $sheet->setCellValue('D2', 'Jumlah Cuti');
        $sheet->setCellValue('E2', 'Tanggal Mulai');
        $sheet->setCellValue('F2', 'Tanggal Berakhir');

        // Add data rows
        $row = 3;
        foreach ($laporan as $cuti) {
            $sheet->setCellValue('A' . $row, $cuti->user->name);
            $sheet->setCellValue('B' . $row, $cuti->user->departemen->nama ?? '-');
            $sheet->setCellValue('C' . $row, $cuti->user->jabatan->nama ?? '-');
            $sheet->setCellValue('D' . $row, $cuti->jumlah);
            $sheet->setCellValue('E' . $row, Carbon::parse($cuti->tanggal_awal)->format('d/m/Y'));
            $sheet->setCellValue('F' . $row, Carbon::parse($cuti->tanggal_akhir)->format('d/m/Y'));
            $row++;
        }

        // Add print date
        $row++;
        $sheet->setCellValue('A' . $row, 'Dicetak pada: ' . Carbon::now()->format('d/m/Y'));
        $sheet->mergeCells('A' . $row . ':F' . $row);

        // Style the header
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Style the column headers
        $sheet->getStyle('A2:F2')->getFont()->setBold(true);
        
        // Auto-size columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Cuti_' . $namaBulan . '.xlsx';
        
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save file to output
        $writer->save('php://output');
        exit;
    }
}
