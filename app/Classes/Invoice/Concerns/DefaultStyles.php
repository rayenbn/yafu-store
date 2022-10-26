<?php

namespace App\Classes\Invoice\Concerns;

use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

trait DefaultStyles
{
    /**
     * Get default head styles
     *
     * @return array
     */
    protected function getHeadStyles()
    {
        return [
            'font' => [
                'size' => 10,
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'D9D9D9',
                ],
            ],
            // 'borders' => [
            //     'left' => [
            //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
            //         'color' => ['argb' => '0000000'],
            //     ],
            //     'top' => [
            //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
            //         'color' => ['rgb' => '000000'],
            //     ],
            //     'right' => [
            //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
            //         'color' => ['argb' => '0000000'],
            //     ],
            //     'bottom' => [
            //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
            //         'color' => ['argb' => '0000000'],
            //     ],
            // ],
        ];
    }
}