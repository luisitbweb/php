<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudo de Calendario PHP</title>
    </head>
    <body>
        <?php
        /*
         * 
        $d = cal_days_in_month(CAL_GREGORIAN, 10, 1985);
        echo "Houve $d dias em Outubro 1985.<br />";
        $a = cal_days_in_month(CAL_GREGORIAN, 10, 2015);
        echo "Houve $a dias em Outubro 2015.";
         * 
         */
        
        /*
         * 
        $d = unixtojd(mktime(0, 0, 0, 6, 20, 2007));
        print_r(cal_from_jd($jd, CAL_GREGORIAN));
         * 
         */
        
        /*
         * 
        print_r(cal_info(0));
         * 
         */
        
        /*
        $d = cal_to_jd(CAL_GREGORIAN, 10, 17, 1985);
        echo "$d";
         * 
         */
        
        /*
         * 
        echo easter_date() . "<br />";
        echo date("M-d-Y", easter_date()) . "<br />";
        echo date("M-d-Y", easter_date(1985)) . "<br />";
        echo date("M-d-Y", easter_date(1975)) . "<br />";
        echo date("M-d-Y", easter_date(2007)) . "<br />";
        echo date("M-d-Y", easter_date(1998)) . "<br />";
         * 
         */
        /*
         * 
        echo "Dia de Pascoa " .  easter_days() . " Dias depois de 21 março deste ano. <br />";
        echo "Dia de pascoa foi " . easter_days(1985) . " Dias depois de 21 março em 1985. <br />";
        echo "Dia de pascoa foi " . easter_days(1342) . " Dias depois de 21 março em 1342. <br />";
        echo "O dia de pascoa sera " . easter_days(2050) . " Dias depois de 21 março em 2050.";
         * 
         */
        
        /*
         * 
        $jd = frenchtojd(3, 3, 10);
        echo $jd . "<br />";
        echo jdtofrench($jd);
         * 
         */
        
        /*
         * 
        $jd = gregoriantojd(10, 17, 1985);
        echo $jd . "<br />";
        echo jdtogregorian($jd);
         * 
         */
        
        /*
         * 
        $jd = gregoriantojd(10, 17, 1985);
        echo jddayofweek($jd,2);
         * 
         */
        
        /*
         * 
        $jd = gregoriantojd(10, 17, 1985);
        echo jdmonthname($jd, 3);
         * 
         */
        
        /*
         * 
        $jd = frenchtojd(10, 17, 5);
        echo $jd . "<br />";
        echo jdtofrench($jd);
         * 
         */
        
        /*
         * 
        $jd = gregoriantojd(10, 17, 1985);
        echo $jd . "<br />";
        echo jdtogregorian($jd);
         * 
         */
        
        /*
         * 
        $jd = juliantojd(10, 17, 1985);
        echo $jd . "<br />";
        echo jdtojulian($jd);
         * 
         */
        
        /*
         * 
        $jd = gregoriantojd(10, 17, 1985);
        echo jdtounix($jd);
         * 
         */
        
        /*
         * 
        $jd = jewishtojd(11, 17, 1985);
        echo $jd;
         * 
         */
        
        /*
         * 
        $jd = juliantojd(11, 17, 1985);
        echo $jd . "<br />";
        echo jdtojulian($jd);
         * 
         */
        
        /*
         * 
        echo unixtojd(1985);
         * 
         */
        
        /*
         * 
        var_dump(checkdate(10, 17, 1985));
        echo "<br />";
        var_dump(checkdate(2, 29, 2003));
        echo "<br />";
        var_dump(checkdate(2, 29, -400));
         * 
         */
        
        /*
         * 
        $data = date_create("1985-10-17");
        date_add($data, date_interval_create_from_date_string("40 days"));
        echo date_format($data, "Y-m-d");
         * 
         */
        
        /*
         * 
        $data = date_create_from_format("j-M-Y", "17-Mar-1985");
        echo date_format($data, "Y/m/d");
         * 
         */
        
        /*
         * 
        $data = date_create("1985-10-17 23:40:00", timezone_open("Europe/Oslo"));
        echo date_format($data,  "Y/m/d H:iP");
         * 
         */
        
        /*
         * 
        $data = date_create();
        date_date_set($data, 2030, 10, 17);
        echo date_format($data, "Y/m/d"). "<br />";
        echo date_default_timezone_get(). "<br />";
        date_default_timezone_set("Asia/Bangkok");
        echo date_default_timezone_get();
         * 
         */
        
        /*
         * 
        $data1 = date_create("2015-06-19");
        $data2 = date_create("1985-10-17");
        $diff = date_diff($data1, $data2);
        echo $diff -> format("%R%a days");
         * 
         */
        
        /*
         *
        $data = date_create("1985-10-17");
        echo date_format($data, "Y/m/d H:i:s"). "<br />";
        date_create("gyuigyuigyui%&&/");
        print_r(date_get_last_errors());
         *
         */
        
        /*
         * 
        $data1 = date_create("1985-10-17");
        $data2 = date_create("2013-02-10");
        $diff = date_diff($data1, $data2);
        
        // %a emite o numero total de dias
        echo $diff -> format("Total numeros de dias: %a.");
        echo "<br />";
        
        // %R saidas + porque $data2 e depois $data1(Um positivo intervalo)
        echo $diff -> format("Total numeros de dias: %R%a.");
        echo "<br />";
        
        // %d emite o numero de dias que não esta coberto por mes
        echo $diff -> format("Mes: %m, dias: %d.");
         * 
         */
        
        /*
         * 
        $data = date_create();
        date_isodate_set($data, 1985, 4, 17);
        echo date_format($data, "Y-m-d"). "<br />";
        date_isodate_set($data, 2013, 5, 2);
        echo date_format($data, "Y-m-d");
        echo "<br />";
        $data1 = date_create("1985-10-17");
        date_modify($data1, "-15 days");
        echo date_format($data1, "Y-m-d");
         * 
         */
        
        /*
         * 
        $inverno = date_create("1985-10-17", timezone_open("Europe/Oslo"));
        $verao = date_create("2014-06-30", timezone_open("Europe/Oslo"));
        echo date_offset_get($inverno). " segundos. <br />";
        echo date_offset_get($verao). " segundos.<br />";
        print_r(date_parse_from_format("mmddyyyy", "05122013"));
        echo "<br />";
        print_r(date_parse_from_format("j.n.Y H:iP", "12.5.2013 14:35+02:00"));
         * 
         */
        
        /*
         * 
        print_r(date_parse("1985-05-01 12:30:45"));
        echo "<br />";
        $data = date_create("1985-10-17");
        date_sub($data, date_interval_create_from_date_string("40 days"));
        echo date_format($data, "Y-m-d");
         * 
         */
        
        /*
         * 
        echo "<h3>Data: 1st Janeiro, 1985</h3>";
        $sun_info = date_sun_info(strtotime("1985-01-01"),31.7667,35.2333);
        foreach ($sun_info as $key => $val){
            echo "$key: ". date("H:i:s",$val). "<br />";
        }
        echo "<h3>Data: 1st junio, 1985</h3>";
        $sun_info = date_sun_info(strtotime("1985-06-01"),31.7667,35.2333);
        foreach ($sun_info as $key => $val){
            echo "$key: ". date("H:i:s",$val). "<br />";
        }
         * 
         */
        
        // calcula o nascer do sol hora para lisboa, Portugal
        // latitude: 38.4 norte
        // longitude: 9 oeste
        // zenete ~= 90
        // offset: 1+ GMT
        /*
         * 
        echo("<h2>Lisboa, Portugal</h2>");
        echo("Date: " . date("D M d Y"));
        echo("<br>Sunrise time: ");
        echo(date_sunrise(time(),SUNFUNCS_RET_STRING,38.4,-9,90,1));
        echo("<br>Sunset time: ");
        echo(date_sunset(time(),SUNFUNCS_RET_STRING,38.4,-9,90,1));
         * 
         */
        
        // calcula o tempo do pordo sol par lisboa e portugal
        // latitude: 38.4 norte
        // longitude: 9 oeste
        // zenete ~= 90
        // offset: 1+ GMT
        /*
         * 
        echo("<h2>Lisboa, Portugal</h2>");
        echo("Date: ". date("D M d Y"));
        echo("<br />Nascer do sol: ");
        echo(date_sunrise(time(), SUNFUNCS_RET_STRING, 38.4,-9,90,1));
        echo("<br />Hora por do sol: ");
        echo(date_sunset(time(),SUNFUNCS_RET_STRING, 38.4,-9,90,1));
         * 
         */
        
        /*
         * 
        $data = date_create("1985-10-17");
        date_time_set($data, 13, 25, 15);
        echo date_format($data, "Y-m-d H:i:s") . "<br />";
        date_time_set($data, 12, 20, 55);
        echo date_format($data, "Y-m-d H:i:s") . "<br />";
        
        $data1 = date_create();
        echo date_timestamp_get($data1) . "<br />";
        date_timestamp_set($data1, 1371803321);
        echo date_format($data1, "U = Y-m-d H:i:s");
         * 
         */
        
        /*
         * 
        $data = date_create(NULL, timezone_open("Europe/Paris"));
        $tz = date_timezone_get($data);
        echo timezone_name_get($tz);
         * 
         */
        
        /*
         * 
        $date=date_create("2013-05-25",timezone_open("Indian/Kerguelen"));
        echo date_format($date,"Y-m-d H:i:sP") . "<br>";

        date_timezone_set($date,timezone_open("Europe/Paris"));
        echo date_format($date,"Y-m-d H:i:sP");
         * 
         */
        
        /*
         * 
        // imprime o dia
        echo date("1")."<br />";
        // imprime o dia, data, mes, ano, hora, AM ou PM
        echo date("l jS \of F Y h:i:s A")."<br />";
        // imprime outubro 17, 1985 foi em uma sexta-feira
        echo "Oct 17, 1985 foi em uma " .  date("1", mktime(0,0,0,10,3,1985))."<br />";
        // usa uma constante no formato de parametro
        echo date(DATE_RFC822)."<br />";
        // imprime algo como: 1985-10-03T00:00:00+00:00
        echo date(DATE_ATOM,  mktime(0,0,0,10,3,1985));
         * 
         */
        
        // imprime a matriz de getdate()
        print_r(getdate());
        echo"<br><br>";
        // retorna data hora informada de um timestamp que formata a saida
        $mydate = getdate(date("U"));
        echo "$mydate[weekday],$mydate[month]$mydate[mday], $mydate[year]";
        ?>
    </body>
</html>
