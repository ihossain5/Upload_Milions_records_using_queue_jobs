<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload_file');
    }

    public function upload(Request $request)
    {
        $data = file($request->mycsv);

        $chunks = array_chunk($data, 1000);
        // $path = resource_path('temp');
        // //convert 1000 recoreds into a new csv file
        // foreach ($chunks as $key => $chunk) {
        //     $name = "/temp{$key}.csv";
        //     file_put_contents($path . $name, $chunk);
        // }


        // $files = glob("$path/*.csv");

        // $header = [];
        // foreach ($files as $key => $file) {
        //     $data = array_map('str_getcsv', file($file));
        //     if ($key === 0) {
        //         $header = $data[0];
        //         unset($data[0]);
        //     }

        //     SalesCsvProcess::dispatch($data,$header);
        //     unlink($file);

        // }

        // without make file
        $header = [];
          foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            SalesCsvProcess::dispatch($data,$header);

        }



        return 'done';
    }

    public function store()
    {




        return 'stored';
    }
}
