<?php
 
namespace App\Exports;
 
use App\Models\Konsumen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KonsumenExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Konsumen::all();
    }

    public function headings(): array
    {
        return 
        [
            'Id',
            'No Konsumen',
            'Nama Konsumen',
            'No Hp',
            'Kota',
            'Alamat',
            'Tgl Join',
            'Segmentasi',
            'Member',
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
                    },
                ];
       }
    

}