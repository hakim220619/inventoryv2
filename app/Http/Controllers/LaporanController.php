<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    function view()
    {
        $data['title'] = "Laporan";
        return view('backend.laporan.view', $data);
    }
    public function load_data()
    {
        $request = Request();
        // dd($request->all());
        $data = DB::select("select * from transaksi where tujuan = '$request->gudang'");
        echo json_encode($data);
    }
    public static function process(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', -1);

        $SpreadSheet = new Spreadsheet();

        $key = 0;
        $title = 'Transaksi ' . $request->gedung;

        $SpreadSheet->setActiveSheetIndex($key);
        $SpreadSheet->getActiveSheet($key)->setTitle($title);
        $SpreadSheet->getProperties()
            ->setCreator(Auth::user()->full_name)
            ->setLastModifiedBy(Auth::user()->full_name)
            ->setTitle($title);

        $cells = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
            "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ"
        );

        $styleColHeader1 = [
            'font' => ['bold' => true], 'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => ['allborders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'CCCCFF']]
        ];

        $styleGrid = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED, 'color' => ['argb' => '00000000'],]]];
        $styleBorderHead = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '00000000'],]]];

        $SpreadSheet->setActiveSheetIndex($key)->setCellValue("A1", "Transaksi");
        $SpreadSheet->setActiveSheetIndex($key)->setCellValue("A2", "Gudang:");
        $SpreadSheet->setActiveSheetIndex($key)->setCellValue("B2", $request->gudang);

        $SpreadSheet->getActiveSheet($key)->getStyle('A1:B2')->getFont()->setName('Calibri');
        $SpreadSheet->getActiveSheet($key)->getStyle('A1')->getFont()->setSize(16);
        $SpreadSheet->getActiveSheet($key)->getStyle('B2')->getFont()->setSize(11);
        $SpreadSheet->getActiveSheet($key)->getStyle('A1:B2')->getFont()->setBold(true);



        $SpreadSheet->getActiveSheet($key)->getColumnDimension('A')->setWidth(15);




        $datas = DB::select("select * from transaksi where tujuan = '$request->gudang'");
        $sheet = $SpreadSheet->getActiveSheet($key);
        $sheet->setCellValue('A4', 'No Transaksi');
        $sheet->setCellValue('B4', 'Jenis Bale');
        $sheet->setCellValue('C4', 'No Bale');
        $sheet->setCellValue('D4', 'Gross');
        $sheet->setCellValue('E4', 'Berat');
        $sheet->setCellValue('F4', 'Status');
        $sheet->setCellValue('G4', 'Tujuan');
        $sheet->setCellValue('H4', 'Created');
        $sheet->getStyle('A4:H4')->applyFromArray(
            $styleColHeader1
        );

        $rows = 5;
        // dd($datas);
        foreach ($datas as $da) {
            $sheet->setCellValue('A' . $rows, $da->no_transaksi);
            $sheet->setCellValue('B' . $rows, $da->jenis_bale);
            $sheet->setCellValue('C' . $rows, $da->no_bale);
            $sheet->setCellValue('D' . $rows, $da->gross);
            $sheet->setCellValue('E' . $rows, $da->berat);
            $sheet->setCellValue('F' . $rows, $da->status);
            $sheet->setCellValue('G' . $rows, $da->tujuan);
            $sheet->setCellValue('H' . $rows, $da->created_at);
            $rows++;
        }


        $SpreadSheet->getActiveSheet(0)->freezePane('A5');
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }


        $Writer = new Xlsx($SpreadSheet);
        // ob_start();
        $filetype       = "TRANSAKSI_" . time()  . ".xlsx";
        $xlsData = ob_get_contents();
        ob_end_clean();
        $export_data = $xlsData;
        $Writer->save('storage/excel/' . $filetype);
        $contents = "data:application/vnd.ms-excel;base64," . base64_encode($export_data);
        $files[] = array(
            'file_name' => $filetype,
            "file" => $contents,
        );



        if ($files) {
            $response =  array(
                'success'   => true,
                'msg'       => "Download success",
                'file'      => asset('storage/excel/' . $filetype),
                'file_name' => $files[0]['file_name']
            );
            return response($response);
        } else {
            return response(array('msg' => 'There is no data to export.'));
        }
    }
}
