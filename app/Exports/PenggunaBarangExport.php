<?php

namespace App\Exports;

use App\Models\PenggunaanBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PenggunaBarangExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PenggunaanBarang::select('id', 'nama_barang', 'qty', 'harga', 'supplier', 'status', 'waktu_beli')->get();
    }

   public function headings(): array
   {
      return [
         'ID',
         'Nama Barang',
         'Qty',
         'Harga',
         'Supplier',
         'Status',
         'Waktu Beli',
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
            $event->sheet->getColumnDimension('E')->setAutoSize(true);
            $event->sheet->getColumnDimension('F')->setAutoSize(true);
            $event->sheet->getColumnDimension('G')->setAutoSize(true);

            $event->sheet->insertNewRowBefore(1, 2);
            $event->sheet->mergeCells('A1:G1');
            $event->sheet->setCellValue('A1', 'Data Pengguna Barang');
            $event->sheet->getStyle('A1')->getFont()->setSize(14);
            $event->sheet->getStyle('A1')->getFont()->setBold(true);
            $event->sheet->getStyle('A3:G3')->getFont()->setBold(true);
            $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

            $event->sheet->getStyle('A3:G' . $event->sheet->getHighestRow())->applyFromArray([
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
