<?php

namespace App\Imports;

use App\Models\Treaty\Soa\Bordero\KlaimKredit;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KlaimKreditImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    public function  __construct($soa_id, $incoming_date)
    {
        $this->soa_id = $soa_id;
        $this->incoming_date = $incoming_date;
    }

    public function model(array $row)
    {
        return new KlaimKredit([
            'treaty_year' => $row[1],
            'bank' => $row[2],
            'participant_name' => $row[3],
            'participant_number' => $row[4],
            'born_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])),
            'age_at_contract' => $row[6],
            'age_end_contract' => $row[7],
            'bordero_month' => $row[8],
            'insurance_period' => $row[9],
            'insurance_start' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])),
            'insurance_end' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])),
            'dloss' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])),
            'cause_of_loss' => $row[13],
            'plafond' => $row[14],
            'claim' => $row[15],
            'bank_section' => $row[16],
            'jamkrida_kalbar_section' => $row[17],
            'reinsurance_section' => $row[18],
            'soa_id' => $this->soa_id,
            'incoming_date' => date("Y-m-d", strtotime(str_replace('/', '-', $this->incoming_date))),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
