<?php
namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // ambil semua data siswa
        return Siswa::select('id', 'nama', 'status', 'tanggal_masuk', 'tanggal_keluar')->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nama',
            'Status',
            'Tanggal Masuk',
            'Tanggal Keluar',
        ];
    }
}
