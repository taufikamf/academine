<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaisExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["Name", "Matkul","Kriteria","Nilai"];
    }

    public function collection()
    {
        // return Nilai::all();
        $nilai = DB::table('nilais')
            ->join('matkuls', 'nilais.id_matkul', '=', 'matkuls.id')
            ->join('kriterias', 'nilais.id_kriteria', '=', 'kriterias.id')
            ->join('users', 'nilais.id_user','=', 'users.id')
            ->select('users.name as nama_mahasiswa', 'matkuls.nama as nama_matkul','kriterias.nama as nama_kriteria','nilais.nilai as nilai')
            ->get();
        return $nilai;
    }
}
