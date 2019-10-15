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
        $find = array('#[^a-z0-9 A-Z.]#');
        $string=  str_replace($replace, $characters, $pharse);
        return preg_replace($find, "", $string);
    }
    public function text_date($city,$codCity,$start,$end){
        $gpos=GPOS::whereDate('DocDate','>=',$start)->whereDate('DocDate','<=',$end)->where('ShipFromDistributorDUNS+4','=',$city)->get();
        $body=$this->body($this->gpos($gpos),$start,$end,$this->now,$city,$codCity);
        return $body;
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
        $SYS=$this->etiqueta(15,'SYS','006097109AR1').$this->etiqueta(6,'X','005010').$this->etiqueta(6,'','867').'T'.PHP_EOL;
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
    public function HDR($datos){

    }
    public function body($datos,$last,$next,$now,$city,$codCity){
        $body="";
        $count=0;
        $CardCode=$this->CardCode($datos);
        foreach ($CardCode as $AccountNumber){
            $body.=$this->head($last,$next);
            $body.=$this->etiqueta(15,'HDR',$codCity).$this->etiqueta(8,'',$now).'USD'.$this->etiqueta(8,'',$last->format('Ymd')).$this->etiqueta(8,'',$next->format('Ymd')).$this->etiqueta(15,'',$city).$this->etiqueta(15,'',$city).$this->etiqueta(20,'',$AccountNumber).$this->etiqueta(20,'','').PHP_EOL;
            foreach ($datos->where('BillToCustomerAccountNumber',$AccountNumber)->unique() as $dato) {
                $body.=
                ////////////////////////////////////BILL///////////////////////////////////////////////////
                    /*---------Bill To Customer Name--------*/
                    $this->etiqueta(60,'DET',$this->charters($dato->BillToCustomerName)).
                    /*---------Bill To Address 1--------*/
                    $this->etiqueta(60,'',$this->charters($dato->BillToAddress1)).
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
                    /*-------'Bill To RA Customer ID----------*/
                    $this->etiqueta(15,'',$dato->BillToRACustomerID).
                    /*-------'Bill To National ID----------*/
                    $this->etiqueta(15,'',$dato->BillToNationalID).
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
                    /*--------Ship To RA Customer ID---------*/
                    $this->etiqueta(15,'',$dato->ShipToRACustomerID).
                    /*-----Ship To National ID------------*/
                    $this->etiqueta(15,'',$dato->ShipToNationalID).
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
                    /*------Sold To RA Customer ID-----------*/
                    $this->etiqueta(15,'',$dato->SoldToRACustomerID).
                    /*------Sold To National ID-----------*/
                    $this->etiqueta(15,'',$dato->SoldToNationalID).
                    /*-------Sold to Distributor Contact / Sales Person----------*/
                    $this->etiqueta(15,'',$this->charters($dato->SoldToDistributorContactSalesPerson)).PHP_EOL;
                    ////////////////////////////////////OTROS///////////////////////////////////////////////////
                    $count=0;
                    foreach($datos->where('BillToCustomerAccountNumber',$dato->BillToCustomerAccountNumber) as $item){
                        $count++;
                        $body.=
                        /*------Assigned ID consecutivo del detalle-----------*/
                        $this->etiqueta(5,'LIN',$count).
                        /*------Part Number Description-----------*/
                        $this->etiqueta(48,'',$this->charters($item->PartNumberDescription)).
                        /*-------Vendor's Part Number----------*/
                        $this->etiqueta(20,'',$item->VendorsPartNumber).
                        /*-------UPC (14 digit) - GTIN----------*/
                        $this->etiqueta(20,'',$item->UPCGTIN).
                        /*-------Vendor's Catalog Number----------*/
                        $this->etiqueta(20,'',$item->VendorsCatalogNumber).
                        /*------Quantity-----------*/
                        $this->etiqueta(10,'',$item->Quantity).
                        /*------Extended Resale-----------*/
                        $this->etiqueta(15,'',$this->ExtendedCost($item->ExtendedCost)).
                        /*------Extended Cost-----------*/
                        $this->etiqueta(15,'',$item->ExtendedResale).
                        /*-------Total Transaction Amount----------*/
                        $this->etiqueta(20,'',$item->ExtendedCost).
                        /*--------Purchase order Amount---------*/
                        $this->etiqueta(20,'',$item->ExtendedResale).
                        /*-------Agreement Number----------*/
                        $this->etiqueta(20,'',$item->AgreementNumber).
                        /*-------Customer PO Number----------*/
                        $this->etiqueta(20,'',$this->charters($item->CustomerPONumber)).
                        /*-------Distributor Invoice Number----------*/
                        $this->etiqueta(20,'',$this->DistributorInvoiceNumber(Carbon::now()->format('ym'),$item->NumAtCard,$item->ObjType,$city)).
                        /*-------Distributor Invoice Item----------*/
                        $this->etiqueta(20,'',$item->NumLine).
                        /*--------Distributor Invoice Date---------*/
                        $this->etiqueta(8,'',$item->DistributorInvoiceDate).
                        /*-------Customer Order Date----------*/
                        $this->etiqueta(8,'',$item->CustomerOrderDate).
                        /*-------Customer Want Date----------*/
                        $this->etiqueta(8,'',$item->CustomerWantDate).
                        /*--------Customer Ship Date---------*/
                        $this->etiqueta(8,'',$item->CustomerShipDate).
                        /*--------QTY Qualfier---------*/
                        $this->etiqueta(2,'',$item->CustomerShipDate).PHP_EOL;
                    }
                    $body.=$this->etiqueta(10,'CTT',$count).PHP_EOL;
                }
            }
        return $body;
    }
    public function ExtendedCost($value){
        if(is_null($value) || $value==''){return 0;}else{return $value;}
    }
    public function DistributorInvoiceNumber($date,$NumAtCard,$ObjType,$city){
        $cod=mb_strlen($date);
        if($city=='LARCOS000'){
          $codSucursal='0';
        }else{
          if($city=='LARCOS001'){
            $codSucursal='1';
          }else{
            if($city=='LARCOS002'){
              $codSucursal='2';
            }
          }
        }
        $space='';
        if($ObjType == 14){
            $num=mb_strlen($NumAtCard.'NC');
            $NumAtCard.='NC';
        }else{
            $num=mb_strlen($NumAtCard);
        }
        $ceros=10-($cod+$num+mb_strlen($codSucursal));
        for($i=1;$i<=$ceros;$i++){
            $space.='0';
        }
        return $date.$codSucursal.$space.$NumAtCard;
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
        $name=base_path().'\public\archivos\gpos\Excel\GPOS'.$this->lastSunday->format('Ymd').'a'.$this->nextSaturday->format('Ymd').'.xlsx';
        return $name;
    }
}
