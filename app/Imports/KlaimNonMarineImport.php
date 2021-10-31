<?php

namespace App\Imports;

use App\Models\Treaty\Soa\Bordero\KlaimNonMarine;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KlaimNonMarineImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    public function  __construct($soa_id, $incoming_date)
    {
        $this->soa_id = $soa_id;
        $this->incoming_date = $incoming_date;
    }

    public function model(array $row)
    {
        return new KlaimNonMarine([
            'reg_number' => $row[1],
            'policy_number' => $row[2],
            'insured' => $row[3],
            'period_from' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])),
            'period_to' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])),
            'col' => $row[6],
            'claim_percentage' => $row[7],
            'cedant_share_percentage' => $row[8],
            'cedant_share_amount' => $row[9],
            'or_claim' => $row[10],
            'qs_claim' => $row[11],
            'surplus_claim' => $row[12],
            'soa_id' => $this->soa_id,
            'incoming_date' => date("Y-m-d", strtotime(str_replace('/', '-', $this->incoming_date))),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
