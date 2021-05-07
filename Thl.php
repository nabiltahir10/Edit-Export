<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;


class Thl implements  WithTitle, WithHeadings, FromArray, 
ShouldAutoSize
{
    private $month;
    public function __construct(int $month)
    {
        $this->month = $month;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $absen = DB::table('thl')
        ->whereMonth('Tanggal', $this->month)
        ->get();

        $dataAbsen = array();
        $no = 1;
        for ($i=0; $i < count($absen); $i++) { 
            $dataAbsen[$i]['no'] = $no++;
            $dataAbsen[$i]['hari'] = $absen[$i]->hari;
            $dataAbsen[$i]['tanggal'] = $absen[$i]->tanggal;
            $dataAbsen[$i]['nik'] = $absen[$i]->nik;
            $dataAbsen[$i]['jam_masuk'] = $absen[$i]->jam_masuk;
            $dataAbsen[$i]['jam_keluar'] = $absen[$i]->jam_keluar;
        }
        return $dataAbsen;
    }
    public function title(): string
    {
        return 'thl';
    }

    public function headings(): array
        {
            return [
                'No',
                'Hari',
                'Tanggal',
                'NIK',
                'Jam Masuk',
                'Jam Keluar',
            ];
        }
}
