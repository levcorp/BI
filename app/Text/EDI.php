<?php

namespace App\Text;
use App\EdiLP;
use Carbon\Carbon;
class EDI
{
    public function text_lp()
    {
        $date=Carbon::now()->format('Ymd');
        $ediLP=EdiLp::whereDate('Fecha',Carbon::now()->format('Y-m-d'))->get();        
        $SYS=$this->etiqueta(15,'SYS','802068825').$this->etiqueta(6,'X','004010').$this->etiqueta(6,'','852').$this->etiqueta(0,'P','').PHP_EOL;
        $XQ=$this->etiqueta(2,'XQ','G').$date.PHP_EOL;
        $N1=$this->etiqueta(3,'N1','ST').$this->etiqueta(60,'','LARCOS, S. A.').$this->etiqueta(2,'','9').$this->etiqueta(80,'','LARCO0003').PHP_EOL;
        $body="";
        $count=0;
        foreach ($ediLP as $lp) {
            $count++;
            $body.=$this->etiqueta(20,'LIN',$count).$this->etiqueta(48,'VC',$lp->U_Cod_comp).$this->etiqueta(48,'UP',$lp->U_cat_id).PHP_EOL.
            $this->etiqueta(15,'QTYOC','0').'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQA',$lp->Onhand).'EA164'.$date.$this->etiqueta(30,'ACC',$lp->U_Item_Status).PHP_EOL.
            $this->etiqueta(15,'ZAQS',$lp->Sold).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQC',$lp->Commit_to_sale).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQO',$lp->Back_Order).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQP',$lp->On_Order).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQZ',$lp->Transfered).'EA'.PHP_EOL.
            $this->etiqueta(15,'ZAQI',$lp->Transit).'EA'.PHP_EOL;
        }
        $body.="CTT$count";
        return $SYS.$XQ.$N1.$body;
    }
    public function etiqueta($max, $name, $value){
        $spaces=$max-strlen($value);
        for($i=1;$i<=$spaces;$i++){
            $value.=" ";
        }
        return $name.$value;
    }
}
