<?php

namespace App\Classes\Invoice;

use App\Models\PaidFile;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

/**
 * Class Bolt
 * @package App\Classes\Invoice
 */
class Product extends Batch
{
    /**
     * @inheritDoc
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     *
     * @return void
     */
    public function handle()
    {
         /** @var \App\Models\Auth\User\User $authUser */
         $authUser = auth()->user();

        if ($this->items->count() === 0) {
            return;
        }

        $this->worksheet->insertNewRowBefore($this->startRow);
        $this->worksheet
        ->getStyle(sprintf('C%1$s:N%1$s', $this->startRow))
        ->applyFromArray($this->getHeadStyles());
        $this->worksheet->setCellValue('C' . $this->startRow, 'name');
        $this->worksheet->mergeCells(sprintf('C%s:D%s', $this->startRow, $this->startRow));
        $this->worksheet->setCellValue('E' . $this->startRow, 'Quantity');
        $this->worksheet->mergeCells(sprintf('E%s:F%s', $this->startRow, $this->startRow));
        $this->worksheet->setCellValue('G' . $this->startRow, 'Specifications');
        $this->worksheet->mergeCells(sprintf('G%s:L%s', $this->startRow, $this->startRow));
        $this->worksheet->setCellValue('M' . $this->startRow, 'Unit Price');
        $this->worksheet->setCellValue('N' . $this->startRow, 'Batch Total');


        $this->startRow += 1; // after head row
        
        $this->items = $this->items->reverse();


        foreach ($this->items as $index => $item) {
            
            $this->worksheet->insertNewRowBefore($this->startRow, 9);
            if($index != (count($this->items) - 1)){
                $styleArray = [
                    // 'borders' => [
                    //     'left' => [
                    //         'borderStyle' => Border::BORDER_DOUBLE,
                    //         'color' => ['argb' => '0000000'],
                    //     ],
                    //     'top' => [
                    //         'borderStyle' => Border::BORDER_DOUBLE,
                    //         'color' => ['argb' => '0000000'],
                    //     ],
                    //     'right' => [
                    //         'borderStyle' => Border::BORDER_DOUBLE,
                    //         'color' => ['argb' => '0000000'],
                    //     ],
                    //     'bottom' => [
                    //         'borderStyle' => Border::BORDER_DOUBLE,
                    //         'color' => ['argb' => '0000000'],
                    //     ],
                    // ],
                ];
                $this->worksheet->getStyle(sprintf('C%s:N%s', $this->startRow, 8 ))
                ->applyFromArray($styleArray);
            }

            foreach ($this->worksheet->getRowIterator($this->startRow, 9) as $row) {
                $green = false;
                // Column C
                $this->worksheet->mergeCells(sprintf('C%s:D%s', $this->startRow, $endRange = $this->startRow + 8));
                $this->worksheet->setCellValue(sprintf('C%s', $this->startRow), $item->prod_name ?? '');

                // Column E, F
                $this->worksheet->mergeCells(sprintf('E%s:F%s', $this->startRow, $this->startRow + 8));
                $this->worksheet->setCellValue(sprintf('E%s', $this->startRow), $item->qty ?? '');

                // Columns G .. L, 
                $array = explode("<br>", $item->prod_desc);
                $output = "";
                for($i=0; $i< count($array); $i++){
                    $output = $output.' - '.$array[$i]."\n";
                }
                
                if (isset($item->logofile)){
                    $output = $output.'- Custom logo: ' . $item->logofile."\n";
                }

                $this->worksheet->mergeCells(sprintf('G%s:L%s', $this->startRow, $this->startRow + 8));
                $this->worksheet->setCellValue(sprintf('G%s', $this->startRow), $output );

                // Column M
                $this->worksheet->mergeCells(sprintf('M%s:M%s', $this->startRow, $this->startRow + 8));
                // $this->worksheet->setCellValue(sprintf('M%s', $this->startRow), $item->price);
                $this->worksheet->setCellValue(sprintf('M%s', $this->startRow), 'N/A');

                // Column N
                $this->worksheet->mergeCells(sprintf('N%s:N%s', $this->startRow, $this->startRow + 8));
                // $this->worksheet->setCellValue(sprintf('N%s', $this->startRow), $item->total);
                $this->worksheet->setCellValue(sprintf('N%s', $this->startRow), 'N/A');
            
            }
        }
        // ------------- Set styles --------------

        $offset = $this->startRow + ($this->items->count() * 9);


        // start + count bearings * 8(count rows in single item)
        $range = sprintf(
            'C%s:N%s', 
            $this->startRow,
            $offset - 1
        ); 

        $styles = $this->worksheet->getStyle($range);
        // set fill bg
        $styles
            ->getFill()
            ->setFillType(Fill::FILL_NONE);
        // set color and size inner cell
        $styles
            ->getFont()
            ->setSize(10)
            ->getColor()
            ->setARGB(Color::COLOR_BLACK);
        // set aligment inner cell
        $styles
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setWrapText(true);

        $rangeCurrency = sprintf(
            'M%s:N%s', 
            $this->startRow,  
            $offset - 1
        );
        // set currency format for cells
        $this->worksheet->getStyle($rangeCurrency)
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        $this->worksheet->getStyle(sprintf('C%s:N%s', $this->startRow - 1, $this->startRow - 1))
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d9d9d9');

        $this->worksheet->getStyle(sprintf('C%s:N%s', $this->startRow - 1, $this->startRow - 1))
                ->getFont()
                ->setSize(10)
                ->setBold( true )
                ->getColor()
                ->setARGB(Color::COLOR_BLACK);
        $this->worksheet
            ->getRowDimension($this->startRow - 1)
            ->setRowHeight(20);

        return $this;
    }
}