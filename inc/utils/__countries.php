<?php

/**
 * Retrieves a list of country phone data.
 *
 * Returns an array of associative arrays, each representing a country with the following keys:
 * - 'iso': The ISO country code.
 * - 'dial_code': The international dialing code for the country.
 * - 'mask': The phone number mask format.
 * - 'length': The typical length of phone numbers in the country.
 * - 'name': The localized name of the country.
 * - 'flag': URL to the country's flag image.
 * - 'pattern': A regex pattern for validating phone numbers of the country.
 *
 * @return array List of countries with phone data.
 */
function get_all_countries() {
    return [
        [
            'iso'=>'AW',
            'dial_code'=>'+297',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Aruba", 'emptytheme'),
            'flag'=>'https://flagcdn.com/aw.svg',
            'pattern'=>'/^(5\d{6}|9\d{6})$/'
        ],
        [
            'iso'=>'AF',
            'dial_code'=>'+93',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Afghanistan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/af.svg',
            'pattern'=>'/^[2-7]\d{8}$/'
        ],
        [
            'iso'=>'AO',
            'dial_code'=>'+244',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Angola", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ao.svg',
            'pattern'=>'/^[29]\d{8}$/'
        ],
        [
            'iso'=>'AL',
            'dial_code'=>'+355',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Albania", 'emptytheme'),
            'flag'=>'https://flagcdn.com/al.svg',
            'pattern'=>'/^6[6-9]\d{7}$/'
        ],
        [
            'iso'=>'AE',
            'dial_code'=>'+971',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("United Arab Emirates", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ae.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'AR',
            'dial_code'=>'+54',
            'mask'=>'### ### #####',
            'length'=>11,
            'name'=>__("Argentina", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ar.svg',
            'pattern'=>'/^(11|[2368]\d)\d{8}$/'
        ],
        [
            'iso'=>'AM',
            'dial_code'=>'+374',
            'mask'=>'### ## ###',
            'length'=>8,
            'name'=>__("Armenia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/am.svg',
            'pattern'=>'/^(77|91|96|99|43|93|94|98|95|55|41|47)\d{6}$/'
        ],
        [
            'iso'=>'AU',
            'dial_code'=>'+61',
            'mask'=>'#### #### ####',
            'length'=>12,
            'name'=>__("Australia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/au.svg',
            'pattern'=>'/^\d{12}$/'
        ],
        [
            'iso'=>'AT',
            'dial_code'=>'+43',
            'mask'=>'######',
            'length'=>6,
            'name'=>__("Austria", 'emptytheme'),
            'flag'=>'https://flagcdn.com/at.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'AZ',
            'dial_code'=>'+994',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Azerbaijan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/az.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'BI',
            'dial_code'=>'+257',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Burundi", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bi.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'BE',
            'dial_code'=>'+32',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Belgium", 'emptytheme'),
            'flag'=>'https://flagcdn.com/be.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'BJ',
            'dial_code'=>'+229',
            'mask'=>'## ## ## ## ##',
            'length'=>10,
            'name'=>__("Benin", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bj.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'BF',
            'dial_code'=>'+226',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Burkina Faso", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bf.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'BD',
            'dial_code'=>'+880',
            'mask'=>'####',
            'length'=>4,
            'name'=>__("Bangladesh", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bd.svg',
            'pattern'=>'/^\d{4}$/'
        ],
        [
            'iso'=>'BG',
            'dial_code'=>'+359',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Bulgaria", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bg.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'BH',
            'dial_code'=>'+973',
            'mask'=>'#### ####',
            'length'=>8,
            'name'=>__("Bahrain", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bh.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'BA',
            'dial_code'=>'+387',
            'mask'=>'## ## ## ###',
            'length'=>9,
            'name'=>__("Bosnia and Herzegovina", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ba.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'BY',
            'dial_code'=>'+375',
            'mask'=>'#### ## ###',
            'length'=>9,
            'name'=>__("Belarus", 'emptytheme'),
            'flag'=>'https://flagcdn.com/by.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'BZ',
            'dial_code'=>'+501',
            'mask'=>'### #### ###',
            'length'=>10,
            'name'=>__("Belize", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bz.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'BR',
            'dial_code'=>'+55',
            'mask'=>'## ##### ####',
            'length'=>11,
            'name'=>__("Brazil", 'emptytheme'),
            'flag'=>'https://flagcdn.com/br.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'BT',
            'dial_code'=>'+975',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Bhutan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bt.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'BW',
            'dial_code'=>'+267',
            'mask'=>'#### ### ###',
            'length'=>10,
            'name'=>__("Botswana", 'emptytheme'),
            'flag'=>'https://flagcdn.com/bw.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'CF',
            'dial_code'=>'+236',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Central African Republic", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cf.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'CC',
            'dial_code'=>'+61',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Cocos (Keeling) Islands", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cc.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'CH',
            'dial_code'=>'+41',
            'mask'=>'### ## ### ## ##',
            'length'=>12,
            'name'=>__("Switzerland", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ch.svg',
            'pattern'=>'/^\d{12}$/'
        ],
        [
            'iso'=>'CL',
            'dial_code'=>'+56',
            'mask'=>'#### ### ####',
            'length'=>11,
            'name'=>__("Chile", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cl.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'CN',
            'dial_code'=>'+86',
            'mask'=>'## ### ### ####',
            'length'=>12,
            'name'=>__("China", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cn.svg',
            'pattern'=>'/^\d{12}$/'
        ],
        [
            'iso'=>'CM',
            'dial_code'=>'+237',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Cameroon", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cm.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'CK',
            'dial_code'=>'+682',
            'mask'=>'## ###',
            'length'=>5,
            'name'=>__("Cook Islands", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ck.svg',
            'pattern'=>'/^\d{5}$/'
        ],
        [
            'iso'=>'CO',
            'dial_code'=>'+57',
            'mask'=>'### #######',
            'length'=>10,
            'name'=>__("Colombia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/co.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'CR',
            'dial_code'=>'+506',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Costa Rica", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cr.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'CU',
            'dial_code'=>'+53',
            'mask'=>'### #######',
            'length'=>10,
            'name'=>__("Cuba", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cu.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'CX',
            'dial_code'=>'+61',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Christmas Island", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cx.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'CY',
            'dial_code'=>'+357',
            'mask'=>'## ######',
            'length'=>8,
            'name'=>__("Cyprus", 'emptytheme'),
            'flag'=>'https://flagcdn.com/cy.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'DE',
            'dial_code'=>'+49',
            'mask'=>'#### ## #######',
            'length'=>13,
            'name'=>__("Germany", 'emptytheme'),
            'flag'=>'https://flagcdn.com/de.svg',
            'pattern'=>'/^\d{13}$/'
        ],
        [
            'iso'=>'DJ',
            'dial_code'=>'+253',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Djibouti", 'emptytheme'),
            'flag'=>'https://flagcdn.com/dj.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'DK',
            'dial_code'=>'+45',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Denmark", 'emptytheme'),
            'flag'=>'https://flagcdn.com/dk.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'EC',
            'dial_code'=>'+593',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Ecuador", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ec.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'EG',
            'dial_code'=>'+20',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Egypt", 'emptytheme'),
            'flag'=>'https://flagcdn.com/eg.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'ER',
            'dial_code'=>'+291',
            'mask'=>'### ###',
            'length'=>6,
            'name'=>__("Eritrea", 'emptytheme'),
            'flag'=>'https://flagcdn.com/er.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'ES',
            'dial_code'=>'+34',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Spain", 'emptytheme'),
            'flag'=>'https://flagcdn.com/es.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'EE',
            'dial_code'=>'+372',
            'mask'=>'#### ### ###',
            'length'=>10,
            'name'=>__("Estonia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ee.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'ET',
            'dial_code'=>'+251',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Ethiopia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/et.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'FI',
            'dial_code'=>'+358',
            'mask'=>'######',
            'length'=>6,
            'name'=>__("Finland", 'emptytheme'),
            'flag'=>'https://flagcdn.com/fi.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'FJ',
            'dial_code'=>'+679',
            'mask'=>'#### ### ####',
            'length'=>11,
            'name'=>__("Fiji", 'emptytheme'),
            'flag'=>'https://flagcdn.com/fj.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'FR',
            'dial_code'=>'+33',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("France", 'emptytheme'),
            'flag'=>'https://flagcdn.com/fr.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'FO',
            'dial_code'=>'+298',
            'mask'=>'######',
            'length'=>6,
            'name'=>__("Faroe Islands", 'emptytheme'),
            'flag'=>'https://flagcdn.com/fo.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'GA',
            'dial_code'=>'+241',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Gabon", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ga.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'GE',
            'dial_code'=>'+995',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Georgia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ge.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'GH',
            'dial_code'=>'+233',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Ghana", 'emptytheme'),
            'flag'=>'https://flagcdn.com/gh.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'GI',
            'dial_code'=>'+350',
            'mask'=>'### #####',
            'length'=>8,
            'name'=>__("Gibraltar", 'emptytheme'),
            'flag'=>'https://flagcdn.com/gi.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'GN',
            'dial_code'=>'+224',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Guinea", 'emptytheme'),
            'flag'=>'https://flagcdn.com/gn.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'GP',
            'dial_code'=>'+590',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Guadeloupe", 'emptytheme'),
            'flag'=>'https://flagcdn.com/gp.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'GL',
            'dial_code'=>'+299',
            'mask'=>'## ## ##',
            'length'=>6,
            'name'=>__("Greenland", 'emptytheme'),
            'flag'=>'https://flagcdn.com/gl.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'GF',
            'dial_code'=>'+594',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("French Guiana", 'emptytheme'),
            'flag'=>'https://flagcdn.com/gf.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'LB',
            'dial_code'=>'+961',
            'mask'=>'## ### ###',
            'length'=>8,
            'name'=>__("Lebanon", 'emptytheme'),
            'flag'=>'https://flagcdn.com/lb.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'LY',
            'dial_code'=>'+218',
            'mask'=>'## #######',
            'length'=>9,
            'name'=>__("Libya", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ly.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'LS',
            'dial_code'=>'+266',
            'mask'=>'#### ####',
            'length'=>8,
            'name'=>__("Lesotho", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ls.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'LT',
            'dial_code'=>'+370',
            'mask'=>'### ## ###',
            'length'=>8,
            'name'=>__("Lithuania", 'emptytheme'),
            'flag'=>'https://flagcdn.com/lt.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'LU',
            'dial_code'=>'+352',
            'mask'=>'## ## ## ###',
            'length'=>9,
            'name'=>__("Luxembourg", 'emptytheme'),
            'flag'=>'https://flagcdn.com/lu.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'LV',
            'dial_code'=>'+371',
            'mask'=>'## ### ###',
            'length'=>8,
            'name'=>__("Latvia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/lv.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'MA',
            'dial_code'=>'+212',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Morocco", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ma.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'MC',
            'dial_code'=>'+377',
            'mask'=>'### ### ##',
            'length'=>8,
            'name'=>__("Monaco", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mc.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'MG',
            'dial_code'=>'+261',
            'mask'=>'## ## ### ##',
            'length'=>9,
            'name'=>__("Madagascar", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mg.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'MV',
            'dial_code'=>'+960',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Maldives", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mv.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'MX',
            'dial_code'=>'+52',
            'mask'=>'## #### ####',
            'length'=>10,
            'name'=>__("Mexico", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mx.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'MH',
            'dial_code'=>'+692',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Marshall Islands", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mh.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'ML',
            'dial_code'=>'+223',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Mali", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ml.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'MT',
            'dial_code'=>'+356',
            'mask'=>'#### ####',
            'length'=>8,
            'name'=>__("Malta", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mt.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'MN',
            'dial_code'=>'+976',
            'mask'=>'## ## ####',
            'length'=>8,
            'name'=>__("Mongolia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mn.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'MZ',
            'dial_code'=>'+258',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Mozambique", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mz.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'MR',
            'dial_code'=>'+222',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Mauritania", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mr.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'MQ',
            'dial_code'=>'+596',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Martinique", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mq.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'MU',
            'dial_code'=>'+230',
            'mask'=>'##### #####',
            'length'=>10,
            'name'=>__("Mauritius", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mu.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'MW',
            'dial_code'=>'+265',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Malawi", 'emptytheme'),
            'flag'=>'https://flagcdn.com/mw.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'MY',
            'dial_code'=>'+60',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Malaysia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/my.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'YT',
            'dial_code'=>'+262',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Mayotte", 'emptytheme'),
            'flag'=>'https://flagcdn.com/yt.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'NA',
            'dial_code'=>'+264',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Namibia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/na.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'NC',
            'dial_code'=>'+687',
            'mask'=>'## ## ##',
            'length'=>6,
            'name'=>__("New Caledonia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/nc.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'NE',
            'dial_code'=>'+227',
            'mask'=>'## ### ###',
            'length'=>8,
            'name'=>__("Niger", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ne.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'NF',
            'dial_code'=>'+672',
            'mask'=>'## ####',
            'length'=>6,
            'name'=>__("Norfolk Island", 'emptytheme'),
            'flag'=>'https://flagcdn.com/nf.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'NG',
            'dial_code'=>'+234',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Nigeria", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ng.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'NI',
            'dial_code'=>'+505',
            'mask'=>'#### ####',
            'length'=>8,
            'name'=>__("Nicaragua", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ni.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'NU',
            'dial_code'=>'+683',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Niue", 'emptytheme'),
            'flag'=>'https://flagcdn.com/nu.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'NL',
            'dial_code'=>'+31',
            'mask'=>'### ### #####',
            'length'=>11,
            'name'=>__("Netherlands", 'emptytheme'),
            'flag'=>'https://flagcdn.com/nl.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'NO',
            'dial_code'=>'+47',
            'mask'=>'### ## ###',
            'length'=>8,
            'name'=>__("Norway", 'emptytheme'),
            'flag'=>'https://flagcdn.com/no.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'NP',
            'dial_code'=>'+977',
            'mask'=>'#### ## #####',
            'length'=>11,
            'name'=>__("Nepal", 'emptytheme'),
            'flag'=>'https://flagcdn.com/np.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'NR',
            'dial_code'=>'+674',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Nauru", 'emptytheme'),
            'flag'=>'https://flagcdn.com/nr.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'NZ',
            'dial_code'=>'+64',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("New Zealand", 'emptytheme'),
            'flag'=>'https://flagcdn.com/nz.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'OM',
            'dial_code'=>'+968',
            'mask'=>'## ######',
            'length'=>8,
            'name'=>__("Oman", 'emptytheme'),
            'flag'=>'https://flagcdn.com/om.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'PK',
            'dial_code'=>'+92',
            'mask'=>'### ### ### ###',
            'length'=>12,
            'name'=>__("Pakistan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pk.svg',
            'pattern'=>'/^\d{12}$/'
        ],
        [
            'iso'=>'PA',
            'dial_code'=>'+507',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Panama", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pa.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'PE',
            'dial_code'=>'+51',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Peru", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pe.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'PH',
            'dial_code'=>'+63',
            'mask'=>'#### ### ####',
            'length'=>11,
            'name'=>__("Philippines", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ph.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'PW',
            'dial_code'=>'+680',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Palau", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pw.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'PG',
            'dial_code'=>'+675',
            'mask'=>'#### ####',
            'length'=>8,
            'name'=>__("Papua New Guinea", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pg.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'PL',
            'dial_code'=>'+48',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Poland", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pl.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'PT',
            'dial_code'=>'+351',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Portugal", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pt.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'PY',
            'dial_code'=>'+595',
            'mask'=>'#### ### ####',
            'length'=>11,
            'name'=>__("Paraguay", 'emptytheme'),
            'flag'=>'https://flagcdn.com/py.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'PF',
            'dial_code'=>'+689',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("French Polynesia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pf.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'QA',
            'dial_code'=>'+974',
            'mask'=>'#### ####',
            'length'=>8,
            'name'=>__("Qatar", 'emptytheme'),
            'flag'=>'https://flagcdn.com/qa.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'RE',
            'dial_code'=>'+262',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Réunion", 'emptytheme'),
            'flag'=>'https://flagcdn.com/re.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'RO',
            'dial_code'=>'+40',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Romania", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ro.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'RU',
            'dial_code'=>'+7',
            'mask'=>'#### #### ### ###',
            'length'=>14,
            'name'=>__("Russian Federation", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ru.svg',
            'pattern'=>'/^\d{14}$/'
        ],
        [
            'iso'=>'RW',
            'dial_code'=>'+250',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Rwanda", 'emptytheme'),
            'flag'=>'https://flagcdn.com/rw.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'SA',
            'dial_code'=>'+966',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Saudi Arabia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sa.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'SD',
            'dial_code'=>'+249',
            'mask'=>'## ### ####',
            'length'=>9,
            'name'=>__("Sudan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sd.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'SN',
            'dial_code'=>'+221',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Senegal", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sn.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'SG',
            'dial_code'=>'+65',
            'mask'=>'#### #### ###',
            'length'=>11,
            'name'=>__("Singapore", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sg.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'SB',
            'dial_code'=>'+677',
            'mask'=>'## #####',
            'length'=>7,
            'name'=>__("Solomon Islands", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sb.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'SL',
            'dial_code'=>'+232',
            'mask'=>'## ######',
            'length'=>8,
            'name'=>__("Sierra Leone", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sl.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'SV',
            'dial_code'=>'+503',
            'mask'=>'### #### ####',
            'length'=>11,
            'name'=>__("El Salvador", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sv.svg',
            'pattern'=>'/^\d{11}$/'
        ],
        [
            'iso'=>'SM',
            'dial_code'=>'+378',
            'mask'=>'#### ######',
            'length'=>10,
            'name'=>__("San Marino", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sm.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'SO',
            'dial_code'=>'+252',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Somalia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/so.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'PM',
            'dial_code'=>'+508',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Saint Pierre and Miquelon", 'emptytheme'),
            'flag'=>'https://flagcdn.com/pm.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'RS',
            'dial_code'=>'+381',
            'mask'=>'###',
            'length'=>3,
            'name'=>__("Serbia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/rs.svg',
            'pattern'=>'/^\d{3}$/'
        ],
        [
            'iso'=>'SS',
            'dial_code'=>'+211',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("South Sudan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ss.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'SR',
            'dial_code'=>'+597',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Suriname", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sr.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'SK',
            'dial_code'=>'+421',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Slovakia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sk.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'SI',
            'dial_code'=>'+386',
            'mask'=>'### #####',
            'length'=>8,
            'name'=>__("Slovenia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/si.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'SE',
            'dial_code'=>'+46',
            'mask'=>'### ## ### ## ##',
            'length'=>12,
            'name'=>__("Sweden", 'emptytheme'),
            'flag'=>'https://flagcdn.com/se.svg',
            'pattern'=>'/^\d{12}$/'
        ],
        [
            'iso'=>'SC',
            'dial_code'=>'+248',
            'mask'=>'### ###',
            'length'=>6,
            'name'=>__("Seychelles", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sc.svg',
            'pattern'=>'/^\d{6}$/'
        ],
        [
            'iso'=>'SY',
            'dial_code'=>'+963',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Syrian Arab Republic", 'emptytheme'),
            'flag'=>'https://flagcdn.com/sy.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'TD',
            'dial_code'=>'+235',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Chad", 'emptytheme'),
            'flag'=>'https://flagcdn.com/td.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'TG',
            'dial_code'=>'+228',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Togo", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tg.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'TH',
            'dial_code'=>'+66',
            'mask'=>'#### ### ###',
            'length'=>10,
            'name'=>__("Thailand", 'emptytheme'),
            'flag'=>'https://flagcdn.com/th.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'TJ',
            'dial_code'=>'+992',
            'mask'=>'### ## ####',
            'length'=>9,
            'name'=>__("Tajikistan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tj.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'TK',
            'dial_code'=>'+690',
            'mask'=>'#####',
            'length'=>5,
            'name'=>__("Tokelau", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tk.svg',
            'pattern'=>'/^\d{5}$/'
        ],
        [
            'iso'=>'TM',
            'dial_code'=>'+993',
            'mask'=>'## ## ## ##',
            'length'=>8,
            'name'=>__("Turkmenistan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tm.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'TO',
            'dial_code'=>'+676',
            'mask'=>'#### ###',
            'length'=>7,
            'name'=>__("Tonga", 'emptytheme'),
            'flag'=>'https://flagcdn.com/to.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'TN',
            'dial_code'=>'+216',
            'mask'=>'## ### ###',
            'length'=>8,
            'name'=>__("Tunisia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tn.svg',
            'pattern'=>'/^\d{8}$/'
        ],
        [
            'iso'=>'TR',
            'dial_code'=>'+90',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("Turkey", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tr.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'TV',
            'dial_code'=>'+688',
            'mask'=>'## #####',
            'length'=>7,
            'name'=>__("Tuvalu", 'emptytheme'),
            'flag'=>'https://flagcdn.com/tv.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'UG',
            'dial_code'=>'+256',
            'mask'=>'#### #####',
            'length'=>9,
            'name'=>__("Uganda", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ug.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'UA',
            'dial_code'=>'+380',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Ukraine", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ua.svg',
            'pattern'=>'/^(39|50|63|66|67|68|73|91|92|93|94|95|96|97|98|99)\d{7}$/'
        ],
        [
            'iso'=>'UY',
            'dial_code'=>'+598',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Uruguay", 'emptytheme'),
            'flag'=>'https://flagcdn.com/uy.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'US',
            'dial_code'=>'+1',
            'mask'=>'### ### ####',
            'length'=>10,
            'name'=>__("United States", 'emptytheme'),
            'flag'=>'https://flagcdn.com/us.svg',
            'pattern'=>'/^\d{10}$/'
        ],
        [
            'iso'=>'UZ',
            'dial_code'=>'+998',
            'mask'=>'## ### ## ##',
            'length'=>9,
            'name'=>__("Uzbekistan", 'emptytheme'),
            'flag'=>'https://flagcdn.com/uz.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'VU',
            'dial_code'=>'+678',
            'mask'=>'### ####',
            'length'=>7,
            'name'=>__("Vanuatu", 'emptytheme'),
            'flag'=>'https://flagcdn.com/vu.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'WF',
            'dial_code'=>'+681',
            'mask'=>'### ## ## ##',
            'length'=>9,
            'name'=>__("Wallis and Futuna", 'emptytheme'),
            'flag'=>'https://flagcdn.com/wf.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'WS',
            'dial_code'=>'+685',
            'mask'=>'## #####',
            'length'=>7,
            'name'=>__("Samoa", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ws.svg',
            'pattern'=>'/^\d{7}$/'
        ],
        [
            'iso'=>'YE',
            'dial_code'=>'+967',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Yemen", 'emptytheme'),
            'flag'=>'https://flagcdn.com/ye.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'ZM',
            'dial_code'=>'+260',
            'mask'=>'### ### ###',
            'length'=>9,
            'name'=>__("Zambia", 'emptytheme'),
            'flag'=>'https://flagcdn.com/zm.svg',
            'pattern'=>'/^\d{9}$/'
        ],
        [
            'iso'=>'ZW',
            'dial_code'=>'+263',
            'mask'=>'#### ######',
            'length'=>10,
            'name'=>__("Zimbabwe", 'emptytheme'),
            'flag'=>'https://flagcdn.com/zw.svg',
            'pattern'=>'/^\d{10}$/'
        ],
    ];
}
