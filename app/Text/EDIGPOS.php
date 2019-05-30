<?php
namespace App\Text;

use App\GPOS;
use Illuminate\Support\Collection;
use Carbon\Carbon;
class EDIGPOS
{
    protected $nextSaturday;
    protected $lastSunday;
    protected $now;
    public function __construct()
    {
        $this->nextSaturday= new Carbon('last saturday');
        Carbon::setTestNow($this->nextSaturday);       
        $this->lastSunday=new Carbon('last sunday');
        Carbon::setTestNow();   
        $this->now=Carbon::now()->format('Ymd');
    }
    public function charters($pharse){
        $replace =    array(
                            "Á","É","Í","Ó","Ú","Ñ",
                        );
        $characters = array(
                            "A","E","I","O","U","N",
                        );
        $find = array('#[^a-z0-9 A-Z./]#');        
        $string=  str_replace($replace, $characters, $pharse);               
        return preg_replace($find, "", $string);	
    }
    public function text_date($city,$codCity,$start,$end){
        $gpos=GPOS::whereDate('DocDate','>=',$start)->whereDate('DocDate','<=',$end)->where('ShipFromDistributorDUNS+4','=',$city)->get();
        $head=$this->head($start,$end);
        $body=$this->body($this->gpos($gpos),$start,$end,$this->now,$city,$codCity);
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
        $last=Carbon::parse($last)->format('Ymd');
        $next=Carbon::parse($next)->format('Ymd');
        $SYS=$this->etiqueta(15,'SYS','802068825').$this->etiqueta(9,'X','005010').'867'.'T'.PHP_EOL;
        return $SYS;
    }
    public function CardCode($gpos)
    {
        $CardCode=collect();
        foreach($gpos as $item=>$values)
        {
            $CardCode->push($values->BillToCustomerAccountNumber);
        }
        return $CardCode->unique();
    }
    public function body($datos,$last,$next,$now,$city,$codCity){
        $body="";
        $count=0;
        $CardCode=$this->CardCode($datos);
        foreach ($CardCode as $AccountNumber){   
            $count++;
            $body.=$this->etiqueta(15,'HDR',$codCity).$this->etiqueta(8,'',$now).'USD'.$this->etiqueta(8,'',$last->format('Ymd')).$this->etiqueta(8,'',$next->format('Ymd')).$this->etiqueta(15,'',$city).$this->etiqueta(15,'',$city).$this->etiqueta(20,'',$AccountNumber).$this->etiqueta(20,'','').PHP_EOL;
            foreach ($datos as $dato) {
                if($dato->BillToCustomerAccountNumber==$AccountNumber){
                $body.=
                ////////////////////////////////////BILL///////////////////////////////////////////////////
                    /*---------Bill To Customer Name--------*/
                    $this->etiqueta(60,'DET',$this->charters($dato->BillToCustomerName)).
                    /*---------Bill To Address 1--------*/
                    $this->etiqueta(60,'',$this->charters($dato->BillToAddres1)).
                    /*---------Bill To Address 2--------*/
                    $this->etiqueta(60,'',$this->charters($dato->BillToAddress2)).
                    /*--------'Bill To City---------*/
                    $this->etiqueta(30,'',$this->charters($dato->BillToCity)).
                    /*--------'Bill To Region State---------*/
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
                    $this->etiqueta(15,'',$this->charters($dato->BillToDistributorContactSalesPerson)).
                    ////////////////////////////////////SHIP///////////////////////////////////////////////////
                    /*--------Bill To Customer Name---------*/
                    $this->etiqueta(60,'',$this->charters($dato->ShipToCustomerName)).
                    /*-------Ship To Address 1----------*/
                    $this->etiqueta(60,'',$this->charters($dato->ShipToAddress1)).
                    /*-------'Ship To Address 2----------*/
                    $this->etiqueta(60,'',$this->charters($dato->ShipToAddress2)).
                    /*--------Ship To City---------*/
                    $this->etiqueta(30,'',$this->charters($dato->ShipToCity)).
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
                    $this->etiqueta(15,'',$this->charters($dato->ShiptoDistributorContactSalesPerson)).
                    ////////////////////////////////////SOLD///////////////////////////////////////////////////
                    /*-------Sold To Customer Name----------*/
                    $this->etiqueta(60,'',$this->charters($dato->SoldToCustomerName)).
                    /*-------Sold To Address 1----------*/
                    $this->etiqueta(60,'',$this->charters($dato->SoldToAddress1)).
                    /*-------Sold To Address 2----------*/
                    $this->etiqueta(60,'',$this->charters($dato->SoldToAddress2)).
                    /*-------Sold To City----------*/
                    $this->etiqueta(30,'',$this->charters($dato->SoldToCity)).
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
                    $this->etiqueta(15,'',$this->charters($dato->SoldToDistributorContactSalesPerson)).
                    ////////////////////////////////////OTROS///////////////////////////////////////////////////
                    /*------Assigned ID consecutivo del detalle-----------*/
                    $this->etiqueta(5,'',$dato->NumLine).
                    /*------Part Number Description-----------*/
                    $this->etiqueta(48,'',$this->charters($dato->PartNumberDescription)).
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
                    $this->DistributorInvoiceNumber($dato->DistributorInvoiceNumber,$dato->NumAtCard).
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
            }
        }
        $body.=$this->etiqueta(10,'CTT',$count);
        return $body;
    }
    public function DistributorInvoiceNumber($codSAP,$NumAtCard){
        $cod=mb_strlen($codSAP);
        $num=mb_strlen($NumAtCard);
        $ceros=20-($cod+$num);
        $space='';
        for($i=1;$i<=$ceros;$i++){
            $space.='0';
        }
        //7391002260000000027412
        return $codSAP.$space.$NumAtCard;
    }
    public function etiqueta($max, $name, $value){
        $spaces=$max-mb_strlen($value);
        for($i=1;$i<=$spaces;$i++){
            $value.=" ";
        }
        return $name.$value;
    }    
    public function count()
    {   
        return GPOS::whereDate('DocDate','>=',$this->lastSunday)->whereDate('DocDate','<=',$this->nextSaturday)->count();
    }
    public function counts(){
        $lp=GPOS::whereDate('DocDate','>=',$this->lastSunday)->whereDate('DocDate','<=',$this->nextSaturday)->where('ShipFromDistributorDUNS+4','=','LARCOS000')->count();
        $sc=GPOS::whereDate('DocDate','>=',$this->lastSunday)->whereDate('DocDate','<=',$this->nextSaturday)->where('ShipFromDistributorDUNS+4','=','LARCOS001')->count();
        $co=GPOS::whereDate('DocDate','>=',$this->lastSunday)->whereDate('DocDate','<=',$this->nextSaturday)->where('ShipFromDistributorDUNS+4','=','LARCOS002')->count();
        $count=array([
            'lp'=>$lp,
            'co'=>$co,
            'sc'=>$sc,
        ]);
        return $count;
    }
    public function names(){   
        $names=array();
        $names=array([
            'lp'=>'LaPaz_'.$this->lastSunday->format('Ymd').'a'.$this->nextSaturday->format('Ymd').'.txt',
            'co'=>'Cochabamba_'.$this->lastSunday->format('Ymd').'a'.$this->nextSaturday->format('Ymd').'.txt',
            'sc'=>'SantaCruz_'.$this->lastSunday->format('Ymd').'a'.$this->nextSaturday->format('Ymd').'.txt',
        ]);
        return $names;
    }
    public function name(){
        $name=base_path().'\public\archivos\gpos\Excel\GPOS'.$this->lastSunday->format('Y-m-d').'a'.$this->nextSaturday->format('Y-m-d').'.xlsx';
        return $name;
    }
}
