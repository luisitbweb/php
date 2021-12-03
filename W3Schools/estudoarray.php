<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /* 
         * 
        $carros = array(
            array("volvo",100,96),
            array("BMW",60,59),
            array("toyota",110,100)
        );
        echo $carros[0][0].": Ordenou: ".$carros[0][1].". Vendidos: ".$carros[0][2]."<br>";
        echo $carros[1][0].": Ordenou: ".$carros[1][1].". Vendidos: ".$carros[1][2]."<br>";
        echo $carros[2][0].": Ordenou: ".$carros[2][1].". Vendidos: ".$carros[2][2]."<br>";
         * 
         */
        
        /*
         * 
        $idade = array("peter"=>"35", "ben"=>"37", "joe"=>"43");
        print_r(array_change_key_case($idade,CASE_UPPER));
        echo "<br /><br />";
        print_r(array_change_key_case($idade,CASE_LOWER));
         * 
        */
        
        /*
         * 
        $carros = array("volvo", "BMW", "toyota", "honda", "mercedes", "opel");
        print_r(array_chunk($carros, 2,TRUE));
         * 
        */
        
        /*
         * 
        $a = array(
          array(
            'id' => 5698,
            'primeiro_nome' => 'luis',
            'segundo_nome' => 'carlos',
          ),  
            array(
              'id' => '4767',
              'primeiro_nome' => 'irani',
              'segundo_nome' => 'maria',
            ),
            array(
                'id' => 3809,
                'primeiro_nome' => 'stefania',
                'segundo_nome' => 'silva',
            )
        );
        
        $ultimos_nomes = array_column($a, 'primeiro_nome');
        print_r($ultimos_nomes);
         * 
         */
        
        /*
         * 
        $fnome = array("luis", "carlos", "silva");
        $idade = array("29", "54", "44");
        
        $c = array_combine($fnome, $idade);
        print_r($c);
         * 
         */
        
        /*
         * 
        $a = array("A", "Gato", "Cachorro", "A", "Cachorro");
        print_r(array_count_values($a));
         * 
         */
        
        /*
         * 
        $a = array("V" => "red", "VR" => "green", "A" => "blue", "AM" => "yellow");
        $b = array("B" => "white", "P" => "black", "R" => "purple");
        $c = array("L" => "orange", "M" => "brown", "L" => "lilac");
        
        $resultado = array_diff($a, $b, $c);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = array("V" => "red", "VR" => "green", "A" => "blue", "A" => "yellow");
        $b = array("B" => "white", "P" => "black", "R" => "purple");
        $c = array("L" => "orange", "M" => "brown", "L" => "lilac");
        
        $resultado = array_diff_assoc($a, $b, $c);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = array("V" => "red", "V" => "green", "A" => "blue", "AM" => "yellow");
        $b = array("B" => "white", "P" => "black", "R" => "purple");
        $c = array("L" => "orange", "M" => "brown", "L" => "lilac");
        
        $resultado = array_diff_key($a, $b, $c);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        function retorna_valor($a, $b){
                     
            if ($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        
        $a = array("V" => "red", "V" => "green", "A" => "blue", "A" => "yellow");
        $b = array("B" => "white", "P" => "black", "R" => "purple");
        $c = array("L" => "orange", "M" => "brown", "L" => "lilac");
                
        $resultado = array_diff_uassoc($a, $b, $c, "retorna_valor");
        print_r($resultado);
         * 
         */
        
        /*
         * 
        function retorna_valor($a, $b){
                     
            if ($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        
        $a = array("V" => "red", "v" => "green", "A" => "blue", "A" => "yellow");
        $b = array("B" => "white", "P" => "black", "R" => "purple");
        $c = array("L" => "orange", "M" => "brown", "L" => "lilac");
                
        $resultado = array_diff_ukey($a, $b, $c, "retorna_valor");
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = array_fill(3, 4, "azul");
        $b = array_fill(0, 1, "vermelho");
        print_r($a);
        echo "<br />";
        print_r($b);
         * 
         */
        
        /*
         * 
        $luis = array("a", "b", "c", "d");
        $a = array_fill_keys($luis, "azul");
        print_r($a);
         * 
         */
        
        /*
         * 
        function test_odd($var){
            return ($var & 1);
        }
        $a = array("a", "b", 5, 6, 9, 7, 4);
        print_r(array_filter($a, "test_odd"));
         * 
         */
        /*
         * 
        $a = array("a"=>"vermelho", "b"=>"verde", "c"=>"azul", "d"=>"amarelo");
        $resultado = array_flip($a);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = array("V" => "lilac", "v" => "green", "A" => "blue", "A" => "yellow");
        $b = array("B" => "lilac", "P" => "blue", "R" => "purple");
        $c = array("L" => "blue", "M" => "brown", "L" => "lilac");
        
        $resultado = array_intersect($a, $b, $c);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = ["L" => "lilac", "v" => "green", "A" => "blue", "A" => "yellow"];
        $b = ["L" => "lilac", "P" => "blue", "R" => "purple"];
        $c = ["L" => "blue", "M" => "brown", "L" => "lilac"];
        
        $resultado = array_intersect_assoc($a, $b, $c);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = ["l" => "lilac", "v" => "green", "a" => "blue", "a" => "yellow"];
        $b = ["l" => "lilac", "a" => "blue", "r" => "purple"];
        $c = ["a" => "yellow", "M" => "brown", "l" => "lilac"];
        
        $resultado = array_intersect_key($b, $a, $c);
        print_r($resultado);
         * 
         */
        
        /*
         * 
        function luis($a, $c){
            if($a === $c){
                return 0; 
            }
            return ($a > $c) ? 1 : -1;
        }
        $a = ["g" => "gol", "p" => "prisma", "f" => "ferrari", "l" => "lamburgine"];
        $b = ["a" => "gol", "p" => "prisma", "f" => "ferrari"];
        $c = ["a" => "blue", "M" => "brown", "f" => "ferrari", "g" => "gol"];
        $resultado = array_intersect_uassoc($a, $c, "luis");
        print_r($resultado);
         * 
         */
        
        /*
         * 
        function luis($a, $b){
            if($a === $b){
                return 0; 
            }
            return ($a > $b) ? 1 : -1;
        }
        $a = ["g" => "gol", "p" => "prisma", "f" => "ferrari", "l" => "lamburgine"];
        $b = ["a" => "gol", "p" => "prisma", "f" => "ferrari"];
        $c = ["a" => "blue", "M" => "brown", "f" => "ferrari", "l" => "gol"];
        $resultado = array_intersect_ukey($a, $b, "luis");
        print_r($resultado);
         * 
         */
        
        /*
         * 
        $a = ["gol" => "xc90", "BMW" => "x5"];
        if(array_key_exists("volvo", $a)){
            echo "a chave existe!";
        }
        else{
            echo " a chave não existe!";
        }
         * 
         */
        
        /*
         * 
        $a = [10 ,20, 30, "11"];
        print_r(array_keys($a, "11", TRUE));
         * 
         */
        
        /*
         * 
        function minha($l){
            if($l === "cachorro"){
                return "fido";
            }
            return $l;
        }
        $a = ["cavalo", "cachorro", "gato"];
        print_r(array_map("minha", $a));
         * 
         */
        
        /*
         * 
        function minha($a, $b){
            if($a === $b){
                return "O mesmo";
            }
            return "diferente";
        }
        $c = ["cavalo", "cachorro", "gato"];
        $d = ["vaca", "cachorro", "rato"];
        print_r(array_map("minha", $c, $d));
         * 
         */
        
        /*
         * 
        function minha($a){
            $a = strtoupper($a);
            return $a;
        }
        $b = ["animal" => "cavalo", "tipo" => "mamifero"];
        print_r(array_map("minha", $b));
         * 
         */
        
        /*
         * 
        $a = ["cachorro", "gato"];
        $b = ["filhote", "gatinho"];
        print_r(array_map(NULL, $a, $b));
         * 
         */
        
        /*
         * 
        $g = ["a" => "vermelho", "b" => "verde"];
        $h = ["c" => "azul", "b" => "amarelo"];
        print_r(array_merge($g, $h));
         * 
         */
        
        /*
         * 
        $c = ["k" => "vermelho", "b" => "verde"];
        $d = ["f" => "azul", "b" => "amarelo"];
        print_r(array_merge_recursive($c, $d));
         * 
         */
        
        /*
         * 
        $a = ["cachorro", "gato", "cavalo", "suportar", "zebra"];
        array_multisort($a);
        print_r($a);
        
        echo "<br /><br />";
        
        $f = ["cachorro", "gato"];
        $s = ["fido", "missy"];
        array_multisort($f, $s);
        print_r($s);
        print_r($f);
        
        echo "<br /><br />";
        
        $h = ["cachorro", "cachorro", "gato"];
        $j = ["plutão", "fido", "missy"];
        array_multisort($h, $j);
        print_r($j);
        print_r($h);
        
        echo "<br /><br />";
        
        $t = ["cachorro", "cachorro", "gato"];
        $r = ["plutão", "fido", "missy"];
        array_multisort($t,SORT_ASC,$r,SORT_DESC);
        print_r($r);
        print_r($t);
        
        echo "<br /><br />";
        
        $i = [1, 30, 15, 7, 25];
        $b = [4, 30, 20, 41, 66];
        $num = array_merge($i, $b);
        array_multisort($num,SORT_DESC,SORT_NUMERIC);
        print_r($num);
         * 
         */
        
        /*
         * 
        $s = ["vemelho", "verde"];
        print_r(array_pad($s, 10, "blue"));
        
        echo "<br /><br />";
        
        $g = ["vermelho", "verde"];
        print_r(array_pad($g, -10, "amarelo"));
         * 
         */
        
        /*
         * 
        $g = ["vermelho", "verde", "azul"];
        array_pop($g);
        print_r($g);
         * 
         */
        
        /*
         * 
        $m = [5,6,3,4];
        echo (array_product($m));
         * 
         */
        
        /*
         * 
        $j = ["vermelho", "verde"];
        array_push($j, "teste", "amarelo");
        print_r($j);
         * 
         */
        
        /*
         * 
        $n = ["vermelho", "verde", "azul", "amarelo", "marrom"];
        $random_keys = array_rand($n, 3);
        echo $n[$random_keys[0]]."<br />";
        echo $n[$random_keys[1]]."<br />";
        echo $n[$random_keys[2]];
         * 
         */
        
        /*
         * 
        function ola($v1, $v2){
            return $v1 . "_" . $v2;
        }
        $a = ["dog", "cat", "horse"];
        print_r(array_reduce($a, "ola",5));
         * 
         */
        
        /*
         * 
        function aki($f, $f1){
            return $f + $f1;
        }
        $a = [10,15,20];
        print_r(array_reduce($a, "aki", 5));
         * 
         */
        
        /*
         * 
        $a = ["red", "green"];
        $b = ["blue", "yellow"];
        $c = ["orange", "burgundy"];
        print_r(array_replace($a, $b, $c));
         * 
         */
        
        /*
         * 
        $a = ["red", "green", "blue", "yellow"];
        $b = [0 => "orange", 3 => "burgundy"];
        print_r(array_replace($a, $b));
         * 
         */
        
        /*
         * 
        $a = ["a" => array("red"), "b" => array("green", "blue")];
        $b = ["a" => array("yellow"), "b" => array("black")];
        $c = ["a" => array("orange"), "b" => array("burgundy")];
        print_r(array_replace_recursive($a, $b, $c));
         * 
         */
        
        /*
         * 
        $a = ["a" => array("red"), "b" => array("green", "blue")];
        $b = ["a" => array("yellow"), "b" => array("black")];
        $c = ["a" => array("orange"), "b" => array("burgundy")];
        
        $resul = array_replace_recursive($a, $b, $c);
        print_r($resul);
        
        echo '<br /> <br />';
        
        $result = array_replace($a, $b, $c);
        print_r($result);
         * 
         */
        
        /*
         * 
        $a = ["volvo", "xc90", array("BMW", "toyota")];
        $rev = array_reverse($a);
        $pre = array_reverse($a, true);
        
        print_r($a);
        echo '<br /> <br />';
        print_r($rev);
        echo '<br /> <br />';
        print_r($pre);
         * 
         */
        
        /*
         * 
        $a = ["a" => "5", "b" => 5, "c" => "5"];
        echo array_search(5, $a, true);
         * 
         */
        
        /*
         * 
        $a = [0 => "red", 1 => "green", 2 => "blue"];
        echo array_shift($a);
        print_r($a);
         * 
         */
        
        /*
         * 
        $a=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow","e"=>"brown");
        print_r(array_slice($a,1,2));
     echo '<br /> <br />';
        $b=array("0"=>"red","1"=>"green","2"=>"blue","3"=>"yellow","4"=>"brown");
        print_r(array_slice($b,1,2));
         * 
         */
        
        /*
         * 
        $a = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
        $b = ["a" => "purple", "b" => "orange"];
        array_splice($a, 0, 2, $b);
        print_r($a);
         * 
         */
        
        /*
         * 
        $g = ["0" => "red", "1" => "green"];
        $h = ["0" => "purple", "1" => "orange"];
        array_splice($g,1, 0, $h);
        print_r($g);
         * 
         */
        
        /*
         * 
        $a = ["a" => 52.2, "b" => 13.7, "c" => 0.9];
        echo array_sum($a);
         * 
         */
        
        /*
         * 
        function varudif($a, $b){
            if($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        $r = ["a" => "red", "b" => "green", "c" => "blue", "yellow"];
        $f = ["A" => "red", "b" => "GREEN", "yellow", "black"];
        $v = ["a" => "green", "b" => "red", "yellow", "black"];
        
        $result = array_udiff($r, $f, $v, "varudif");
        print_r($result);
         * 
         */
        
        /*
         * 
        function part($d, $v){
            if($d === $v){
                return 0;
            }
            return ($d > $v) ? 1 : -1;
        }
        $d = ["A" => "red", "b" => "GREEN", "yellow", "black"];
        $v = ["a" => "green", "b" => "red", "yellow", "black"];
        
        $result = array_udiff_assoc($d, $v, "part");
        print_r($result);
         * 
         */
        
        /*
         * 
        function udiuas($a, $b){
            if($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        function udiua($a, $b){
            if($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        $a = ["A" => "red", "b" => "GREEN", "yellow", "black"];
        $b = ["a" => "green", "b" => "red", "yellow", "black"];
        
        $result = array_udiff_uassoc($a, $b, "udiuas", "udiua");
        print_r($result);
         * 
         */
        
        /*
         * 
        function uni($f, $d){
            if($f === $d){
                return 0;
            }
            return ($f > $d) ? 1 : -1;
        }
        $a1=array("a"=>"red","b"=>"green","c"=>"blue","yellow");
        $a2=array("A"=>"red","b"=>"GREEN","yellow","black");
        $a3=array("a"=>"green","b"=>"red","yellow","black");
        
        $result = array_uintersect($a1, $a2, $a3, "uni");
        print_r($result);
         * 
         */
        
        /*
         * 
        function aki($g, $d){
            if($g === $d){
                return 0;
            }
            return ($g > $d) ? 1 : -1;
        }
        $a1=array("a"=>"red","b"=>"green","c"=>"blue","yellow");
        $a2=array("A"=>"red","b"=>"GREEN","yellow","black");
        $a3=array("a"=>"green","b"=>"red","yellow","black");
        
        $result = array_uintersect($a1, $a2, $a3, "aki");
        print_r($result);
         * 
         */
        
        /*
         * 
        function ate($a, $b){
            if($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        $a1=array("a"=>"red","b"=>"green","c"=>"blue");
        $a2=array("a"=>"red","b"=>"blue","c"=>"green");
        
        $result = array_uintersect_assoc($a1, $a2, "ate");
        print_r($result);
         * 
         */
        
        /*
         * 
        function atelogo_key($a, $b){
            if($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        function atelogo_value($a, $b){
            if($a === $b){
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        }
        $a1=array("a"=>"red","b"=>"green","c"=>"blue");
        $a2=array("a"=>"red","b"=>"green","c"=>"yellow");
        
        $result = array_uintersect_uassoc($a1, $a2, "atelogo_key", "atelogo_value");
        print_r($result);
         * 
         */
        
        /*
         * 
        $a = ["n" => "red", "b" => "green", "c" => "red"];
        print_r(array_unique($a));
         * 
         */
        
        /*
         * 
        $a = [0 => "red", 1 => "green"];
        array_unshift($a, "yellow", "blue");
        print_r($a);
         * 
         */
        
        /*
         * 
        $a = ["name" => "luis", "idade" => "29", "Pais" => "Brasil"];
        print_r(array_values($a));
         * 
         */
        
        /*
         * 
        function ate($value, $key, $g){
            echo "$key $g $value <br />";
        }
        $a = ["a" => "red", "b" => "green", "c" => "blue"];
        array_walk($a, "ate", "= Tem um valor:");
         * 
         */
        
        /*
         * 
        function ate(&$value, $key){
            $value = "yellow";
        }
        $a = ["a"=>"red","b"=>"green","c"=>"blue"];
        array_walk($a, "ate");
        print_r($a);
         * 
         */
        
        /*
         * 
        function walk($value, $key){
            echo "A chave: $key tem o valor: $value <br />";
        }
        $a1=array("a"=>"red","b"=>"green");
        $a2=array($a1,"1"=>"blue","2"=>"yellow");
        array_walk_recursive($a2, "walk");
         * 
         */
        
        /*
         * 
        $idade = ["Peter"=>"35","Ben"=>"37","Joe"=>"43"];
        arsort($idade);
        foreach ($idade as $x => $x_value){
            echo "key=" .$x. ", value=" .$x_value;
            echo "<br />";
        }
        
        $age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
        asort($age);

        foreach($age as $x=>$x_value){
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
        }
         * 
         */
        
        /*
         * 
        $prinome = "luis";
        $segnome = "carlos";
        $idade = "29";
        
        $nome = ["prinome", "segnome"];
        $result = compact($nome, "location", "idade");
        print_r($result);
         * 
         */
        
        /*
         * 
        $cars = array
  (
  "Volvo"=>array
  (
  "XC60",
  "XC90"
  ),
  "BMW"=>array
  (
  "X3",
  "X5"
  ),
  "Toyota"=>array
  (
  "Highlander"
  )
  );
        echo "Contagem Normal: " .count($cars)."<br />";
        echo "Contagem Recursiva: " .count($cars,1);
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $a = "Original";
        $extrato = ["a" => "cat", "b" => "dog", "c" => "horse"];
        extract($extrato, EXTR_PREFIX_SAME, "dup");
        
        echo "\$a = $a; \$b = $b; \$c = $c; \$dup_a = $dup_a";
         * 
         */
        
        /*
         * 
        $pesoas = ["luis", "carlos", "silva", "santos", 29];
        if(in_array("29", $pesoas, TRUE)){
            echo "Correspondencia encontrada.<br/>";
        }
        else {
            echo "Correspondencia nao encontrada.<br/>";
        }
        if(in_array("silva", $pesoas, true)){
            echo "Correspondencia encontrada.<br/>";
        }
        else{
           echo "Correspondencia nao encontrada.<br/>"; 
        }
        if(in_array(29, $pesoas, TRUE)){
            echo "Correspondencia encontrada.<br/>";
        }
        else{
            echo "Correspondencia nao encontrada.<br/>";
        }
         * 
         */
        
        /*
         * 
        $people = ["peter", "joe", "glenn", "cleveland"];
        echo "A chave da posicao atual e: " .  key($people);
         * 
         */
        
        /*
         * 
        $idade = ["Peter"=>"35","Ben"=>"37","Joe"=>"43"];
        krsort($idade);
        foreach ($idade as $x => $x_value){
            echo "key=" .$x. ", value=" .$x_value;
            echo "<br />";
        }
         * 
         */
        
        /*
         * 
        $idade = ["Peter"=>"35","Ben"=>"37","Joe"=>"43"];
        ksort($idade);
        foreach ($idade as $x => $x_value){
            echo "key=" .$x. ", value=" .$x_value;
            echo "<br />";
        }
         * 
         */
        
        /*
         * 
        $Fato = ["dog", "cat", "horse", "leao"];
        list($a, , , $c) = $Fato;
        echo "Aqui eu so uso o $a e $c variaveis.";
         * 
         */
        
        /*
         * 
        $temp_files = ["temp15.txt","temp10.txt",
        "temp1.txt","temp22.txt","temp2.txt"];
        sort($temp_files);
        echo "Triagem padrao: ";
        print_r($temp_files);
        echo "<br /><br />";
        
        natsort($temp_files);
        echo "Natural order: ";
        print_r($temp_files);
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>" . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $numero = range(0,50,10);
        print_r($numero);
         * 
         */
        
        /*
         * 
        $people = array("Peter", "Joe", "Glenn", "Cleveland");

        echo current($people) . "<br>"; // The current element is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe
        echo current($people) . "<br>"; // Now the current element is Joe
        echo prev($people) . "<br>"; // The previous element of Joe is Peter
        echo end($people) . "<br>"; // The last element is Cleveland
        echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
        echo current($people) . "<br>"; // Now the current element is Glenn
        echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
        echo next($people) . "<br>"; // The next element of Peter is Joe

        print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
         * 
         */
        
        /*
         * 
        $carro = ["volvo", "BMW", "toyota"];
        rsort($carro, SORT_NUMERIC);
        
        $clength=  count($carro);
        for($i = 0; $i < $clength; $i++){
            echo $carro[$i];
            echo "<br />";
        }
         * 
         */
        
        /*
         * 
        $my_array = array("red","green","blue","yellow","purple");

        shuffle($my_array);
        print_r($my_array);
         * 
         */
        
        /*
         * 
        $cars=array
  (
  "Volvo"=>array
  (
  "XC60",
  "XC90"
  ),
  "BMW"=>array
  (
  "X3",
  "X5"
  ),
  "Toyota"=>array
  (
  "Highlander"
  )
  ); 

        echo "Normal count: " . sizeof($cars)."<br>";
        echo "Recursive count: " . sizeof($cars,1);
         * 
         */
        
        /*
         * 
        $numero = [4,6,2,5,0,30,100,119,110,55,70,22,11];
        sort($numero);
        $luiscarlos = count($numero);
        for($i = 0; $i < $luiscarlos; $i++){
            echo $numero[$i];
            echo "<br />";
        }
         * 
         */
        
        /*
         * 
        function sorte($a,$b){
            if($a == $b)
                return 0; 
            return ($a < $b) ? -1 : 1;
        }
        $arr = ["a"=>4,"b"=>2,"c"=>8,"d"=>6];
        uasort($arr, "sorte");
        
        foreach ($arr as $x => $x_value){
            echo "key=" .$x. ", Value=" .$x_value;
            echo "<br />";
        }
         * 
         */
        
        /*
         * 
        function sorte($a,$b){
            if($a == $b)
                return 0; 
            return ($a < $b) ? -1 : 1;
        }
        $arr = ["a"=>4,"b"=>2,"c"=>8,"d"=>6];
        uksort($arr, "sorte");
        
        foreach ($arr as $x => $x_value){
            echo "key=" .$x. ", Value=" .$x_value;
            echo "<br />";
        }
         * 
         */
        
        function sor($f,$h){
            if($f == $h) return 0;
            return ($f < $h) ? -1 : 1;
        }
        $g = [4,2,8,6];
        usort($g, "sor");
        
        $luis = count($g);
        for($b = 0; $b < $luis; $b++){
            echo $g[$b];
            echo "<br />";
        }
        ?>
    </body>
</html>