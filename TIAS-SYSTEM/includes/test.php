<?php



$numbers = array(4, 6, 2, 22, 11);
sort($numbers);

$arrlength = count($numbers);
for($x = 0; $x <  $arrlength; $x++) {
     echo $numbers[$x];
     echo "<br>";
}
function setHeight($h=50) {

echo "Default : $h";




}

setHeight();

function familyname($fname, $year)

 {


echo "$fname Gulle. Born in : $year<br>";


}

familyname("Jelord","1996");
	



function write(){

echo "hello";


}

write();


$color = array("red","Green", "blue");

foreach ($color as $value) {

echo "$value<br>";

}



for ($x=0;$x <=10;$x++){

		echo "me $x";


}

$jj=2;

while ($jj <=5) {

echo "the number is : $jj";

$jj++;

}

$time= date("H");

if($time > 20) {

echo "hello";

}
else if($time == 50) {

	echo "t";


} else {



	echo "not";

}

$x=20;

$y=30;



function test(){

 	


$GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];





}

test();
echo "<br><p>$y</p></br>";

echo strlen("Hello jelord");

echo strrev("hi");

echo strpos("hi toxx", "toxx");


echo str_replace("Hi", "jelord", "rey");



define ("me", "hi", true);

echo me;

$favcolor = "blue";

switch ($favcolor) {
    case "red":
        echo "Your favorite color is red!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";


}
?>