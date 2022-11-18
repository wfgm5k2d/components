<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CJSCore::Init(array("jquery"));

$arResult['ACTIVE'] = $arParams["ACTIVE"];

$this->IncludeComponentTemplate();