<?php

namespace App\Imports;

use App\Models\Treaty\Soa\Bordero\PremiNonMarine;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PremiNonMarineImport implements
    ToModel,
    WithStartRow,
    WithCalculatedFormulas
{
    public function  __construct($soa_id, $incoming_date)
    {
        $this->soa_id = $soa_id;
        $this->incoming_date = $incoming_date;
    }

    public function model(array $row)
    {
        return new PremiNonMarine([
            'policy_number' => $row[1],
            'insured' => $row[2],
            'period_from' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3])),
            'period_to' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])),
            'prorata' => $row[5],
            'location' => $row[6],
            'tsi' => $row[7],
            'premi' => $row[8],
            'si_or' => $row[9],
            'si_qs_spl' => $row[10],
            'rate' => $row[11],
            'premi_qs_spl' => $row[12],
            'com_qs_spl' => $row[13],
            'net_qs_spl' => $row[14],
            'net_due_to_you' => $row[15],
            'remark' => $row[16],
            'soa_id' => $this->soa_id,
            'incoming_date' => date("Y-m-d", strtotime(str_replace('/', '-', $this->incoming_date))),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
