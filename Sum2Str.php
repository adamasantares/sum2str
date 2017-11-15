<?php

namespace adamasantares;

/**
 * @author https://github.com/adamasantares
 */
class Sum2Str {
  
    /**
     * @param float|int|string $number
     * @param bool $asPrice Установить в FALSE если это не цена (дробная часть не будет учитываться)
     * @return string
     */
    public static function toStr($number, $asPrice = true)
    {
        $words = array(
            'null' => 'ноль',
            0 => '', '_0' => '', 1 => 'один', 2 => 'два', 3 => 'три', 4 => 'четыре', 5 => 'пять', 6 => 'шесть', 7 => 'семь',
            8 => 'восемь', 9 => 'девять', '_1' => 'одна', '_2' => 'две', '_3' => 'три', '_4' => 'четыре',
            '_5' => 'пять', '_6' => 'шесть', '_7' => 'семь', '_8' => 'восемь', '_9' => 'девять',
            11 => 'одиннадцать', 12 => 'двенадцать', 13 => 'тринадцать', 14 => 'четырнадцать', 15 => 'пятнадцать',
            16 => 'шестнадцать', 17 => 'семнадцать', 18 => 'восемнадцать', 19 => 'девятнадцать',
            10 => 'десять', 20 => 'двадцать',30 => 'тридцать', 40 => 'сорок', 50 => 'пятьдесят', 60 => 'шестьдесят',
            70 => 'семьдесят', 80 => 'восемьдесят', 90 => 'девяносто',
            100 => 'сто', 200 => 'двести', 300 => 'триста', 400 => 'четыреста', 500 => 'пятьсот', 600 => 'шестьсот',
            700 => 'семьсот', 800 => 'восемьсот', 900 => 'девятьсот',
            '1_1' => ' тысяча', '1_2' => ' тысячи', '1_5' => ' тысяч',
            '2_1' => ' миллион', '2_2' => ' миллиона', '2_5' => ' миллионов',
            '3_1' => ' миллиард', '3_2' => ' миллиарда', '3_5' => ' миллиардов',
            '0_1' => '', '0_2' => '', '0_5' => '', '4_1' => '', '4_2' => '', '4_5' => '', '5_1' => '', '5_2' => '', '5_5' => '',
            'r1' => ' рубль', 'r2' => ' рубля', 'r5' => ' рублей', 'cp' => 'коп.'
        );
        $number = str_replace(',', '.', '' . floatval($number));
        $number = explode('.', $number);
        $kop = substr((isset($number[1]) ? $number[1].'00' : '00'), 0, 2);
        $number = $number[0];
        if (intval($number) == 0) {
            $result = $words['null'];
        } else {
            $parts = str_split($number, 3);
            while (strlen($parts[count($parts) - 1]) < 3) {
                $number = '0' . $number;
                $parts = str_split($number, 3);
            }
            $parts = array_reverse($parts);
            foreach ($parts as $key => $part) {
                $val = intval(substr($part, -2, 2));
                if ($val > 10 && $val < 20) {
                    $label = $key . '_5';
                    $string = $words[$val];
                    $val = intval($part) - $val;
                    $string = $words[$val] . ' ' . $string;
                } else {
                    list($a, $b, $c) = str_split($part);
                    $a *= 100;
                    $b *= 10;
                    $c *= 1;
                    $string = trim($words[$a] . ' ' . $words[$b] . ' ' . $words[($key == 1 ? '_' . $c : $c)]);
                    $label = $key . (($c == 1) ? '_1' : (($c > 1 && $c < 5) ? '_2' : '_5'));
                }
                $string .= $words[$label];
                $parts[$key] = trim($string);
            }
            $parts = array_reverse($parts);
            $result = implode(' ', $parts);
        }
        if ($asPrice) {
            $c = intval(substr($number, -1, 1));
            $label = (($c == 1) ? 'r1' : (($c > 1 && $c < 5) ? 'r2' : 'r5'));
            $result .= $words[$label] . ' ' . $kop . ' ' . $words['cp'];
        }
        return $result;
    }
  
}
