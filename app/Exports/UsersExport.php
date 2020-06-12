<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class UsersExport
    implements
        FromCollection,
        WithMapping,
        WithHeadings,
        WithColumnFormatting,
        ShouldAutoSize,
        WithCustomStartCell,
        WithEvents
{
    use Exportable;

    public function collection()
    {
        return User::all();
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at),
        ];
    }

    public function headings(): array
    {
        return [['Año','2020', '', 'Periodo', '3'], [], ['Nombre', 'Correo', 'Fecha de creación']];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_XLSX22
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->styleCells(
                    'A3:C3',
                    [
                        'font' => [
                            'bold' => true,
                            'italic' => true
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                // 'color' => ['argb' => 'FFFF0000'],
                            ],
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'color' => [
                                'argb' => 'FFA0A0A0'
                            ]
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'B1',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THICK,
                                // 'color' => ['argb' => 'FFFF0000'],
                            ],
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'color' => [
                                'argb' => Color::COLOR_YELLOW
                            ]
                        ]
                    ]
                );
            },
        ];
    }
}
