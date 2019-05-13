<?php
namespace App\Text;

use App\GPOS;
use Illuminate\Support\Collection;
use Carbon\Carbon;
class EDIGPOS
{
    public function text_lp(){
        $lastMonday= new Carbon('last monday');
        Carbon::setTestNow($lastMonday);       
        $lastSunday=new Carbon('last sunday');
        $nextSaturday=new Carbon('next saturday');
        Carbon::setTestNow();             
        $gpos=GPOS::whereDate('DocDate','>=',$lastSunday)->whereDate('DocDate','<=',$nextSaturday)->get();
        $head=$this->head($lastSunday,$nextSaturday);
        $body=$this->body($this->gpos($gpos));
        return $head.$body;
    }
    public function gpos($gpos){
        $docs=$this->docs($gpos);
        $count=0;
        foreach ($docs as $item){
            $count=0;
            foreach($gpos as $dato){
                if($dato->DocNum==$item){
                    $count++;
                    $dato->NumLine=$count;
                }
            }
        }
        return $gpos;
    }
    public function docs($gpos){
        $docs=collect();
        foreach ($gpos as $item){
            $docs->push($item->DocNum);
        }
        return $docs->unique();
    }
    public function head($last,$next){
        $now=Carbon::now()->format('Ymd');
        $last=Carbon::parse($last)->format('Ymd');
        $next=Carbon::parse($next)->format('Ymd');
        $SYS=$this->etiqueta(15,'SYS','802068825').$this->etiqueta(6,'X','005010').$this->etiqueta(6,'','867').$this->etiqueta(0,'P','').PHP_EOL.
        $this->etiqueta(15,'HDR','').$this->etiqueta(8,'',$now).'USD'.$this->etiqueta(8,'',$last).$this->etiqueta(8,'',$next).$this->etiqueta(15,'','LARCOS001').$this->etiqueta(15,'','LARCOS001').$this->etiqueta(20,'','').$this->etiqueta(20,'','').PHP_EOL;
        return $SYS;
    }
    public function body($datos){
        $body="";
        $count=0;
        foreach ($datos as $dato) {
            $count++;
            $body.=////////////////////////////////////BILL///////////////////////////////////////////////////
                   /*---------Bill To Customer Name--------*/
                   $this->etiqueta(60,'DET',$dato->BillToCustomerName).
                   /*---------Bill To Address 1--------*/
                   $this->etiqueta(60,'',$dato->BillToAddres1).
                   /*---------Bill To Address 2--------*/
                   $this->etiqueta(60,'',$dato->BillToAddress2).
                   /*--------'Bill To City---------*/
                   $this->etiqueta(30,'',$dato->BillToCity).
                   /*--------'Bill To Region   State---------*/
                   $this->etiqueta(2,'',$dato->BillToRegionState).                   
                   /*--------'Bill To Postal Code---------*/
                   $this->etiqueta(10,'',$dato->BillToPostalCode).
                   /*--------'Bill To Country---------*/
                   $this->etiqueta(3,'',$dato->BillToCountry).
                   /*--------'Bill To Customer Account Number---------*/
                   $this->etiqueta(15,'',$dato->BillToCustomerAccountNumber).
                   /*-------'Bill To National ID----------*/
                   $this->etiqueta(15,'',$dato->BillToNationalID).
                   /*-------'Bill To RA Customer ID----------*/
                   $this->etiqueta(15,'',$dato->BillToRACustomerID).
                   /*------'Bill To Distributor Contact   Sales Person-----------*/
                   $this->etiqueta(15,'',$dato->BillToDistributorContactSalesPerson).
                   ////////////////////////////////////SHIP///////////////////////////////////////////////////
                   /*--------Bill To Customer Name---------*/
                   $this->etiqueta(60,'',$dato->ShipToCustomerName).
                   /*-------Ship To Address 1----------*/
                   $this->etiqueta(60,'',$dato->ShipToAddress1).
                   /*-------'Ship To Address 2----------*/
                   $this->etiqueta(60,'',$dato->ShipToAddress2).
                   /*--------Ship To City---------*/
                   $this->etiqueta(30,'',$dato->ShipToCity).
                   /*-------Ship To Region   State----------*/
                   $this->etiqueta(2,'',$dato->ShipToRegionState).
                   /*------Ship To Postal Code-----------*/
                   $this->etiqueta(10,'',$dato->ShipToPostalCode).
                   /*--------Ship To Country---------*/
                   $this->etiqueta(3,'',$dato->ShipToCountry).
                   /*-----Ship To Customer Account Number------------*/
                   $this->etiqueta(15,'',$dato->ShipToCustomerAccountNumber).
                   /*-----Ship To National ID------------*/
                   $this->etiqueta(15,'',$dato->ShipToNationalID).
                   /*--------Ship To RA Customer ID---------*/
                   $this->etiqueta(15,'',$dato->ShipToRACustomerID).
                   /*-------Ship to Distributor Contact   Sales Person----------*/
                   $this->etiqueta(15,'',$dato->ShiptoDistributorContactSalesPerson).
                   ////////////////////////////////////SOLD///////////////////////////////////////////////////
                   /*-------Sold To Customer Name----------*/
                   $this->etiqueta(60,'',$dato->SoldToCustomerName).
                   /*-------Sold To Address 1----------*/
                   $this->etiqueta(60,'',$dato->SoldToAddress1).
                   /*-------Sold To Address 2----------*/
                   $this->etiqueta(60,'',$dato->SoldToAddress2).
                   /*-------Sold To City----------*/
                   $this->etiqueta(30,'',$dato->SoldToCity).
                   /*--------Sold To Region   State---------*/                   
                   $this->etiqueta(2,'',$dato->SoldToRegionState).
                   /*-------Sold To Postal Code----------*/
                   $this->etiqueta(10,'',$dato->SoldToPostalCode).
                   /*-------Sold To Country----------*/
                   $this->etiqueta(3,'',$dato->SoldToCountry).
                   /*-------Sold To Customer Account Number----------*/
                   $this->etiqueta(15,'',$dato->SoldToCustomerAccountNumber).
                   /*------Sold To National ID-----------*/
                   $this->etiqueta(15,'',$dato->SoldToNationalID).
                   /*------Sold To RA Customer ID-----------*/
                   $this->etiqueta(15,'',$dato->SoldToRACustomerID).
                   /*-------Sold to Distributor Contact / Sales Person----------*/
                   $this->etiqueta(15,'',$dato->SoldToDistributorContactSalesPerson).
                   ////////////////////////////////////OTROS///////////////////////////////////////////////////
                   /*------Assigned ID consecutivo del detalle-----------*/
                   $this->etiqueta(5,'',$dato->NumLine).
                   /*------Part Number Description-----------*/
                   $this->etiqueta(48,'',$dato->PartNumberDescription).
                   /*-------Vendor's Part Number----------*/
                   $this->etiqueta(20,'',$dato->VendorsPartNumber).
                   /*-------UPC (14 digit) - GTIN----------*/
                   $this->etiqueta(20,'',$dato->UPCGTIN).
                   /*-------Vendor's Catalog Number----------*/
                   $this->etiqueta(20,'',$dato->VendorsCatalogNumber).
                   /*------Quantity-----------*/
                   $this->etiqueta(10,'',$dato->Quantity).
                   /*------Extended Resale-----------*/
                   $this->etiqueta(15,'',$dato->ExtendedResale).
                   /*------Extended Cost-----------*/
                   $this->etiqueta(15,'',$dato->ExtendedCost).
                   /*-------Total Transaction Amount----------*/
                   $this->etiqueta(20,'',$dato->ExtendedResale).
                   /*--------Purchase order Amount---------*/
                   $this->etiqueta(20,'',$dato->ExtendedCost).
                   /*-------Agreement Number----------*/
                   $this->etiqueta(20,'',$dato->AgreementNumber).
                   /*-------Customer PO Number----------*/
                   $this->etiqueta(20,'',$dato->CustomerPONumber).
                   /*-------Distributor Invoice Number----------*/
                   $this->etiqueta(20,'',$dato->DistributorInvoiceNumber).
                   /*-------Distributor Invoice Item----------*/
                   $this->etiqueta(20,'',$dato->NumLine).
                   /*--------Distributor Invoice Date---------*/
                   $this->etiqueta(8,'',$dato->DistributorInvoiceDate).
                   /*-------Customer Order Date----------*/
                   $this->etiqueta(8,'',$dato->CustomerOrderDate).
                   /*-------Customer Want Date----------*/
                   $this->etiqueta(8,'',$dato->CustomerWantDate).
                   /*--------Customer Ship Date---------*/
                   $this->etiqueta(8,'',$dato->CustomerShipDate).
                   PHP_EOL;
        }
        $body.=$this->etiqueta(10,'CTT',$count);
        return $body;
    }
    public function etiqueta($max, $name, $value){
        $spaces=$max-mb_strlen($value);
        for($i=1;$i<=$spaces;$i++){
            $value.=" ";
        }
        return $name.$value;
    }    
}
