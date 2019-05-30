<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Text\EDIGPOS;
use Carbon\Carbon;
use App\GPOS;

class GposExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
    use Exportable;
    protected $last;
    protected $next;
    protected $gposClass;
    protected $gpos;
    public function __construct(string $last, string $next){
        $this->gpos = GPOS::whereDate('DocDate','>=',$last)->whereDate('DocDate','<=',$next)->get();
        $this->gposClass=new EDIGPOS;
        return $this;
    }
    public function headings(): array
    {
        return [
            'Ship From Distributor DUNS+4',
            'Report From Di s tri butor DUNS+4',
            'Bill To Customer Name',
            'Bill To Addres s1',
            'Bill To Address 2',
            'Bill To City',
            'Bill To Region / State',
            'Bill To Postal Code',
            'Bill To Country',
            'Bill To Customer Account Number',
            'Bill To National ID',
            'Bill To RA Customer ID',
            'Bill To Distributor Contact /Sales Person',
            'Ship To Customer Name',
            'Ship To Address 1',
            'Ship To Address 2',
            'Ship To City',
            'Ship To Region / State',
            'Ship To Postal Code',
            'Ship To Country',
            'Ship To Customer Account Number',
            'Ship To National ID',
            'Ship To RA Customer ID',
            'Ship to Distributor Contact / Sales Person',
            'Sold To Customer Name',
            'Sold To Address 1',
            'Sold To Address 2',
            'Sold To City',
            'Sold To Region / State',
            'Sold To Postal Code',
            'Sold To Country',
            'Sold To Customer Account Number',
            'Sold To National ID',
            'Sold To RA Customer ID',
            'Sold To Distributor Contact / Sales Person',
            'Vendors Part Number',
            'Vendors Catalog Number',
            'Buyers Part Number',
            'UPC (14 digit) – GTIN',
            'Part Number Description',
            'Product Code',
            'Serial Number',
            'Quantity',
            'Extended Resale',
            'Extended Cost',
            'Currency of Transaction',
            'Customer PO Number',
            'Distributor Invoice Number',
            'Distributor Invoice Item',
            'Distributor Invoice Date',
            'Agreement Number',
            'Customer Order Date',
            'Customer Want Date',
            'Customer Ship Date',
            'RA Order Number',
            'RA Order Line Item Number',
        ];
    }
    public function map($date): array
    {
        return [
            $date["ShipFromDistributorDUNS+4"],
            $date["ReportFromDistributorDUNS+4"],
            $this->gposClass->charters($date->BillToCustomerName),
            $this->gposClass->charters($date->BillToAddress1),
            $this->gposClass->charters($date->BillToAddress2),
            $this->gposClass->charters($date->BillToCity),
            $date->BillToRegionState,
            $date->BillToPostalCode,
            $date->BillToCountry,
            $date->BillToCustomerAccountNumber,
            $date->BillToNationalID,
            $date->BillToRACustomerID,
            $this->gposClass->charters($date->BillToDistributorContactSalesPerson),
            $this->gposClass->charters($date->ShipToCustomerName),
            $this->gposClass->charters($date->ShipToAddress1),
            $this->gposClass->charters($date->ShipToAddress2),
            $this->gposClass->charters($date->ShipToCity),
            $date->ShipToRegionState,
            $date->ShipToPostalCode,
            $date->ShipToCountry,
            $date->ShipToCustomerAccountNumber,
            $date->ShipToNationalID,
            $date->ShipToRACustomerID,
            $this->gposClass->charters($date->ShiptoDistributorContactSalesPerson),
            $this->gposClass->charters($date->SoldToCustomerName),
            $this->gposClass->charters($date->SoldToAddress1),
            $this->gposClass->charters($date->SoldToAddress2),
            $this->gposClass->charters($date->SoldToCity),
            $date->SoldToRegionState,
            $date->SoldToPostalCode,
            $date->SoldToCountry,
            $date->SoldToCustomerAccountNumber,
            $date->SoldToNationalID,
            $date->SoldToRACustomerID,
            $this->gposClass->charters($date->SoldToDistributorContactSalesPerson),
            $date->VendorsPartNumber,
            $date->VendorsCatalogNumber,
            $date->BuyerPartNumber,
            $date->UPCGTIN,
            $this->gposClass->charters($date->PartNumberDescription),
            $date["Product Code"],
            $date->SerialNumber,
            $date->Quantity,
            $date->ExtendedResale,
            $date->ExtendedCost,
            $date->CurrencyOfTransaction,
            $date->CustomerPONumber,
            $this->gposClass->DistributorInvoiceNumber($date->DistributorInvoiceNumber,$date->NumAtCard),
            $date->NumLine,
            $date->DistributorInvoiceDate,
            $date->AgreementNumber,
            $date->CustomerOrderDate,
            $date->CustomerWantDate,
            $date->CustomerShipDate,
            $date->RAOrderNumber,
            $date->RAOrderLineItemNumber,
        ];
    }
    public function registerEvents(): array
    {   
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $count=(int)($this->gposClass->gpos($this->gpos)->count())+1;
                $color='4F81BD';
                $cellRange = 'A1:BD1'; 
                $event->sheet->getStyle($cellRange)
                             ->getFont()
                             ->setSize(12)
                             ->setBold(true)
                             ->getColor()
                             ->setARGB('FFFFFF');
                $event->sheet->getStyle('A2:BD'.$count)
                             ->getBorders()
                             ->getAllBorders()
                             ->setBorderStyle(Border::BORDER_THIN)
                             ->getColor()
                             ->setARGB($color);
                $event->sheet->getStyle($cellRange)->getFill()
                             ->setFillType(Fill::FILL_SOLID)
                             ->getStartColor()
                             ->setARGB($color);
                $event->sheet->getStyle($cellRange)
                             ->getAlignment()
                             ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
    public function collection(){
        return $this->gposClass->gpos($this->gpos);
    }
}


