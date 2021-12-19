<?php 

class Enpara {

    private $enpara = array();
    private $virguldenSonra = 4; // Virgülden sonraki varsayılan basamak sayısı (0-6)
    private $items = ['usd', 'eur', 'altin', 'parite'];
    private $enparaURL = 'https://www.qnbfinansbank.enpara.com/hesaplar/doviz-ve-altin-kurlari';

    public function __construct(){
        $sayfacek = file_get_contents($this->enparaURL);
        $pattern1 	= '@<div class="enpara-gold-exchange-rates__table-item">(.*?)</div>@si';
        $pattern2 = '@<span>(.*?)</span>@si';

        preg_match_all($pattern1,$sayfacek,$elemanlar);

        for($i=0; $i<=count($this->items)-1; $i++){
            preg_match_all($pattern2,$elemanlar[0][$i],$spans);

            $this->enpara[$this->items[$i]]['alis'] = $this->kacBasamak($this->noktayaCevir($this->tlSil($this->noktaSil($spans[1][1]))));
            $this->enpara[$this->items[$i]]['satis'] = $this->kacBasamak($this->noktayaCevir($this->tlSil($this->noktaSil($spans[1][2]))));
            $this->enpara[$this->items[$i]]['makas'] = $this->kacBasamak($this->fark($this->noktaSil($spans[1][1]), $this->noktaSil($spans[1][2])));
        }
    }

    private function kacBasamak($str){
        return number_format($str, $this->virguldenSonra, '.', '');
    }

    private function noktayaCevir($str){
        return str_replace(',', '.', $str);
    }

    private function noktaSil($str){
        return str_replace('.', '', $str);
    }

    private function tlSil($str){
        return str_replace(' TL', '', $str);
    }

    private function fark($str1, $str2){
        return $this->noktayaCevir($this->tlSil($str2)) - $this->noktayaCevir($this->tlSil($str1));
    }

    public function basamak($int){
        if($int >= 0 && $int <= 6){
            $this->virguldenSonra = $int;
            $this->__construct();
        }
    }

    public function json(){
        header("Content-type: application/json; charset=utf-8");
        return json_encode($this->enpara);
    }

    public function alis($str){
        return $this->enpara[$str]['alis'];
    }

    public function satis($str){
        return $this->enpara[$str]['satis'];
    }

    public function makas($str){
        return $this->satis($str) - $this->alis($str);
    }

}
