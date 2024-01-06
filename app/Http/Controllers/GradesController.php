<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GradesController extends Controller
{
    public function index(Request $request)
    {
        $departments = [
            'IT' => 'برنامج تكنولوجيا المعلومات',
            'RW' => 'برنامج تكنولوجيا السكك الحديدية',
            'SW' => 'برنامج تكنولوجيا الغزل والنسيج',
            'TAE' => 'برنامج تكنولوجيا الجرارات والمعدات الزراعية',
            'FI' => 'برنامج تكنولوجيا الصناعات الغذائية',
            'DIT' => 'برنامج تكنولوجيا تركيبات الأسنان',
            'PT' => 'برنامج تكنولوجيا الصناعات الدوائية',
            'IT-SCI' => 'برنامج تكنولوجيا المعلوماتية الصحية',
            'NAT' => 'برنامج تكنولوجيا مساعد تمريض',
        ];

        return view('welcome', compact('departments'));
    }

    private function customCsvReader($csvFilePath)
    {
        $csvFile = fopen($csvFilePath, 'r');
        $headers = fgetcsv($csvFile);

        $data = [
            'information' => [],
            'subjects' => array_slice($headers, 2),
        ];

        while (($row = fgetcsv($csvFile)) !== false) {
            $sittingNumber = $row[1];
            $name = $row[2];

            if (empty($name) && empty($sittingNumber)) {
                continue;
            }

            $studentInfo = [
                'name' => $name,
                'sitting_number' => $sittingNumber,
                'grades' => [],
            ];

            for ($i = 2; $i < count($row); $i++) {
                $subject = $headers[$i];
                $grade = (int)$row[$i];

                if (!empty($subject)) {
                    $studentInfo['grades'][$subject] = $grade;
                }
            }

            $data['information'][] = $studentInfo;
        }

        fclose($csvFile);

        return $data;
    }



    public function upload()
    {
        $departments = [
            'IT' => 'برنامج تكنولوجيا المعلومات',
            'RW' => 'برنامج تكنولوجيا السكك الحديدية',
            'SW' => 'برنامج تكنولوجيا الغزل والنسيج',
            'TAE' => 'برنامج تكنولوجيا الجرارات والمعدات الزراعية',
            'FI' => 'برنامج تكنولوجيا الصناعات الغذائية',
            'DIT' => 'برنامج تكنولوجيا تركيبات الأسنان',
            'PT' => 'برنامج تكنولوجيا الصناعات الدوائية',
            'IT-SCI' => 'برنامج تكنولوجيا المعلوماتية الصحية',
            'NAT' => 'برنامج تكنولوجيا مساعد تمريض',
        ];

        return view('pages.upload', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'csv_file' => 'required|mimes:csv',
        ]);

        $department = $request->input('department');
        $csvFilePath = $request->file('csv_file')->path();

        $this->convertCsvToJson($csvFilePath, $department);

        return redirect('/upload')->with('success', 'تم رفع الملف بنجاح.');
    }

    private function convertCsvToJson($csvFilePath, $department)
    {
        $data = $this->customCsvReader($csvFilePath);

        $jsonFileName = "{$department}.json";
        $jsonFilePath = storage_path("app/grades/{$jsonFileName}");

        if (Storage::exists($jsonFilePath)) {
            Storage::delete($jsonFilePath);
        }

        $jsonData = [
            'header' => array_keys($data['information'][0]['grades']),
            'data' => $data['information'],
        ];

        Storage::put("grades/{$jsonFileName}", json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return redirect('/upload')->with('success', 'تم رفع الملف بنجاح.');
    }

    public function show(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'sitting_num' => 'required|min:7|max:7',
        ]);

        $department = $request->input('department');
        $jsonFileContents = Storage::get("grades/{$department}.json");
        $data = json_decode($jsonFileContents, true);

        $studentResult = $this->searchInJson($data, $request->input('sitting_num'));

        return view('pages.grades', compact('studentResult'));
    }

    private function searchInJson($data, $sittingNum)
    {
        if (isset($data['data']) && is_array($data['data'])) {
            $studentInfo = collect($data['data'])->firstWhere('sitting_number', $sittingNum);

            if ($studentInfo) {
                $result = [
                    'name' => $studentInfo['name'],
                    'sitting_number' => $sittingNum,
                    'grades' => $studentInfo['grades'] ?? null,
                ];

                return $result;
            }
        }

        return null;
    }

}
