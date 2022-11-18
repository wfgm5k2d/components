<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arFilter = [
    'IBLOCK_ID' => Iblock::getIblockIdByCode('franchize'), // Города-франшизы
    'ACTIVE' => 'Y',
];

$arSelect = [
    'NAME',
];

$arCity = [];
$rsElement = CIBlockElement::GetList([], $arFilter, $arSelect);
while ($arElement = $rsElement->Fetch()) {
    $arCity[] = $arElement['NAME'];
}

$sCity = '';
if(!in_array($_SESSION['NAME_CITY_FOR_PRODUCTS'], $arCity)) {
    $sCity = 'Томск';
} else {
    $sCity = $_SESSION['NAME_CITY_FOR_PRODUCTS'];
}

$arFilter = [
    'IBLOCK_ID' => 37,
    'ACTIVE' => 'Y',
    'PROPERTY_CITY_VALUE' => $sCity,
];

$arSelect = [
    'ID',
    'NAME',
    'PROPERTY_TOTAL_PRICE',
    'PROPERTY_PRICE',
];

$arSort = [];

$rsElement = CIBlockElement::GetList($arSort, $arFilter, $arSelect);
while ($arElement = $rsElement->Fetch()) {
    $arResult["ITEMS"][] = [
        'ID' => $arElement['ID'],
        'NAME' => $arElement['NAME'],
        'TOTAL_PRICE' => $arElement['PROPERTY_TOTAL_PRICE_VALUE'],
        'PRICE' => $arElement['PROPERTY_PRICE_VALUE'],
    ];
}

$this->IncludeComponentTemplate();
