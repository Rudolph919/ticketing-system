<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class FileManipulationController extends Controller
{
    public function index()
    {
        return view('file-manipulation.index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx|max:2048',
            'order' => 'required|in:alphabetical,length',
        ]);

        if ($request->file('file')->isValid()) {
            $filePath = $request->file('file')->store('uploads'); // Store the uploaded file in the "uploads" directory

            // Read the contents of the uploaded file
            $contents = Storage::get($filePath);

            // Deduplicate the data
            $data = array_unique(explode(PHP_EOL, $contents));

            // Sort the data based on the selected order
            $order = $request->input('order');
            if ($order === 'alphabetical') {
                sort($data, SORT_STRING);
            } elseif ($order === 'length') {
                usort($data, function ($a, $b) {
                    return strlen($a) <=> strlen($b);
                });
            }

            // Create the output XLSX file
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            foreach ($data as $index => $value) {
                $sheet->setCellValue('A' . ($index + 1), $value);
            }

            $outputFilePath = 'output.xlsx'; // Set the output file path
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($outputFilePath);

            // Return the output file for download
            return response()->download($outputFilePath)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Failed to upload the file.');
    }
}
