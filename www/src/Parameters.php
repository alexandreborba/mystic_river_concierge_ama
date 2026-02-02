<?php
error_reporting(0);
@ini_set('upload_max_filesize', '50M'); // php.ini configuration
$protocol = 'http'.(!empty($_SERVER['HTTPS']) ? 's' : '');
@define('PROTOCOL', $protocol.'://');

#ship config
@define('shipCode', 'AMA');
@define('shipName', 'Amavida');
@define('operCode', 'AMA');
@define('operName', 'AmaWaterways');

@define('SHOW_CONCIERGE', true); // OnlyMenu Restaurant = false, Menu Concierge + Menu Restaurant = true
@define('LANGUAGE_DEFAULT', 'en');

#geral
@define('BR', '<br>');
@define('QL', chr(13).chr(10));
@define('DS', DIRECTORY_SEPARATOR);

# website
@define('BACKOFFICE_TITLE', 'Concierge '.shipCode.' - '.shipName.' | Backoffice');
@define('PAGE_TITLE',       'Concierge '.shipCode.' - '.shipName);
@define('TITLE_LOGIN',      'Concierge Management'); // Texto do titulo da página de login

@define('FORM_VALIDATION_MESSAGE_ALERT', 'The form is pending, check the <strong>RED</strong> warnings!'); // Texto do subtitulo da página de login

@define('IMG_LOGIN_BACKGROUND', 'assets/img/bg/login-background-concierge.png'); // background da página de login
@define('IMG_LOGIN_LOGO',       'assets/img/logo/'.shipCode.'logo.png'); // Logo da página de login

@define('CONCIERGE_SHIP_CONCIERGE_NOCONTENT_FOLDER',    'nocontent/concierge'); // pasta destino das imagens no content
@define('CONCIERGE_SHIP_RESTAURANT_NOCONTENT_FOLDER',   'nocontent/restaurant'); // pasta destino das imagens no content
@define('CONCIERGE_SHIP_LOGO_NOCONTENT_FOLDER',        'nocontent/logo'); // pasta destino das imagens no content

@define('CONCIERGE_SHIP_IMAGE_FOLDER',          'media/ships'); // pasta destino das imagens importadas

@define('CONCIERGE_DM_IMAGE_FOLDER',            'media/dMenus'); // pasta destino das imagens importadas
@define('CONCIERGE_DMV_IMAGE_FOLDER',           'media/dMenusv'); // pasta destino das imagens importadas
@define('CONCIERGE_DP_IMAGE_FOLDER',            'media/dPrograms'); // pasta destino das imagens importadas
@define('CONCIERGE_SPAS_IMAGE_FOLDER',          'media/spas'); // pasta destino das imagens importadas
@define('CONCIERGE_SHOPS_IMAGE_FOLDER',         'media/shops'); // pasta destino das imagens importadas
@define('CONCIERGE_FASTINFOS_IMAGE_FOLDER',     'media/fastinfos'); // pasta destino das imagens importadas
@define('CONCIERGE_VIDEOS_FOLDER',              'media/videos'); // pasta destino dos videos importadas

@define('SUBJECT_EMAIL_RESET_PASSWORD', TITLE_LOGIN.' - Reset de Password'); // Assunto do Email de Reset de Password
@define('EMAIL_FOOTER_FORGOT_PASSWORD_TXT', TITLE_LOGIN); // Assunto do Email de Reset de Password

$aNY = [
   0 => 'No',
   1 => 'Yes'
];
$aNS = [
   0 => 'Não',
   1 => 'Sim'
];

$aLanguagesStatus = [
   0 => 'Inactive / Hidden',
   1 => 'Active / Visible'
];

$aLanguagesStatusLabel = [
   0 => 'label-default text-black',
   1 => 'label-success text-white'
];

$aDictionariesStatus = [
   0 => 'Inactive / Hidden',
   1 => 'Active / Visible'
];

$aDictionariesStatusLabel = [
   0 => 'label-default text-black',
   1 => 'label-success text-white'
];

$actionsTitles = [
   'ins' => 'Create',
   'upd' => 'Update',
   'del' => 'Delete',
];

# managers
$aManagersStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];
$aManagersStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

# logs
$aLogsStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];
$aLogsStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

# daily menu
$aDmStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aDmStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

# daily menu
$aDmvStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aDmvStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aDmTypeStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aDmTypeStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

# daily Program
$aDpStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aDpStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

# slideshow
$aSlidesStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aSlidesStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aSpasStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aSpasStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aShopsStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aShopsStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aVideosStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];
$aVideosStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aFastInfoStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];
$aFastInfoStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aCShipStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aCShipStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aShipStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aShipStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];


$aTokensStatus = [
    0 => 'Inactive / Hidden',
    1 => 'Active / Visible'
];

$aTokensStatusLabel = [
    0 => 'label-default text-black',
    1 => 'label-success text-white'
];

$aMenuPositions = [
    'T' => 'Top',
    'B' => 'Bottom'
];

?>
