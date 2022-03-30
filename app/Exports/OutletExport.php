<?php

namespace App\Exports;

use App\Models\Outlet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OutletExport implements FromCollection, WithHeadings, WithEvents
{
   /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
   {
      return Outlet::select('id', 'nama', 'tlp', 'alamat')->get();
   }

   public function headings(): array
   {
      return [
         'No',
         'Nama',
         'Telepon',
         'Alamat',
      ];
   }

   public function registerEvents(): array
   {
      return [
         AfterSheet::class => function (AfterSheet $event) {
            // Membuat lebar column ABCDEF menjadi otomatis
            $event->sheet->getColumnDimension('A')->setAutoSize(true);
            $event->sheet->getColumnDimension('B')->setAutoSize(true);
            $event->sheet->getColumnDimension('C')->setAutoSize(true);
            $event->sheet->getColumnDimension('D')->setAutoSize(true);

            $event->sheet->insertNewRowBefore(1, 2);
            $event->sheet->mergeCells('A1:D1');
            $event->sheet->setCellValue('A1', 'Data Outlet');
            $event->sheet->getStyle('A1')->getFont()->setSize(14);
            $event->sheet->getStyle('A1')->getFont()->setBold(true);
            $event->sheet->getStyle('A3:D3')->getFont()->setBold(true);
            $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

            $event->sheet->getStyle('A3:D' . $event->sheet->getHighestRow())->applyFromArray([
               'borders' => [
                  'allBorders' => [
                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                     'color' => ['argb' => '000000'],
                  ],
               ],
            ]);
         },
      ];
   }
}
