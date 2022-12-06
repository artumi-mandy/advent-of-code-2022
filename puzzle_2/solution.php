<?php
$games=[];
$i=1;
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_2/input.txt");

// Loop until we reach the end of the file.
while (!$file->eof()) {
    // Echo one line from the file.
	$line=$file->fgets();
	$games[$i]=explode(' ',$line);
;
	$i++;
}
$scores_values=[
	'X'=>1,
	'Y'=>2,
	'Z'=>3,
];
$scenario1=['A'=>[
	'X'=>4 ,
	'Y'=> 8,
	'Z'=> 3,
],
'B'=>[
	'X'=> 1,
	'Y'=> 5,
	'Z'=> 9,
],
'C'=>[
	'X' =>7,
	'Y' =>2,
	'Z'=>6,
]
];
function getTotalScore($scenarios,$games){
	$totalScore=0;

	foreach($games as $game=>$results)
	{
		if(isset($results[1]))
		{
			$firstPlayer=$results[0];
			$secondPlayer=trim($results[1]);
			var_dump($firstPlayer);
			var_dump($secondPlayer);
			if($firstPlayer  && $secondPlayer)
				$totalScore+= $scenarios[$firstPlayer][$secondPlayer];
		}
	}
	return $totalScore;
}
$totalScore1=getTotalScore($scenario1, $games);
var_dump($totalScore1);

//part 2

$scenario2=['A'=>[
	'X'=>3,
	'Y'=> 4,
	'Z'=> 8,
],
'B'=>[
	'X'=> 1,
	'Y'=> 5,
	'Z'=> 9,
],
'C'=>[
	'X' =>2,
	'Y' =>6,
	'Z'=>7,
]
];
$totalScore2=getTotalScore($scenario2, $games);
var_dump($totalScore2);
