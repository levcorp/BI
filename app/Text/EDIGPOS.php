<?php
namespace App\Text;

use App\GPOS;
use Illuminate\Support\Collection;
class EDIGPOS
{
    public function text(){
        //return mb_strlen("ñ");    
        //DETCOMPAÑIA DE ALIMENTOS LTDA.
        //DETSOCIEDAD MINERA ILLAPA S.A.
        $gpos=GPOS::all();
        $docs=collect();
        foreach ($gpos as $item)
        {
            $docs->push($item->DocNum);
        }
        $docs->unique();
        $count=0;
        foreach ($docs as $item)
        {
            $count=0;
            foreach($gpos as $dato)
            {
                if($dato->DocNum==$item)
                {
                    $count++;
                    $dato->NumLine=$count;
                }
            }
        }
        $head=$this->head();
        $body=$this->body($gpos);
        return $head.$body;
    }
    public function head(){
        $SYS=$this->etiqueta(15,'SYS','802068825').$this->etiqueta(6,'X','005010').$this->etiqueta(6,'','867').$this->etiqueta(0,'P','').PHP_EOL;
        //$XQ=$this->etiqueta(2,'HDR','G').$date.PHP_EOL;
        //$N1=$this->etiqueta(3,'N1','ST').$this->etiqueta(60,'','LARCOS, S. A.').$this->etiqueta(2,'','9').$this->etiqueta(80,'',$city).PHP_EOL;
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
                   /*-----------------*/
                   $this->etiqueta(60,'',$dato->ShipToCustomerName).
                   /*-----------------*/
                   $this->etiqueta(60,'',$dato->ShipToAddress1).
                   /*-----------------*/
                   $this->etiqueta(60,'',$dato->ShipToAddress2).
                   /*-----------------*/
                   $this->etiqueta(30,'',$dato->ShipToCity).
                   /*-----------------*/
                   $this->etiqueta(2,'',$dato->ShipToRegionState).
                   /*-----------------*/
                   $this->etiqueta(10,'',$dato->ShipToPostalCode).
                   /*-----------------*/
                   $this->etiqueta(3,'',$dato->ShipToCountry).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->ShipToCustomerAccountNumber).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->ShipToNationalID).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->ShipToRACustomerID).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->ShiptoDistributorContactSalesPerson).
                   ////////////////////////////////////SOLD///////////////////////////////////////////////////
                   /*-----------------*/
                   $this->etiqueta(60,'',$dato->SoldToCustomerName).
                   /*-----------------*/
                   $this->etiqueta(60,'',$dato->SoldToAddress1).
                   /*-----------------*/
                   $this->etiqueta(60,'',$dato->SoldToAddress2).
                   /*-----------------*/
                   $this->etiqueta(30,'',$dato->SoldToCity).
                   /*-----------------*/                   
                   $this->etiqueta(2,'',$dato->SoldToRegionState).
                   /*-----------------*/
                   $this->etiqueta(10,'',$dato->SoldToPostalCode).
                   /*-----------------*/
                   $this->etiqueta(3,'',$dato->SoldToCountry).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->SoldToCustomerAccountNumber).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->SoldToNationalID).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->SoldToRACustomerID).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->SoldToDistributorContactSalesPerson).
                   ////////////////////////////////////OTROS///////////////////////////////////////////////////
                   /*-----------------*/
                   $this->etiqueta(5,'','').
                   /*-----------------*/
                   $this->etiqueta(48,'',$dato->PartNumberDescription).
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->VendorsPartNumber).
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->UPCGTIN).
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->VendorsCatalogNumber).
                   /*-----------------*/
                   $this->etiqueta(10,'',$dato->Quantity).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->ExtendedResale).
                   /*-----------------*/
                   $this->etiqueta(15,'',$dato->ExtendedCost).
                   /*-----------------*/
                   $this->etiqueta(20,'','').
                   /*-----------------*/
                   $this->etiqueta(20,'','').
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->AgreementNumber).
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->CustomerPONumber).
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->DistributorInvoiceNumber).
                   /*-----------------*/
                   $this->etiqueta(20,'',$dato->DistributorInvoiceItem).
                   /*-----------------*/
                   $this->etiqueta(8,'',$dato->DistributorInvoiceDate).
                   /*-----------------*/
                   $this->etiqueta(8,'',$dato->CustomerOrderDate).
                   /*-----------------*/
                   $this->etiqueta(8,'',$dato->CustomerWantDate).
                   /*-----------------*/
                   $this->etiqueta(8,'',$dato->CustomerShipDate).
                   "  ".$dato->NumLine.
                   PHP_EOL;
        }
        $body.="CTT$count";
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
