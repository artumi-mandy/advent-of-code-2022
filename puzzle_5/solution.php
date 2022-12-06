<?php

function getOriginalPositions(){
	$column_set_up=[];
	$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_5/initial_positions.txt");

	$lines=[];
	while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line)){
			$lines[]=$line;
			$length=strlen($line);
		}
	}
	$count=(count($lines));
	for($offset=1;$offset<$length;$offset+=4)
	{
		for($i=($count-1);$i>=0; $i--)
		{
			if($i==($count-1))
			{
				$key=$lines[$i][$offset];
				$column_set_up[$key]=[];
			}
			else
			{
				if(isset($lines[$i][$offset]) && trim($lines[$i][$offset]))
					$column_set_up[$key][]=$lines[$i][$offset];
			}
		}
	}
	return $column_set_up;

}
$aOriginalPositions=(getOriginalPositions());
function getNewPositions($aOriginalPositions, $biggerCrane=false){
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_5/input.txt");

	$lines=[];
	while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line)){
			$instructions=getInstructions($line);
			if($biggerCrane)
			{
				$aOriginalPositions=getNewPositionBiggerCrane($instructions,$aOriginalPositions);
			}
			else
			{	
				$aOriginalPositions=getNewPosition($instructions,$aOriginalPositions);
			}
		}
	}
	return $aOriginalPositions;
}
function getInstructions($line){
	$lines=explode(' ',$line);
	$instructions=[];
	$instructions['move_no']=(int) $lines[1];
	$instructions['from_row']=(int) $lines[3];
	$instructions['to_row']= (int) $lines[5];
	return $instructions;
}

function getNewPosition($instructions,$aOriginalPositions){

	for($i=1;$i<=$instructions['move_no'];$i++)
	{
		$tomove=array_pop($aOriginalPositions[$instructions['from_row']]);
		if(!isset($aOriginalPositions[$instructions['to_row']]))
			$aOriginalPositions[$instructions['to_row']]=[];
		array_push($aOriginalPositions[$instructions['to_row']],$tomove);
	}
	return $aOriginalPositions;
}

function getNewPositionBiggerCrane($instructions,$aOriginalPositions){
	$position=0-$instructions['move_no'];
	$tomove=array_splice($aOriginalPositions[$instructions['from_row']],$position);
	if(!isset($aOriginalPositions[$instructions['to_row']]))
		$aOriginalPositions[$instructions['to_row']]=[];
	$aOriginalPositions[$instructions['to_row']]=array_merge($aOriginalPositions[$instructions['to_row']],$tomove);
	return $aOriginalPositions;
}
function getTopsofStack($aNewPostions)
{
	$aNewPosTop='';
	for($i=1;$i<=count($aNewPostions);$i++)
	{
		$aNewPosTop.=array_pop($aNewPostions[$i]);
	}
	var_dump($aNewPosTop);
}

//$aNewPostions=getNewPositions($aOriginalPositions);
//getTopsofStack($aNewPostions);
$aNewPostions=getNewPositions($aOriginalPositions, true);
var_dump($aNewPostions);
getTopsofStack($aNewPostions);




