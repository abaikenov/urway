<?php
/**
 * Created by PhpStorm.
 * User: a.baikenov
 * Date: 12.10.2015
 * Time: 18:39
 */

namespace app\components\payment;


use app\components\C;

class Xml {
// -----===++[Parse XML to ARRAY]++===-----
    // methods:
    // parse($data) - return array in format listed below
    // variables:
    // $data - string: incoming XML
    //
    // Array format:
    // array index:"TAG_"+tagNAME = value: tagNAME
    // example:$array['TAG_BANK'] = "BANK"
    // array index:NAME+"_"+ATTRIBUTE_NAME = value: ATTRIBUTE_VALUE
    // example:$array['BANK_NAME'] = "Kazkommertsbank JSC"
    //
    // -----===++[Резка XML в массив]++===-----
    // методы:
    // parse($data) - возвращает массив в формате описанном ниже
    // переменные:
    // $data - строка: входящий XML
    //
    // Формат массива:
    // индекс в массиве:"TAG_"+имяТега = значение: имяТега
    // пример:$array['TAG_BANK'] = "BANK"
    // индекс в массиве:имяТега+"_"+имяАттрибута = значение: значениеАттрибута
    // пример:$array['BANK_NAME'] = "Kazkommertsbank JSC"

    var $parser;
    var $xarray = array();
    var $lasttag;

    function __construct()
    {   $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, true);
        xml_set_element_handler($this->parser, "tag_open", "tag_close");
        xml_set_character_data_handler($this->parser, "cdata");
    }

    function parse($data)
    {
        xml_parse($this->parser, $data);
        ksort($this->xarray,SORT_STRING);
        return $this->xarray;
    }

    function tag_open($parser, $tag, $attributes)
    {
        $this->lasttag = $tag;
        $this->xarray['TAG_'.$tag] = $tag;
        if (is_array($attributes)){
            foreach ($attributes as $key => $value) {
                $this->xarray[$tag.'_'.$key] = $value;
            };
        };
    }

    function cdata($parser, $cdata)
    {	$tag = $this->lasttag;
        $this->xarray[$tag.'_CHARDATA'] = $cdata;
    }

    function tag_close($parser, $tag)
    {}
}