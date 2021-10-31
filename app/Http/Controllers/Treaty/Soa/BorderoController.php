<?php

namespace App\Http\Controllers\Treaty\Soa;

use Illuminate\Http\Request;
use App\Imports\KlaimKreditImport;
use App\Imports\PremiKreditImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KlaimNonMarineImport;
use App\Imports\PremiNonMarineImport;
use App\Models\Treaty\Soa\Bordero\KlaimKredit;
use App\Models\Treaty\Soa\Bordero\PremiKredit;
use App\Models\Treaty\Soa\Bordero\KlaimNonMarine;
use App\Models\Treaty\Soa\Bordero\PremiNonMarine;

class BorderoController extends Controller
{
    public function importExcel($model, $file_name)
    {
        Excel::import($model, public_path('/bordero/' . $file_name));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
            'bordero_format' => 'required',
            'bordero_jenis' => 'required',
            'bordero_incoming_date' => 'required',
            'soa_id' => 'required',
        ]);

        if ($request->file()) {
            $file = $request->file;
            $file_name = rand() . $file->getClientOriginalName();
            $file->move('bordero', $file_name);

            $jenis = $request->bordero_jenis;
            $format = $request->bordero_format;
            $incoming_date = $request->bordero_incoming_date;
            $soa_id = $request->soa_id;

            if ($jenis == "premi" && $format == "non marine") {
                PremiNonMarine::where('soa_id', $soa_id)->each(function ($item) {
                    $item->delete();
                });
                $this->importExcel(new PremiNonMarineImport($soa_id, $incoming_date), $file_name);
            } elseif ($jenis == "premi" && $format == "marine") {
                // $this->importExcel(new PremiMarineImport, $file_name);

            } elseif ($jenis == "premi" && $format == "kredit") {
                PremiKredit::where('soa_id', $soa_id)->each(function ($item) {
                    $item->delete();
                });
                $this->importExcel(new PremiKreditImport($soa_id, $incoming_date), $file_name);
            } elseif ($jenis == "klaim" && $format == "non marine") {
                KlaimNonMarine::where('soa_id', $soa_id)->each(function ($item) {
                    $item->delete();
                });
                $this->importExcel(new KlaimNonMarineImport($soa_id, $incoming_date), $file_name);
            } elseif ($jenis == "klaim" && $format == "marine") {
                // $this->importExcel(new PremiMarineImport, $file_name);

            } elseif ($jenis == "klaim" && $format == "kredit") {
                KlaimKredit::where('soa_id', $soa_id)->each(function ($item) {
                    $item->delete();
                });
                $this->importExcel(new KlaimKreditImport($soa_id, $incoming_date), $file_name);
            } else {
                return response()->json(['message' => 'No Format Found!']);
            }
            return response()->json(['message' => 'Success']);
        }
        return response()->json(['message' => 'No File!']);
    }
}
