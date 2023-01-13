<?php
 
namespace App\Exports;
 
use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BarangExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::all();
    }

    public function headings(): array
    {
        return 
        [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Satuan',
            'Harga Jual',
            'Set Ukuran',
            'Hpp',
            'Status',
        ];
    }

    public function registerEvents(): array
        {
            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'background' => [
                    'color'=> '#3F4095'
                ]
            ];
                    
                
                
                return [
                    AfterSheet::class    => function(AfterSheet $event) use ($styleArray)
                    {
                        $cellRange = 'A1:I1'; // All headers
                        //$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                        $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray);
                        $event->sheet->getStyle('A1:I1')->ApplyFromArray($styleArray);
                        $event->sheet->getStyle('F:H')->ApplyFromArray($styleArray);
                    },
                ];
       }
    

}