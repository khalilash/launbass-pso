<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    public function exportCsv()
    {
        $data = DB::table('pemasukan')
            ->limit(10)
            ->get();

        $filename = 'demo_export.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($data) {

            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'Jumlah']);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->Jumlah
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
