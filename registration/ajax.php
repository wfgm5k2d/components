<?php
\Bitrix\Main\Loader::includeModule('sale');

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Redline\Service\BasketService;

class EqvilleRegistration extends Controller

{
    #в параметр $person будут автоматически подставлены данные из REQUEST
    public function createAction($fields)
    {
        if (!empty($fields)) {
            $arErrors = [];

            if (!filter_var(htmlspecialcharsEx(trim($fields['EMAIL'])), FILTER_VALIDATE_EMAIL)) {
                $arErrors['ERROR']['EMAIL'] = 'E-mail не валиден';
            }

            if(!htmlspecialcharsEx(trim($fields['NAME']))) {
                $arErrors['ERROR']['NAME'] = 'Поле Имя пустое';
            }

            if(!htmlspecialcharsEx(trim($fields['NAME']))) {
                $arErrors['ERROR']['SURNAME'] = 'Поле Фамилия пустое';
            }

            if(strlen(htmlspecialcharsEx(trim($fields['PASSWORD']))) <= 5) {
                $arErrors['ERROR']['PASSWORD'] = 'Пароль менее 6 символов';
            }

            if(strlen(htmlspecialcharsEx(trim($fields['PHONE_NUMBER']))) != 18) {
                $arErrors['ERROR']['PHONE_NUMBER'] = 'Введите корректный номер телефона';
            }

            $arFields = [
                'LAST_NAME' => htmlspecialcharsEx(trim($fields['SURNAME'])),
                'NAME' => htmlspecialcharsEx(trim($fields['NAME'])),
                'SECOND_NAME' => htmlspecialcharsEx(trim($fields['SECOND_NAME'])),
                'LOGIN' => htmlspecialcharsEx(trim($fields['EMAIL'])),
                'EMAIL' => htmlspecialcharsEx(trim($fields['EMAIL'])),
                'PASSWORD' => htmlspecialcharsEx(trim($fields['PASSWORD'])),
                'CONFIRM_PASSWORD' => htmlspecialcharsEx(trim($fields['PASSWORD'])),
                'PHONE_NUMBER' => htmlspecialcharsEx(trim($fields['PHONE_NUMBER'])),
                'PERSONAL_PHONE' => str_replace('-', ' ', $fields['PHONE_NUMBER']),
                "LID" => "ru",
                "ACTIVE" => "Y",
                "GROUP_ID"  => array(2),
            ];

            if(!empty($arErrors)) {
                return $arErrors;
            }

            $user = new CUser();
            $ID = $user->Add($arFields);
            if (intval($ID) > 0) {
                $user->Authorize($ID);

                CEvent::Send('USER_INFO', SITE_ID, [
                    'LAST_NAME' => htmlspecialcharsEx(trim($fields['SURNAME'])),
                    'NAME' => htmlspecialcharsEx(trim($fields['NAME'])),
                    'MESSAGE' => 'Спасибо за регистрацию на сайте ' . $_SERVER['SERVER_NAME'],
                    'USER_ID' => $ID,
                    'STATUS' => 'Активен',
                    'LOGIN' => htmlspecialcharsEx(trim($fields['EMAIL'])),
                    'EMAIL' => htmlspecialcharsEx(trim($fields['EMAIL'])),
                ], 'N');

                CEvent::Send('NEW_USER', SITE_ID, [
                    'LAST_NAME' => htmlspecialcharsEx(trim($fields['SURNAME'])),
                    'NAME' => htmlspecialcharsEx(trim($fields['NAME'])),
                    'USER_ID' => $ID,
                    'LOGIN' => htmlspecialcharsEx(trim($fields['EMAIL'])),
                    'EMAIL' => htmlspecialcharsEx(trim($fields['EMAIL'])),
                ], 'N');

                return [
                    'redirect_url' => $_SERVER['HTTP_REFERER']
                ];
            } else {
                return $arErrors['ERROR']['USER_REGISTER'] = $user->LAST_ERROR;
            }
        }
    }

    public function configureActions()
    {
        return [
            'create' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST]),
                    new ActionFilter\Csrf(),
                ],
                'postfilters' => []
            ],
        ];
    }

}

