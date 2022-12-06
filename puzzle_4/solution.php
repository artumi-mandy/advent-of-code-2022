<?php

// Loop until we reach the end of the file.

function part1(){

	$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_4/input.txt");


	$numberOfDuplicates=0;
	while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line))
		{
			$pairs=explode(',',trim($line));
			$firstPair=explode('-',$pairs[0]);
			$secondPair=explode('-',$pairs[1]);
			if(
				($firstPair[0]<=$secondPair[0]) &&
				($firstPair[1]>=$secondPair[1])
			)
			{
				$numberOfDuplicates++;
			}
			elseif(
				($secondPair[0]<=$firstPair[0]) &&
				($secondPair[1]>=$firstPair[1])
			)
			{
				$numberOfDuplicates++;
			}
		}
	}
	var_dump($numberOfDuplicates);
}

function part2()
{

	$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_4/input.txt");
	$numberOfDuplicates=0;
	while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line))
		{
			$pairs=explode(',',trim($line));
			$firstPair=explode('-',$pairs[0]);
			$secondPair=explode('-',$pairs[1]);
			if(

				(
					($firstPair[0]>=$secondPair[0]) &&
					($firstPair[0]<=$secondPair[1])
				)
				||
				(
					($firstPair[1]<=$secondPair[1]) &&
					($firstPair[1]>=$secondPair[0])
				)

			)
			{
				$numberOfDuplicates++;
			}
			elseif(
				(
					($secondPair[0]<=$firstPair[0]) && 
					($secondPair[0]>=$firstPair[1])
				)
				||
				(
					($secondPair[1]<=$firstPair[1]) &&
					($secondPair[1]>=$firstPair[0])
				)

			)
			{
				$numberOfDuplicates++;
			}
		}

	}
	var_dump($numberOfDuplicates);
}
part2();





