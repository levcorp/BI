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
    public function __construct(string $last, string $next){
        $this->last=$last;
        $this->next=$next;
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
            $date->BillToCustomerName,
            $date->BillToAddres1,
            $date->BillToAddress2,
            $date->BillToCity,
            $date->BillToRegionState,
            $date->BillToPostalCode,
            $date->BillToCountry,
            $date->BillToCustomerAccountNumber,
            $date->BillToNationalID,
            $date->BillToRACustomerID,
            $date->BillToDistributorContactSalesPerson,
            $date->ShipToCustomerName,
            $date->ShipToAddress1,
            $date->ShipToAddress2,
            $date->ShipToCity,
            $date->ShipToRegionState,
            $date->ShipToPostalCode,
            $date->ShipToCountry,
            $date->ShipToCustomerAccountNumber,
            $date->ShipToNationalID,
            $date->ShipToRACustomerID,
            $date->ShiptoDistributorContactSalesPerson,
            $date->SoldToCustomerName,
            $date->SoldToAddress1,
            $date->SoldToAddress2,
            $date->SoldToCity,
            $date->SoldToRegionState,
            $date->SoldToPostalCode,
            $date->SoldToCountry,
            $date->SoldToCustomerAccountNumber,
            $date->SoldToNationalID,
            $date->SoldToRACustomerID,
            $date->SoldToDistributorContactSalesPerson,
            $date->VendorsPartNumber,
            $date->VendorsCatalogNumber,
            $date->BuyerPartNumber,
            $date->UPCGTIN,
            $date->PartNumberDescription,
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
                $count=(int)($this->gposClass->count())+1;
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
    public function collection()
    {
        $gpos = GPOS::whereDate('DocDate','>=',$this->last)->whereDate('DocDate','<=',$this->next)->get();
        return $this->gposClass->gpos($gpos);
    }
}


