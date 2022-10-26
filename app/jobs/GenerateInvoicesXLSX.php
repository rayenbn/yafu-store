<?php
namespace App\Jobs;

use App\Classes\Enum\Delivery;
use App\Models\Auth\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Order;
use App\Models\ShippingBatch\ShippingBatch;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class GenerateInvoicesXLSX implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * Path to template xlsx
     * @var string $pathTemplate
     */
    protected $pathTemplate;

    /**
     * List orders
     * @var Collection $orders
     */
    private $products;


    /**
     * List shipping batch
     * Collection $shippingBatches
     */
    protected $shippingBatch;

    /**
     * Working spreadsheet
     * @var \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     */
    protected $spreadsheet;

    /**
     * @var Xlsx writer
     */
    protected $writer;

    /**
     * Generated invoice number
     * @var string $invoiceNumber
     */
    protected $invoiceNumber;

    /**
     * Auth user
     * @var User $user
     */
    protected $user;

    /**
     * Count fees
     * @var int $countFees
     */
    protected $countFees = 0;

    /**
     * Drawing object
     * @var Drawing $drawing
     */
    protected $drawing;

    protected $finalAmount = 0;

    protected $date;

    /**
     * If some order contain promocode
     * boolean $hasPromocode
     */
    protected $hasPromocode = false;

    /**
     * Reward for promocode
     *
     * @var int $rewardPromocode
     */
    protected $rewardPromocode = 0;

    /**
     * @var int
     */
    private $startBatch = 15;

    /**
     * @var int
     */
    private $startDelivery = 15;

    /**
     * @var int
     */
    protected $totalQuantity = 0;

    public function __construct($products,  $userInfo = null)
    {
        $this->products = $products;
        $this->pathTemplate = storage_path('app/xlsx/invoices.xlsx');
        $this->user = $userInfo ?? auth()->user();
        $this->spreadsheet = IOFactory::createReader('Xlsx')->load($this->pathTemplate);
        $this->invoiceNumber = invoice_number();
        $this->setPropertiesSheet();
        $this->writer = new Xlsx($this->getSpreadsheet());
        $this->drawing = new Drawing();
        $this->date = time();
    }
    
    /**
     * Execute the job.
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     *
     * @return void
     */
    public function handle()
    {
        $this->drawing->setName('yafu-pet-toys.com');
        $this->drawing->setDescription('yafu-pet-toys.com');
        $this->drawing->setPath(public_path('/theme/logo.png'));
        $this->drawing->setCoordinates('L4');
        $this->drawing->setOffsetY(0);
        $this->drawing->setOffsetX(0);
        $this->drawing->setWidth(164);
        $this->drawing->setHeight(30);
        $this->drawing->setWorksheet($this->getActiveSheet());
        $batches = [
            \App\Classes\Invoice\Product::class => $this->products,
        ];

        // Filter filled batches
        $batches = array_filter($batches, function (Collection $batch) {
           return $batch->count() > 0;
        });

        foreach ($batches as $batch => $items) {
            $this->finalAmount += $items->sum('total');
            $this->totalQuantity += $items->sum('quantity');

            /** @var \App\Classes\Invoice\Batch $batchEntry */
            $batchEntry = new $batch($this->getActiveSheet(), $items);
            $batchEntry->setStartRow($this->startBatch)->handle();

            $offset = ($items->count() * 9) + 1;
            //  if($batch == 'App\\Classes\\Invoice\\Bolt')
            //      $offset += count($this->bolts)*2;
         
            $this->startBatch += $offset;
            $this->startDelivery += $offset;
        }

        // $this->setDeliveryCells()
        //     ->setDiscountRow()
        //     ->setSeparateCell()
        //     ->write();
        $this->setSeparateCell()
        ->write();
    }
    
    private function setPropertiesSheet()
    {
        $this->getActiveSheet()->setTitle($this->invoiceNumber, false);
        $this->spreadsheet->getProperties()->setCreator(env('APP_NAME', 'AFStore'));
    }

    /**
     * Get active worksheet
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     *
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    protected function getActiveSheet()
    {
        return $this->spreadsheet->getActiveSheet();
    }

    public function getSpreadsheet()
    {
        return $this->spreadsheet;
    }

    public function setStartTextBold($textBold, $text, $green = false)
    {
        $richText = new RichText();
        if(false){ //$green == true
            if($textBold != ''){
                $richText
                ->createTextRun($textBold)
                ->getFont()
                ->setSize(10)
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN ))
                ->setBold(true);
            }
            $richText->createTextRun($text)
                ->getFont()
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN ))
                ->setSize(10);
        }
        else{
            if($textBold != ''){
                $richText
                ->createTextRun($textBold)
                ->getFont()
                ->setSize(10)
                ->setBold(true);
            }

            $richText->createTextRun($text)
                ->getFont()
                ->setSize(10);
        }
        

        return $richText;
    }

    protected function getStylesRange(string $range)
    {
        return $this->getActiveSheet()->getStyle($range);
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @return $this
     */
    protected function setSeparateCell()
    {
        // Set total cells
        $startTotal = $this->startDelivery + $this->countFees + ($this->hasPromocode ? 1 : 0);
        
        $this->getActiveSheet()->insertNewRowBefore($startTotal);

        $this->getActiveSheet()->getStyle(sprintf('C%s:N%s', $startTotal, $startTotal + 1))->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ],
            ],
            // 'borders' => [
            //     'left' => [
            //         'borderStyle' => Border::BORDER_DOUBLE,
            //         'color' => ['rgb' => '000000'],
            //     ],
            //     'top' => [
            //         'borderStyle' => Border::BORDER_DOUBLE,
            //         'color' => ['rgb' => '000000'],
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
        ]);

        $startTotal += 1;

        $this
            ->getActiveSheet()
            ->setCellValue('G7', 'First and Lastname: ' . (isset($this->user) ? $this->user->name : ''))
            ->setCellValue('G8', 'Email Address: ' . (isset($this->user) ? $this->user->email : ''))
            ->setCellValue('G9', 'Cellphone Number:' . (isset($this->user) ? $this->user->phone_num : ''))
            ->setCellValue('G10', 'Company Name:' . (isset($this->user) ? $this->user->company_name : ''))
            ->setCellValue('G12', 'European Vat ID (only for EU companies):')
            ->setCellValue('E7', $this->invoiceNumber)
            ->setCellValue('E8', Date::PHPToExcel($this->date))
            ->getRowDimension(4)
            ->setRowHeight(40);
        if(gettype($this->date) == 'integer')
            $this->getStylesRange('E8')->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        

        $shipinfo = \App\User::query()
            ->selectRaw(
                "*, CONCAT_WS(', ', country, address, countryCode) as fulladdress"
            )
            ->where('id', (string) (auth()->check() ? $this->user->id : csrf_token()))
            ->first();

        $this->getActiveSheet()->getRowDimension($startTotal)->setRowHeight(25);
        $this
            ->getActiveSheet()
            ->mergeCells(sprintf('K%1$s:M%1$s', $startTotal))
            ->setCellValue('K' . $startTotal, 'Final amount in USD:')
            ->setCellValue('N' . $startTotal, $this->finalAmount -= $this->rewardPromocode);

        // Total styles
        $this->getActiveSheet()->getStyle(sprintf('K%1$s:N%1$s', $startTotal))
            ->getFont()
            ->setSize(16)
            ->setBold(true);

        $this->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

        $this->getStylesRange(sprintf('N%1$s:N%2$s', $startTotal, $startTotal + 5))
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

            $this->getActiveSheet()->getStyle(sprintf('C%s:N%s', $startTotal , $startTotal + 20))
            ->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'ffffff'
                    ],
                ],
                // 'borders' => [
                //     'left' => [
                //         'borderStyle' => Border::BORDER_DOUBLE,
                //         'color' => ['rgb' => '000000'],
                //     ],
                //     'top' => [
                //         'borderStyle' => Border::BORDER_DOUBLE,
                //         'color' => ['rgb' => '000000'],
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
            ]);

        if ($shipinfo) {
            $this
                ->getActiveSheet()
                ->setCellValue('G11', 'Invoice Address: ' . $shipinfo->country)
                ->setCellValue('C' . $shipsStart = $startTotal + 3, 'Shipping Address: ')
                ->setCellValue('C' . ($shipsStart + 1), 'Company Name: ' . $shipinfo->company_name)
                ->setCellValue('C' . ($shipsStart + 2), 'First + Lastname: ' . $this->user->name)
                ->setCellValue('C' . ($shipsStart + 3), 'Shipping Address: ' . $shipinfo->fulladdress)
                ->setCellValue('C' . ($shipsStart + 4), 'Cellphone Number: ' . $shipinfo->phone);
        }

      
        // Bank info head styles
        $this->getActiveSheet()
            ->getStyle(sprintf('C%1$s:N%1$s', $startTotal + 10))
            ->applyFromArray([
                'font' => [
                    'size' => 12,
                    'bold' => true,
                    'color' => [
                        'argb' => Color::COLOR_BLACK,
                    ]
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'F2F2F2',
                    ],
                ],
            ]);

        // recieent red color
        $this->getActiveSheet()
            ->getStyle(sprintf('C%1$s:N%1$s', $startTotal + 13))
            ->applyFromArray([
                'font' => [
                    'size' => 12,
                    'bold' => false,
                    'color' => [
                        'argb' => Color::COLOR_RED,
                    ]
                ],
            ]);
        

            // footer info styles
        $this->getActiveSheet()->getStyle(sprintf('B%s:O%s', $startTotal + 18 , $startTotal + 20))
        ->applyFromArray([
            'font' => [
                'size' => 11,
                'bold' => false,
                'color' => [
                    'rgb' => '808080',
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff',
                ],
            ],
            // 'borders' => [
            //     'bottom' => [
            //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
            //         'color' => ['rgb' => '000000'],
            //     ],
            // ],
        ]);
        

        $this
            ->getActiveSheet()
            ->setCellValue('C' . $shipsStart = $startTotal + 10, 'BANK INFORMATION: USD ACCOUNT ')
            ->setCellValue('C' . ($shipsStart + 2), 'NAME OF THE BANK: ')
            ->setCellValue('F' . ($shipsStart + 2),  'BANK OF JINHUA')
            
            ->setCellValue('C' . ($shipsStart + 3), 'RECIPIENT: ')
            ->setCellValue('F' . ($shipsStart + 3), 'MEILA TRADING COMPANY LIMITED')

            ->setCellValue('C' . ($shipsStart + 4), 'USD ACCOUNT IBAN: ')
            ->setCellValue('F' . ($shipsStart + 4), 'NRA1456993009000304')

            ->setCellValue('C' . ($shipsStart + 5), 'BIC / SWIFT: ')
            ->setCellValue('F' . ($shipsStart + 5), 'JHCBCNBJ')

            // ->setCellValue('C' . ($shipsStart + 6), 'BIC / SWIFT: ')
            // ->setCellValue('F' . ($shipsStart + 6), '   ')


            ->setCellValue('J' . $shipsStart = $startTotal + 10, 'BANK INFORMATION: EURO ACCOUNT ')
            ->setCellValue('J' . ($shipsStart + 2), 'BENEFICIARY NAME :')
            ->setCellValue('k' . ($shipsStart + 2), 'MEILA TRADING COMPANY LIMITED. ')

            ->setCellValue('J' . ($shipsStart + 3), 'A/C NO: ')
            ->setCellValue('k' . ($shipsStart + 3), 'NRA3856993009000132')

            ->setCellValue('J' . ($shipsStart + 4), 'Bank Add: ')
            ->setCellValue('k' . ($shipsStart + 4), 'No258-28 CHENGBEI ROAD YIWU CHINA.')

            ->setCellValue('J' . ($shipsStart + 5), ' SWIFT CODE:')
            ->setCellValue('k' . ($shipsStart + 5), 'YZBKCN2N')

            ->setCellValue('J' . ($shipsStart + 5), 'BENEFICIARY BANK: ')
            ->setCellValue('k' . ($shipsStart + 5), 'YINZHOU BANK.')

            // ->setCellValue('C' . ($shipsStart + 8), 'The terms and conditions stated on yafu-pet-toys.com apply to this invoice ')
            ;

        return $this;
    }

    /**
     * @return array
     */
    // private function prepareFees()
    // {
    //     $fees = [];
    //     $sum_fees = 0;
    //     $weight = 0;
    //     $stockWeight = 0;

    //     $batches = [
    //         \App\Classes\Batch\Deck::class => $this->orders,
    //         \App\Classes\Batch\GripTape::class => $this->grips,
    //         \App\Classes\Batch\Wheel::class => $this->wheels,
    //         \App\Classes\Batch\Bearing::class => $this->bearings,
    //         \App\Classes\Batch\HeatTransfer::class => $this->transfers,
    //         \App\Classes\Batch\Bolt::class => $this->bolts,
    //         \App\Classes\Batch\Truck::class => $this->trucks,
    //         \App\Classes\Batch\HeatMachine::class => $this->heatMachines,
    //         \App\Classes\Batch\CustomProduct::class => $this->customProducts,
    //     ];

    //     foreach ($batches as $class => $batch) {
    //         if (empty($batch)) { continue; }

    //         /** @var \App\Classes\Batch\Batch $batchEntry */
    //         $batchEntry = new $class($batch);

    //         $fees = array_merge($fees, $batchEntry->buildUploads());
    //         $weight += $batchEntry->getDeliveryWeigh();
    //     }

    //     // added for only batchs that has retail sell (as stock decks)
    //     $stock_batches = [
    //         \App\Classes\Batch\Deck::class => $this->orders->where('quantity', '<' , 50),
    //     ];
    //     foreach ($stock_batches as $class => $batch) {
    //         if (empty($batch)) { continue; }

    //         /** @var \App\Classes\Batch\Batch $batchEntry */
    //         $batchEntry = new $class($batch);

    //         // calculate stock deck delivery weight 
    //         $stockWeight += $batchEntry->getDeliveryWeigh();
    //     }

    //     $weight = round( $weight, 2);
    //     $stockWeight = round( $stockWeight, 2);

    //     // $shippingBatch = ShippingBatch::auth()->where('usenow', 1)->first();
    //     $fees['global'] = [];
    //      // Set Global delivery
    //      if ( $this->shippingBatch && $this->shippingBatch->count()){
   
    //             array_push($fees['global'], [
    //                 'image' => auth()->check() ? $this->shippingBatch->shipping_weight . ' KG' : 'show weight',
    //                 'batches' => 'Shipping Batch',
    //                 'price' => $this->shippingBatch->total,
    //                 'type' => $this->shippingBatch->shipping_term,
    //             ]);
            
    //     }else if ($stockWeight > 0){
            
    //         array_push($fees['global'], [
    //             'image' => auth()->check() ? $stockWeight . ' KG' : 'show weight',
    //             'batches' => 'Stock Decks',
    //             // 'price' => 0, //added for hidding the fright cost
    //             // 'type' => 'Term: ExWorks, China.'//added for hidding the fright cost
    //             'price' => get_global_delivery($stockWeight),
    //             'type' => $stockWeight <= 110 ? 'Worldwide 10-day Airfreight (Only for stock decks)' : 'Ocean Freight'
    //         ]);
    //     }else{
    //         array_push($fees['global'], [
    //             'image' => auth()->check() ? $weight . ' KG' : 'show weight',
    //             'batches' => '',
    //             'price' => 0, //added for hidding the fright cost
    //             'type' => 'Term: ExWorks, China.'//added for hidding the fright cost
    //             // 'price' => get_global_delivery($weight),
    //             // 'type' => $weight <= 110 ? 'Worldwide 10-day Airfreight' : 'Ocean Freight'
    //         ]);
    //     }

    //     // Calculate total price
    //     foreach ($fees as $key => $value) {
    //         array_walk($value, function($f, $k) use(&$sum_fees){
    //             $sum_fees += $f['price'];
    //         });
    //     }
    //     return [$fees, $sum_fees];
    // }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @return $this
     */
    // protected function setDeliveryCells()
    // {
    //     // Prepare orders design
    //     list($orderFees, $feesTotal) = $this->prepareFees();

    //     //$this->countFees = $this->calculateFees($orderFees);

    //     // Plus total delivery price, with global delivery
    //     $this->finalAmount += $feesTotal;

    //     $this->getActiveSheet()->mergeCells(sprintf('C%1$s:I%1$s', $this->startDelivery));
    //     $this->getActiveSheet()->mergeCells(sprintf('J%1$s:M%1$s', $this->startDelivery));
    //     $this->getActiveSheet()->setCellValue('C' . $this->startDelivery, 'One Time Fees');
    //     $this->getActiveSheet()->setCellValue('J' . $this->startDelivery, 'Filename');
    //     $this->getActiveSheet()->setCellValue('N' . $this->startDelivery, 'Total of row');

    //     // Delivery head styles
    //     $this->getActiveSheet()
    //         ->getStyle(sprintf('C%1$s:N%1$s', $this->startDelivery))
    //         ->applyFromArray([
    //             'font' => [
    //                 'size' => 10,
    //                 'bold' => false,
    //                 'color' => [
    //                     'argb' => Color::COLOR_WHITE,
    //                 ]
    //             ],
    //             'fill' => [
    //                 'fillType' => Fill::FILL_SOLID,
    //                 'startColor' => [
    //                     'rgb' => '52A3F1',
    //                 ],
    //             ],
    //         ]);

    //     // Skip head uploads
    //     $this->startDelivery += 2;
    //     $fileUploads = [];
    //     array_walk($orderFees, function($fees) use (&$fileUploads){
    //         array_push($fileUploads, ...array_values($fees));
    //     });
    //     $array_index = 0;
    //     foreach ($fileUploads as $index => $value) {
    //         if($value['price'] > 0)
    //             $array_index ++;
    //     }
    //     // Insert rows = count uploads
    //     $this
    //         ->getActiveSheet()
    //         ->insertNewRowBefore(
    //             $this->startDelivery,
    //             $array_index - 1
    //         );

    //     $rangeFees = sprintf(
    //         'C%s:N%s',
    //         $this->startDelivery,
    //         $this->startDelivery + $array_index - 1
    //     );

    //     $styles = $this->getActiveSheet()->getStyle($rangeFees);

    //     // set fill bg
    //     $styles->getFill()->setFillType(Fill::FILL_NONE);
    //     // set color inner cell
    //     $styles->getFont()->setSize(10)->getColor()->setARGB(Color::COLOR_BLACK);
    //     // set currency format cell
    //     $styles->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        
    //     $array_index = 0;
    //     foreach ($fileUploads as $index => $value) {
    //         if($value['price'] > 0 || $value['type'] == 'Term: ExWorks, China.' || $value['batches'] == 'Shipping Batch' || $value['batches'] == 'Stock Decks'){
    //             $this->getActiveSheet()->mergeCells(sprintf('C%s:I%s', $pos = $this->startDelivery + $array_index, $pos));
    //             $this->getActiveSheet()->mergeCells(sprintf('J%s:M%s', $pos, $pos));

    //             // if($value['batches'] == 'Shipping Batch'){
    //             //     if (isset($value['price']) && $value['price'] > 0){// to check which shipping terms should be used
    //             //         $this->getActiveSheet()->setCellValue('C' . $pos, $value['type']);
    //             //     }else{//(if price is 0 ship term is EXW)
    //             //         $this->getActiveSheet()->setCellValue('C' . $pos, 'Term: ExWorks, China.');
    //             //     }
    
    //             //     if ($value['price'] > 0){
    //             //         $this->getActiveSheet()->setCellValue('N' . $pos, $value['price']);
    //             //     }else{
    //             //         $this->getActiveSheet()->setCellValue('N' . $pos, 'dede'); 
    //             //     }
    
    //             //     if(isset($value['paid'])) {
    //             //         $this->getActiveSheet()->setCellValue('J' . $pos, $this->setStartTextBold('', $value['image'], true)); //desactivate green color
    //             //     } else {
    //             //         if (isset($value['image']) && $value['image'] > 0){
    //             //             $this->getActiveSheet()->setCellValue('J'. $pos, $value['image']);
    //             //         }else{
    //             //             $this->getActiveSheet()->setCellValue('J'. $pos, '');
    //             //         }
    //             //     }
    //             // }else{
    //                 $this->getActiveSheet()->setCellValue('C' . $pos, $value['type']);

    //                 if ($value['type'] == 'Term: ExWorks, China.'){//added for hidding the fright cost
    //                     $this->getActiveSheet()->setCellValue('N' . $pos, ''); //added for hidding the fright cost
    //                 }else{
    //                     $this->getActiveSheet()->setCellValue('N' . $pos, $value['price']);
    //                 }

    //                 if(isset($value['paid'])) {
    //                     $this->getActiveSheet()->setCellValue('J' . $pos, $this->setStartTextBold('', $value['image'], true)); //desactivate green color
    //                 } else {
    //                     $this->getActiveSheet()->setCellValue('J'. $pos, $value['image']);
    //                 }
    //             // }
    //             $array_index ++;
    //         }
    //     }
    //     $this->countFees = $array_index;
    //     return $this;
    // }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @return $this
     */
    // protected function setDiscountRow()
    // {
    //     $query = Order::query()
    //         ->whereIn('orders.id', $this->orders->pluck('id')->toArray())
    //         ->whereNotNull('promocode');
        
    //     if (! $query->count()) return $this;

    //     // Promocode is exists
    //     $this->hasPromocode = true;

    //     // Get promocode
    //     $promocode = json_decode($query->first()->promocode);

    //     /** @var \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $activeSheet */
    //     $activeSheet = $this->getActiveSheet();

    //     //  Delivery + Delivery head
    //     $activeSheet->insertNewRowBefore($this->startDelivery);
    //     $activeSheet
    //         ->getStyle(sprintf('C%1$s:N%1$s', $this->startDelivery))
    //         ->applyFromArray([
    //             'font' => [
    //                 'size' => 10,
    //                 'bold' => false,
    //                 'color' => [
    //                     'argb' => Color::COLOR_BLACK,
    //                 ]
    //             ],
    //             'fill' => [
    //                 'fillType' => Fill::FILL_NONE,
    //             ],
    //         ]);

    //     $activeSheet->mergeCells(sprintf('C%1$s:I%1$s', $this->startDelivery));
    //     $activeSheet->mergeCells(sprintf('J%1$s:M%1$s', $this->startDelivery));

    //     $activeSheet->setCellValue('C' . $this->startDelivery, "Discount");
    //     $activeSheet->setCellValue('J' . $this->startDelivery, $promocode->code);
    //     $this->rewardPromocode = $promocode->reward;

    //     $activeSheet->setCellValue('N'. $this->startDelivery, '-' . $this->rewardPromocode);

    //     return $this;
    // }
    
    public function getPathInvoice()
    {
        return storage_path("app/xlsx/invoices_" . str_slug($this->invoiceNumber, '-') . ".xlsx");
    }

    public function getInvoiceNumber()
    {
        return strtoupper(str_slug($this->invoiceNumber, '-'));
    }

    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = strtoupper(str_slug($invoiceNumber, '-'));

        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @return $this
     */
    public function write()
    {
        $this->writer->save($this->getPathInvoice());
        return $this;
    }

    /**
     * Calculate deep count fees 
     * @param array|Collection $items
     * @return int
     */
    private function calculateFees($items) 
    {
        $total = 0;

        array_walk($items, function($fees) use (&$total){
            $total += count($fees);
        });

        return $total;
    }

}