<?php
//Session boşsa session başlat
function Session() {
  if(!isset($_SESSION)) { 
  session_start(); 
  }
}

//Çevrimiçi Üyeler
function online() {
  if (isset($_SESSION["oturum"]) == true) {//Oturum başladıysa
    global $db;
    $sure = time()-200; //2 dakkika öncesini al
    $sureguncelle = $db->update('uye') //Oturum başlatan üyenin giriş zamanını güncelle
    ->where('id', $_SESSION["uyeid"])
    ->set(array(
    'sure' => time()
    ));
    $uye = $db->from('uye')
    ->where('sure', $sure, '>')
    ->run();
    if ( $uye ){
      echo '<ul class="list-group">';
      foreach ( $uye as $on ){
        echo '<li class="list-group-item" style="color:'.$on['yrengi'].'">'.$on['uyeAdi'].'</li>';
      }
      echo '</ul>';
    }
  }

}
//echo online();


function seo($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function basharfbuyuk($gelen){
 
  $sonuc='';
  $kelimeler=explode(" ", $gelen);
 
  foreach ($kelimeler as $kelime_duz){
 
    $kelime_uzunluk=strlen($kelime_duz);
    $ilk_karakter=mb_substr($kelime_duz,0,1,'UTF-8');
 
    if($ilk_karakter=='Ç' or $ilk_karakter=='ç'){
      $ilk_karakter='Ç';
    }elseif ($ilk_karakter=='Ğ' or $ilk_karakter=='ğ') {
      $ilk_karakter='Ğ';
    }elseif($ilk_karakter=='I' or $ilk_karakter=='ı'){
      $ilk_karakter='I';
    }elseif ($ilk_karakter=='İ' or $ilk_karakter=='i'){
      $ilk_karakter='İ';
    }elseif ($ilk_karakter=='Ö' or $ilk_karakter=='ö'){
      $ilk_karakter='Ö';
    }elseif ($ilk_karakter=='Ş' or $ilk_karakter=='ş'){
      $ilk_karakter='Ş';
    }elseif ($ilk_karakter=='Ü' or $ilk_karakter=='ü'){
      $ilk_karakter='Ü';
    }else{
      $ilk_karakter=strtoupper($ilk_karakter);
    }
 
    $digerleri=mb_substr($kelime_duz,1,$kelime_uzunluk,'UTF-8');
    $sonuc.=$ilk_karakter.kucuk_yap($digerleri).' ';
 
  }
 
  $son=trim(str_replace('  ', ' ', $sonuc));
  return $son;
 
}
 
function kucuk_yap($gelen){
 
  $gelen=str_replace('Ç', 'ç', $gelen);
  $gelen=str_replace('Ğ', 'ğ', $gelen);
  $gelen=str_replace('I', 'ı', $gelen);
  $gelen=str_replace('İ', 'i', $gelen);
  $gelen=str_replace('Ö', 'ö', $gelen);
  $gelen=str_replace('Ş', 'ş', $gelen);
  $gelen=str_replace('Ü', 'ü', $gelen);
  $gelen=strtolower($gelen);
 
  return $gelen;
}
 
//echo basharfbuyuk('oKAN IŞIK deneme yAZI BAŞlığı');

function Uyari($mesaj){
  echo '<div class="form-group"><p class="btn btn-warning btn-block">' . $mesaj . '</p></div>';
  header("Refresh: 3;url=cikis.php");
}

function Hata($mesaj){
  echo '<div class="form-group"><p class="btn btn-danger btn-block">' . $mesaj . '</p></div>';
  header("Refresh: 2;url=index.php");
}

function AltMenu(){

  echo '<footer class="footer navbar-bottom">
  <div class="container text-center" style="margin-bottom:5px">';
  if (isset($_SESSION["oturum"]) == true and $_SESSION['onay'] == 1) {

    echo '
      <a href="cikis.php" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span></a>
      <a href="timeline.php" class="btn btn-warning"><span class="glyphicon glyphicon-share"></span></a>
      <button class="btn btn-default" data-toggle="modal" data-target="#profil"><span class="glyphicon glyphicon-user"></span></button>';
    if($_SESSION["oturum"] and $_SESSION['rutbe'] == 1){
    echo '<a class="btn btn-success" style="margin-left:5px;" href="javascript:void(0)" onclick="sohbetTemizle()"><span class="glyphicon glyphicon-erase"></span></a>
      <a class="btn btn-default" href="panel.php"><span class="glyphicon glyphicon-cog"></span></a>';
    }

  }
  echo '</div>
    </footer>';

}