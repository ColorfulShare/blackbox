<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Countrie;
use Illuminate\Support\Str;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayCountry = [
            [
                'name' => 'Afganistán',
                'slug' => Str::slug('Afganistán', '_'),
                'phone_prefix' => '93'
            ],
            [
                'name' => 'Albania',
                'slug' => Str::slug('Albania', '_'),
                'phone_prefix' => '355'
            ],
            [
                'name' => 'Alemania',
                'slug' => Str::slug('Alemania', '_'),
                'phone_prefix' => '49'
            ],
            [
                'name' => 'Andorra',
                'slug' => Str::slug('Andorra', '_'),
                'phone_prefix' => '376'
            ],
            [
                'name' => 'Angola',
                'slug' => Str::slug('Angola', '_'),
                'phone_prefix' => '244'
            ],
            [
                'name' => 'Antigua y Barbuda',
                'slug' => Str::slug('Antigua y Barbuda', '_'),
                'phone_prefix' => '1 268'
            ],[
                'name' => 'Arabia Saudita',
                'slug' => Str::slug('Arabia Saudita', '_'),
                'phone_prefix' => '966'
            ],
            [
                'name' => 'Argelia',
                'slug' => Str::slug('Argelia', '_'),
                'phone_prefix' => '213'
            ],
            [
                'name' => 'Argentina',
                'slug' => Str::slug('Argentina', '_'),
                'phone_prefix' => 54
            ],
            [
                'name' => 'Armenia',
                'slug' => Str::slug('Armenia', '_'),
                'phone_prefix' => '374'
            ],
            [
                'name' => 'Australia',
                'slug' => Str::slug('Australia', '_'),
                'phone_prefix' => '61'
            ],
            [
                'name' => 'Austria',
                'slug' => Str::slug('Austria', '_'),
                'phone_prefix' => '43'
            ],
            [
                'name' => 'Azerbaiyán',
                'slug' => Str::slug('Azerbaiyán', '_'),
                'phone_prefix' => '994'
            ],
            [
                'name' => 'Bahamas',
                'slug' => Str::slug('Bahamas', '_'),
                'phone_prefix' => '1242'
            ],
            [
                'name' => 'Bangladés',
                'slug' => Str::slug('Bangladés', '_'),
                'phone_prefix' => '880'
            ],
            [
                'name' => 'Barbados',
                'slug' => Str::slug('Barbados', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Baréin',
                'slug' => Str::slug('Baréin', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Bélgica',
                'slug' => Str::slug('Bélgica', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Belice',
                'slug' => Str::slug('Belice', '_'),
                'phone_prefix' => '501'
            ],
            [
                'name' => 'Benín',
                'slug' => Str::slug('Benín', '_'),
                'phone_prefix' => '229'
            ],
            [
                'name' => 'Bielorrusia',
                'slug' => Str::slug('Bielorrusia', '_'),
                'phone_prefix' => '375'
            ],
            [
                'name' => 'Birmania',
                'slug' => Str::slug('Birmania', '_'),
                'phone_prefix' => '95'
            ],
            [
                'name' => 'Bolivia',
                'slug' => Str::slug('Bolivia', '_'),
                'phone_prefix' => '591'
            ],
            [
                'name' => 'Bosnia y Herzegovina',
                'slug' => Str::slug('Bosnia y Herzegovina', '_'),
                'phone_prefix' => '387'
            ],
            [
                'name' => 'Botsuana',
                'slug' => Str::slug('Botsuana', '_'),
                'phone_prefix' => '267'
            ],
            [
                'name' => 'Brasil',
                'slug' => Str::slug('Brasil', '_'),
                'phone_prefix' => '55'
            ],
            [
                'name' => 'Brunéi',
                'slug' => Str::slug('Brunéi', '_'),
                'phone_prefix' => '673'
            ],
            [
                'name' => 'Bulgaria',
                'slug' => Str::slug('Bulgaria', '_'),
                'phone_prefix' => '359'
            ],
            [
                'name' => 'Burkina Faso',
                'slug' => Str::slug('Burkina Faso', '_'),
                'phone_prefix' => '226'
            ],
            [
                'name' => 'Burundi',
                'slug' => Str::slug('Burundi', '_'),
                'phone_prefix' => '257'
            ],
            [
                'name' => 'Bután',
                'slug' => Str::slug('Bután', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Cabo Verde',
                'slug' => Str::slug('Cabo Verde', '_'),
                'phone_prefix' => '238'
            ],
            [
                'name' => 'Camboya',
                'slug' => Str::slug('Camboya', '_'),
                'phone_prefix' => '855'
            ],
            [
                'name' => 'Camerún',
                'slug' => Str::slug('Camerún', '_'),
                'phone_prefix' => '237'
            ],
            [
                'name' => 'Canadá',
                'slug' => Str::slug('Canadá', '_'),
                'phone_prefix' => '1'
            ],
            [
                'name' => 'Catar',
                'slug' => Str::slug('Catar', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Chad',
                'slug' => Str::slug('Chad', '_'),
                'phone_prefix' => '235'
            ],
            [
                'name' => 'Chile',
                'slug' => Str::slug('Chile', '_'),
                'phone_prefix' => '56'
            ],
            [
                'name' => 'China',
                'slug' => Str::slug('China', '_'),
                'phone_prefix' => '86'
            ],
            [
                'name' => 'Chipre',
                'slug' => Str::slug('Chipre', '_'),
                'phone_prefix' => '357'
            ],
            [
                'name' => 'Ciudad del Vaticano',
                'slug' => Str::slug('Ciudad del Vaticano', '_'),
                'phone_prefix' => '39'
            ],
            [
                'name' => 'Colombia',
                'slug' => Str::slug('Colombia', '_'),
                'phone_prefix' => '57'
            ],
            [
                'name' => 'Comoras',
                'slug' => Str::slug('Comoras', '_'),
                'phone_prefix' => '269'
            ],
            [
                'name' => 'Corea del Norte',
                'slug' => Str::slug('Corea del Norte', '_'),
                'phone_prefix' => '850'
            ],
            [
                'name' => 'Corea del Sur',
                'slug' => Str::slug('Corea del Sur', '_'),
                'phone_prefix' => '82'
            ],
            [
                'name' => 'Costa de Marfil',
                'slug' => Str::slug('Costa de Marfil', '_'),
                'phone_prefix' => '225'
            ],
            [
                'name' => 'Costa Rica',
                'slug' => Str::slug('Costa Rica', '_'),
                'phone_prefix' => '506'
            ],
            [
                'name' => 'Croacia',
                'slug' => Str::slug('Croacia', '_'),
                'phone_prefix' => '385'
            ],
            [
                'name' => 'Cuba',
                'slug' => Str::slug('Cuba', '_'),
                'phone_prefix' => '53'
            ],
            [
                'name' => 'Dinamarca',
                'slug' => Str::slug('Dinamarca', '_'),
                'phone_prefix' => '45'
            ],
            [
                'name' => 'Dominica',
                'slug' => Str::slug('Dominica', '_'),
                'phone_prefix' => '1 767'
            ],
            [
                'name' => 'Ecuador',
                'slug' => Str::slug('Ecuador', '_'),
                'phone_prefix' => '593'
            ],
            [
                'name' => 'Egipto',
                'slug' => Str::slug('Egipto', '_'),
                'phone_prefix' => '20'
            ],
            [
                'name' => 'El Salvador',
                'slug' => Str::slug('El Salvador', '_'),
                'phone_prefix' => '503'
            ],
            [
                'name' => 'Emiratos Árabes Unidos',
                'slug' => Str::slug('Emiratos Árabes Unidos', '_'),
                'phone_prefix' => '971'
            ],
            [
                'name' => 'Eritrea',
                'slug' => Str::slug('Eritrea', '_'),
                'phone_prefix' => '291'
            ],
            [
                'name' => 'Eslovaquia',
                'slug' => Str::slug('Eslovaquia', '_'),
                'phone_prefix' => '421'
            ],
            [
                'name' => 'Eslovenia',
                'slug' => Str::slug('Eslovenia', '_'),
                'phone_prefix' => '386'
            ],
            [
                'name' => 'España',
                'slug' => Str::slug('España', '_'),
                'phone_prefix' => '34'
            ],
            [
                'name' => 'Estados Unidos',
                'slug' => Str::slug('Estados Unidos', '_'),
                'phone_prefix' => '1'
            ],
            [
                'name' => 'Estonia',
                'slug' => Str::slug('Estonia', '_'),
                'phone_prefix' => '372'
            ],
            [
                'name' => 'Etiopía',
                'slug' => Str::slug('Etiopía', '_'),
                'phone_prefix' => '251'
            ],
            [
                'name' => 'Filipinas',
                'slug' => Str::slug('Filipinas', '_'),
                'phone_prefix' => '63'
            ],
            [
                'name' => 'Finlandia',
                'slug' => Str::slug('Finlandia', '_'),
                'phone_prefix' => '358'
            ],
            [
                'name' => 'Fiyi',
                'slug' => Str::slug('Fiyi', '_'),
                'phone_prefix' => '679'
            ],
            [
                'name' => 'Francia',
                'slug' => Str::slug('Francia', '_'),
                'phone_prefix' => '33'
            ],
            [
                'name' => 'Gabón',
                'slug' => Str::slug('Gabón', '_'),
                'phone_prefix' => '241'
            ],
            [
                'name' => 'Gambia',
                'slug' => Str::slug('Gambia', '_'),
                'phone_prefix' => '220'
            ],
            [
                'name' => 'Georgia',
                'slug' => Str::slug('Georgia', '_'),
                'phone_prefix' => '995'
            ],
            [
                'name' => 'Ghana',
                'slug' => Str::slug('Ghana', '_'),
                'phone_prefix' => '233'
            ],
            [
                'name' => 'Granada',
                'slug' => Str::slug('Granada', '_'),
                'phone_prefix' => '1 473'
            ],
            [
                'name' => 'Grecia',
                'slug' => Str::slug('Grecia', '_'),
                'phone_prefix' => '30'
            ],
            [
                'name' => 'Guatemala',
                'slug' => Str::slug('Guatemala', '_'),
                'phone_prefix' => '502'
            ],
            [
                'name' => 'Guinea',
                'slug' => Str::slug('Guinea', '_'),
                'phone_prefix' => '224'
            ],
            [
                'name' => 'Guinea Ecuatorial',
                'slug' => Str::slug('Guinea Ecuatorial', '_'),
                'phone_prefix' => '240'
            ],
            [
                'name' => 'Guinea-Bisáu',
                'slug' => Str::slug('Guinea-Bisáu', '_'),
                'phone_prefix' => '245'
            ],
            [
                'name' => 'Guyana',
                'slug' => Str::slug('Guyana', '_'),
                'phone_prefix' => '592'
            ],
            [
                'name' => 'Guyana Francesa',
                'slug' => Str::slug('Guyana Francesa', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Haití',
                'slug' => Str::slug('Haití', '_'),
                'phone_prefix' => '509'
            ],
            [
                'name' => 'Honduras',
                'slug' => Str::slug('Honduras', '_'),
                'phone_prefix' => '504'
            ],
            [
                'name' => 'Hungría',
                'slug' => Str::slug('Hungría', '_'),
                'phone_prefix' => '36'
            ],
            [
                'name' => 'India',
                'slug' => Str::slug('India', '_'),
                'phone_prefix' => '91'
            ],
            [
                'name' => 'Indonesia',
                'slug' => Str::slug('Indonesia', '_'),
                'phone_prefix' => '62'
            ],
            [
                'name' => 'Irak',
                'slug' => Str::slug('Irak', '_'),
                'phone_prefix' => '964'
            ],
            [
                'name' => 'Irán',
                'slug' => Str::slug('Irán', '_'),
                'phone_prefix' => '98'
            ],
            [
                'name' => 'Irlanda',
                'slug' => Str::slug('Irlanda', '_'),
                'phone_prefix' => '353'
            ],
            [
                'name' => 'Islandia',
                'slug' => Str::slug('Islandia', '_'),
                'phone_prefix' => '354'
            ],
            [
                'name' => 'Islas Marshall',
                'slug' => Str::slug('Islas Marshall', '_'),
                'phone_prefix' => '692'
            ],
            [
                'name' => 'Islas Salomón',
                'slug' => Str::slug('Islas Salomón', '_'),
                'phone_prefix' => '677'
            ],
            [
                'name' => 'Israel',
                'slug' => Str::slug('Israel', '_'),
                'phone_prefix' => '972'
            ],
            [
                'name' => 'Italia',
                'slug' => Str::slug('Italia', '_'),
                'phone_prefix' => '39'
            ],
            [
                'name' => 'Jamaica',
                'slug' => Str::slug('Jamaica', '_'),
                'phone_prefix' => '1 876'
            ],
            [
                'name' => 'Japón',
                'slug' => Str::slug('Japón', '_'),
                'phone_prefix' => '81'
            ],
            [
                'name' => 'Jordania',
                'slug' => Str::slug('Jordania', '_'),
                'phone_prefix' => '962'
            ],
            [
                'name' => 'Kazajistán',
                'slug' => Str::slug('Kazajistán', '_'),
                'phone_prefix' => '7'
            ],
            [
                'name' => 'Kenia',
                'slug' => Str::slug('Kenia', '_'),
                'phone_prefix' => '254'
            ],
            [
                'name' => 'Kirguistán',
                'slug' => Str::slug('Kirguistán', '_'),
                'phone_prefix' => '996'
            ],
            [
                'name' => 'Kiribati',
                'slug' => Str::slug('Kiribati', '_'),
                'phone_prefix' => '686'
            ],
            [
                'name' => 'Kosovo',
                'slug' => Str::slug('Kosovo', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Kuwait',
                'slug' => Str::slug('Kuwait', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Laos',
                'slug' => Str::slug('Laos', '_'),
                'phone_prefix' => '856'
            ],
            [
                'name' => 'Lesoto',
                'slug' => Str::slug('Lesoto', '_'),
                'phone_prefix' => '266'
            ],
            [
                'name' => 'Letonia',
                'slug' => Str::slug('Letonia', '_'),
                'phone_prefix' => '371'
            ],
            [
                'name' => 'Líbano',
                'slug' => Str::slug('Líbano', '_'),
                'phone_prefix' => '961'
            ],
            [
                'name' => 'Liberia',
                'slug' => Str::slug('Liberia', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Libia',
                'slug' => Str::slug('Libia', '_'),
                'phone_prefix' => '218'
            ],
            [
                'name' => 'Liechtenstein',
                'slug' => Str::slug('Liechtenstein', '_'),
                'phone_prefix' => '423'
            ],
            [
                'name' => 'Lituania',
                'slug' => Str::slug('Lituania', '_'),
                'phone_prefix' => '370'
            ],
            [
                'name' => 'Luxemburgo',
                'slug' => Str::slug('Luxemburgo', '_'),
                'phone_prefix' => '352'
            ],[
                'name' => 'Macedonia del Norte',
                'slug' => Str::slug('Macedonia del Norte', '_'),
                'phone_prefix' => '389'
            ],
            [
                'name' => 'Madagascar',
                'slug' => Str::slug('Madagascar', '_'),
                'phone_prefix' => '261'
            ],

            [
                'name' => 'Malasia',
                'slug' => Str::slug('Malasia', '_'),
                'phone_prefix' => '60'
            ],
            [
                'name' => 'Malaui',
                'slug' => Str::slug('Malaui', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Maldivas',
                'slug' => Str::slug('Maldivas', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Malí',
                'slug' => Str::slug('Malí', '_'),
                'phone_prefix' => '223'
            ],
            [
                'name' => 'Malta',
                'slug' => Str::slug('Malta', '_'),
                'phone_prefix' => '356'
            ],
            [
                'name' => 'Marruecos',
                'slug' => Str::slug('Marruecos', '_'),
                'phone_prefix' => '212'
            ],
            [
                'name' => 'Mauricio',
                'slug' => Str::slug('Mauricio', '_'),
                'phone_prefix' => '230'
            ],
            [
                'name' => 'Mauritania',
                'slug' => Str::slug('Mauritania', '_'),
                'phone_prefix' => '222'
            ],
            [
                'name' => 'México',
                'slug' => Str::slug('México', '_'),
                'phone_prefix' => '52'
            ],
            [
                'name' => 'Micronesia',
                'slug' => Str::slug('Micronesia', '_'),
                'phone_prefix' => '691'
            ],
            [
                'name' => 'Moldavia',
                'slug' => Str::slug('Moldavia', '_'),
                'phone_prefix' => '373'
            ],
            [
                'name' => 'Mónaco',
                'slug' => Str::slug('Mónaco', '_'),
                'phone_prefix' => '377'
            ],
            [
                'name' => 'Mongolia',
                'slug' => Str::slug('Mongolia', '_'),
                'phone_prefix' => '976'
            ],
            [
                'name' => 'Montenegro',
                'slug' => Str::slug('Montenegro', '_'),
                'phone_prefix' => '382'
            ],
            [
                'name' => 'Mozambique',
                'slug' => Str::slug('Mozambique', '_'),
                'phone_prefix' => '258'
            ],
            [
                'name' => 'Namibia',
                'slug' => Str::slug('Namibia', '_'),
                'phone_prefix' => '264'
            ],
            [
                'name' => 'Nauru',
                'slug' => Str::slug('Nauru', '_'),
                'phone_prefix' => '674'
            ],
            [
                'name' => 'Nepal',
                'slug' => Str::slug('Nepal', '_'),
                'phone_prefix' => '977'
            ],
            [
                'name' => 'Nicaragua',
                'slug' => Str::slug('Nicaragua', '_'),
                'phone_prefix' => '505'
            ],
            [
                'name' => 'Níger',
                'slug' => Str::slug('Níger', '_'),
                'phone_prefix' => '227'
            ],
            [
                'name' => 'Nigeria',
                'slug' => Str::slug('Nigeria', '_'),
                'phone_prefix' => '234'
            ],
            [
                'name' => 'Noruega',
                'slug' => Str::slug('Noruega', '_'),
                'phone_prefix' => '47'
            ],
            [
                'name' => 'Nueva Zelanda',
                'slug' => Str::slug('Nueva Zelanda', '_'),
                'phone_prefix' => '64'
            ],
            [
                'name' => 'Omán',
                'slug' => Str::slug('Omán', '_'),
                'phone_prefix' => '968'
            ],
            [
                'name' => 'Países Bajos',
                'slug' => Str::slug('Países Bajos', '_'),
                'phone_prefix' => '31'
            ],
            [
                'name' => 'Pakistán',
                'slug' => Str::slug('Pakistán', '_'),
                'phone_prefix' => '92'
            ],
            [
                'name' => 'Palaos',
                'slug' => Str::slug('Palaos', '_'),
                'phone_prefix' => '680'
            ],
            [
                'name' => 'Palestina',
                'slug' => Str::slug('Palestina', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Panamá',
                'slug' => Str::slug('Panamá', '_'),
                'phone_prefix' => '507'
            ],
            [
                'name' => 'Papúa Nueva Guinea',
                'slug' => Str::slug('Papúa Nueva Guinea', '_'),
                'phone_prefix' => '675'
            ],
            [
                'name' => 'Paraguay',
                'slug' => Str::slug('Paraguay', '_'),
                'phone_prefix' => '595'
            ],
            [
                'name' => 'Perú',
                'slug' => Str::slug('Perú', '_'),
                'phone_prefix' => '51'
            ],
            [
                'name' => 'Polonia',
                'slug' => Str::slug('Polonia', '_'),
                'phone_prefix' => '48'
            ],
            [
                'name' => 'Portugal',
                'slug' => Str::slug('Portugal', '_'),
                'phone_prefix' => '351'
            ],
            [
                'name' => 'Reino Unido',
                'slug' => Str::slug('Reino Unido', '_'),
                'phone_prefix' => '44'
            ],
            [
                'name' => 'República Centroafricana',
                'slug' => Str::slug('República Centroafricana', '_'),
                'phone_prefix' => '236'
            ],
            [
                'name' => 'República Checa',
                'slug' => Str::slug('República Checa', '_'),
                'phone_prefix' => '420'
            ],
            [
                'name' => 'República del Congo',
                'slug' => Str::slug('República del Congo', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'República Democrática del Congo',
                'slug' => Str::slug('República Democrática del Congo', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'República Dominicana',
                'slug' => Str::slug('República Dominicana', '_'),
                'phone_prefix' => '1 809'
            ],
            [
                'name' => 'República Sudafricana',
                'slug' => Str::slug('República Sudafricana', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Ruanda',
                'slug' => Str::slug('Ruanda', '_'),
                'phone_prefix' => '250'
            ],
            [
                'name' => 'Rumanía',
                'slug' => Str::slug('Rumanía', '_'),
                'phone_prefix' => '40'
            ],
            [
                'name' => 'Rusia',
                'slug' => Str::slug('Rusia', '_'),
                'phone_prefix' => '7'
            ],
            [
                'name' => 'Samoa',
                'slug' => Str::slug('Samoa', '_'),
                'phone_prefix' => '685'
            ],
            [
                'name' => 'San Cristóbal y Nieves',
                'slug' => Str::slug('San Cristóbal y Nieves', '_'),
                'phone_prefix' => '1 869'
            ],
            [
                'name' => 'San Marino',
                'slug' => Str::slug('San Marino', '_'),
                'phone_prefix' => '378'
            ],
            [
                'name' => 'San Vicente y las Granadinas',
                'slug' => Str::slug('San Vicente y las Granadinas', '_'),
                'phone_prefix' => '1 784'
            ],
            [
                'name' => 'Santa Lucía',
                'slug' => Str::slug('Santa Lucía', '_'),
                'phone_prefix' => '1 758'
            ],
            [
                'name' => 'Santo Tomé y Príncipe',
                'slug' => Str::slug('Santo Tomé y Príncipe', '_'),
                'phone_prefix' => '239'
            ],
            [
                'name' => 'Senegal',
                'slug' => Str::slug('Senegal', '_'),
                'phone_prefix' => '221'
            ],
            [
                'name' => 'Serbia',
                'slug' => Str::slug('Serbia', '_'),
                'phone_prefix' => '361'
            ],
            [
                'name' => 'Seychelles',
                'slug' => Str::slug('Seychelles', '_'),
                'phone_prefix' => '248'
            ],
            [
                'name' => 'Sierra Leona',
                'slug' => Str::slug('Sierra Leona', '_'),
                'phone_prefix' => '232'
            ],
            [
                'name' => 'Singapur',
                'slug' => Str::slug('Singapur', '_'),
                'phone_prefix' => '65'
            ],
            [
                'name' => 'Siria',
                'slug' => Str::slug('Siria', '_'),
                'phone_prefix' => '963'
            ],
            [
                'name' => 'Somalia',
                'slug' => Str::slug('Somalia', '_'),
                'phone_prefix' => '252'
            ],
            [
                'name' => 'Sri Lanka',
                'slug' => Str::slug('Sri Lanka', '_'),
                'phone_prefix' => '94'
            ],
            [
                'name' => 'Suazilandia',
                'slug' => Str::slug('Suazilandia', '_'),
                'phone_prefix' => '268'
            ],
            [
                'name' => 'Sudán',
                'slug' => Str::slug('Sudán', '_'),
                'phone_prefix' => '249'
            ],
            [
                'name' => 'Sudán del Sur',
                'slug' => Str::slug('Sudán del Sur', '_'),
                'phone_prefix' => ''
            ],
            [
                'name' => 'Suecia',
                'slug' => Str::slug('Suecia', '_'),
                'phone_prefix' => '46'
            ],
            [
                'name' => 'Suiza',
                'slug' => Str::slug('Suiza', '_'),
                'phone_prefix' => '41'
            ],
            [
                'name' => 'Surinam',
                'slug' => Str::slug('Surinam', '_'),
                'phone_prefix' => '597'
            ],
            [
                'name' => 'Tailandia',
                'slug' => Str::slug('Tailandia', '_'),
                'phone_prefix' => '66'
            ],
            [
                'name' => 'Tanzania',
                'slug' => Str::slug('Tanzania', '_'),
                'phone_prefix' => '255'
            ],
            [
                'name' => 'Tayikistán',
                'slug' => Str::slug('Tayikistán', '_'),
                'phone_prefix' => '992'
            ],
            [
                'name' => 'Timor Oriental',
                'slug' => Str::slug('Timor Oriental', '_'),
                'phone_prefix' => '670'
            ],
            [
                'name' => 'Togo',
                'slug' => Str::slug('Togo', '_'),
                'phone_prefix' => '228'
            ],
            [
                'name' => 'Tonga',
                'slug' => Str::slug('Tonga', '_'),
                'phone_prefix' => '676'
            ],
            [
                'name' => 'Trinidad y Tobago',
                'slug' => Str::slug('Trinidad y Tobago', '_'),
                'phone_prefix' => '1 868'
            ],
            [
                'name' => 'Túnez',
                'slug' => Str::slug('Túnez', '_'),
                'phone_prefix' => '216'
            ],
            [
                'name' => 'Turkmenistán',
                'slug' => Str::slug('Turkmenistán', '_'),
                'phone_prefix' => '993'
            ],
            [
                'name' => 'Turquía',
                'slug' => Str::slug('Turquía', '_'),
                'phone_prefix' => '90'
            ],
            [
                'name' => 'Tuvalu',
                'slug' => Str::slug('Tuvalu', '_'),
                'phone_prefix' => '688'
            ],
            [
                'name' => 'Ucrania',
                'slug' => Str::slug('Ucrania', '_'),
                'phone_prefix' => '380'
            ],
            [
                'name' => 'Uganda',
                'slug' => Str::slug('Uganda', '_'),
                'phone_prefix' => '256'
            ],
            [
                'name' => 'Uruguay',
                'slug' => Str::slug('Uruguay', '_'),
                'phone_prefix' => '598'
            ],
            [
                'name' => 'Uzbekistán',
                'slug' => Str::slug('Uzbekistán', '_'),
                'phone_prefix' => '998'
            ],
            [
                'name' => 'Vanuatu',
                'slug' => Str::slug('Vanuatu', '_'),
                'phone_prefix' => '678'
            ],
            [
                'name' => 'Venezuela',
                'slug' => Str::slug('Venezuela', '_'),
                'phone_prefix' => '58'
            ],
            [
                'name' => 'Vietnam',
                'slug' => Str::slug('Vietnam', '_'),
                'phone_prefix' => '84'
            ],
            [
                'name' => 'Yemen',
                'slug' => Str::slug('Yemen', '_'),
                'phone_prefix' => '967'
            ],
            [
                'name' => 'Yibuti',
                'slug' => Str::slug('Yibuti', '_'),
                'phone_prefix' => '253'
            ],
            [
                'name' => 'Zambia',
                'slug' => Str::slug('Zambia', '_'),
                'phone_prefix' => '260'
            ],
            [
                'name' => 'Zimbabue',
                'slug' => Str::slug('Zimbabue', '_'),
                'phone_prefix' => '263'
            ],
        ];
        foreach ($arrayCountry as $country ) {
            Countrie::create($country);
        }
    
    }
}
