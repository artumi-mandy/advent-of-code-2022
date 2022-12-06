<?php
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_3/input.txt");

// Loop until we reach the end of the file.
$alpahbet=range('a','z');
var_dump($alphabet);
die('asd');
while (!$file->eof()) {
    // Echo one line from the file.
	$line= $file->fgets();
	$lengthofstr=strlen(trim($line));
	$twoCompartments=str_split($trim($line),($lengthofstr/2));
	if(!$line)
	{
		$i++;
		$elves[$i]=0;
	}
}

$biggestCalories=0;
$secondBiggest=0;
$thirdBiggest=0;
$elf=1;
foreach($elves as $key =>$value)
{
	if($value>$biggestCalories)
	{
		$thirdBiggest=$secondBiggest;
		$secondBiggest=$biggestCalories;
		$biggestCalories=$value;
	
		$elf=$key;
	}
	elseif($value>$secondBiggest)
	{
		$thirdBiggest=$secondBiggest;
		$secondBiggest=$value;
	}
	elseif($value>$thirdBiggest)
	{
		$thirdBiggest=$value;
	}
}
var_dump($biggestCalories);
var_dump($secondBiggest);
var_dump($thirdBiggest);
var_dump($biggestCalories + $secondBiggest + $thirdBiggest);

