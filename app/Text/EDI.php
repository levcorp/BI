<?php

namespace App\Text;
use App\EdiLP;
use App\EdiCO;
use App\EdiSC;
use App\EdiHUB;
use Carbon\Carbon;
class EDI
{
    public function text_hub($date){
        $format=Carbon::parse($date)->format('Ymd');
        $head=$this->head('LARCOS000',$format);              
        $body=$this->body(EdiHUB::whereDate('Fecha',$date)->get(),$format);
        return $head.$body;
    }
    public function text_co($date){
        $format=Carbon::parse($date)->format('Ymd');
        $head=$this->head('LARCOS002',$format);              
        $body=$this->body(EdiCO::whereDate('Fecha',$date)->get(),$format);
        return $head.$body;
    }
    public function text_sc($date){
        $format=Carbon::parse($date)->format('Ymd');
        $head=$this->head('LARCOS001',$format);        
        $body=$this->body(EdiSC::whereDate('Fecha',$date)->get(),$format);
        return $head.$body;
    }
    public function text_lp($date){
        $format=Carbon::parse($date)->format('Ymd');
        $head=$this->head('LARCOS003',$format);
        $body=$this->body(EdiLP::whereDate('Fecha',$date)->get(),$format);
        return $head.$body;
    }
    public function head($city,$date)
    {
        $SYS=$this->etiqueta(15,'SYS','802068825').$this->etiqueta(6,'X','004010').$this->etiqueta(6,'','852').$this->etiqueta(0,'P','').PHP_EOL;
        $XQ=$this->etiqueta(2,'XQ','G').$date.PHP_EOL;
        $N1=$this->etiqueta(3,'N1','ST').$this->etiqueta(60,'','LARCOS, S. A.').$this->etiqueta(2,'','9').$this->etiqueta(80,'',$city).PHP_EOL;
        return $SYS.$XQ.$N1;
    }
    public function body($datos,$date){
        $body="";
        $count=0;
         foreach ($datos as $dato) {
            $count++;
            $body.=$this->etiqueta(20,'LIN',$count).$this->etiqueta(48,'VC',$dato->U_Cod_comp).$this->etiqueta(48,'UP',$dato->U_cat_id).PHP_EOL.
            $this->etiqueta(15,'QTYOC','0').'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQA',$dato->Onhand).'EA164'.$date.$this->etiqueta(30,'ACC',$dato->U_Item_Status).PHP_EOL.
            $this->etiqueta(15,'ZAQS',$dato->Sold).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQC',$dato->Commit_to_sale).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQO',$dato->Back_Order).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQP',$dato->On_Order).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQZ',$dato->Transfered).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQI',$dato->Transit).'EA'.PHP_EOL;
        }
        $body.="CTT$count";
        return $body;
    }
    public function etiqueta($max, $name, $value){
        $spaces=$max-strlen($value);
        for($i=1;$i<=$spaces;$i++){
            $value.=" ";
        }
        return $name.$value;
    }
}
