<?php
declare(strict_types=1);

//              funkcja callable
// function myCall($name, callable $func):void{
//     $func($name);
// }


// $myFunction = function($name){
//     echo $name;
// };

// myCall("michal",$myFunction);
//              funkcja callable


//      funkcje strzałkowe
// $a = fn($value) => $value*2;
// echo $a(2345);
$users=[
'a','b','c'
];

$hello = array_map(
    fn($value) => $value.' hej',
    $users
);
print_r ($hello);

foreach($users as $value){
    print_r ($value." hej\n");
}








?>