# ENPARA Güncel Döviz ve Altın Kurları

Created on: <b>18.12.2021</b><br>
Version : <b>`v1.0`</b>

Enpara güncel döviz ve altın kurları için yazılmış bir PHP Sınıfı<br/>
Data [Enpara.com Döviz ve Altın Kurları](https://www.qnbfinansbank.enpara.com/hesaplar/doviz-ve-altin-kurlari) URL'inden <b>`file_get_contents()`</b> fonksiyonu ile çekilmektedir.<br>
Dolar, Euro ve Altın için şu dataları içerir:
- Alış Fiyatı (TL)
- Satış Fiyatı (TL)
- Makas (TL)

Class içinde kullanılabilecek anahtar kelimeler: <b>`usd`</b>, <b>`eur`</b>, <b>`altin`</b><br>
Ayrıca <b>`parite`</b> anahtar kelimesiyle EUR/USD Paritesine de ulaşılabilir.

# Class Kullanımı

```php
    $enpara = new Enpara();
    echo $enpara->satis('usd');
    // Sonuç: 16.9665
    
    $enpara = new Enpara();
    $enpara->basamak(6); // Varsayılan 4
    echo $enpara->alis('eur');
    // Sonuç: 17.821832
    
    $enpara = new Enpara();
    $enpara->basamak(0);
    echo $enpara->makas('altin');
    // Sonuç: 74
    
    $enpara = new Enpara();
    echo $enpara->json();
    // Bu şekilde direkt JSON çıktısı alıp API olarak da kullanabilirsiniz:
```
# JSON Çıktısı
```json
{"usd":{"alis":"16.0125","satis":"16.9665","makas":"0.9540"},"eur":{"alis":"17.8218","satis":"19.2604","makas":"1.4386"},"altin":{"alis":"911.9092","satis":"985.7262","makas":"73.8169"},"parite":{"alis":"1.1130","satis":"1.1352","makas":"0.0222"}}
```

# Demo
Güncel JSON çıktısı için [Demo](https://iltekin.com/api/enpara.php)<br>
Soru ve önerileriniz için bana sezer@iltekin.com adresinden ulaşabilirsiniz.
