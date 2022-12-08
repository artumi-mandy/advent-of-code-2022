<?php
	$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_6/input.txt");


	$numberOfDuplicates=0;
	while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line))
		{
			$uniquePosition=checkForUnique($line, 4);
			var_dump($uniquePosition);
			$uniquePosition=checkForUnique($line,14);
			var_dump($uniquePosition);
		}

	}
	function checkForUnique($line, $tocheck)
	{
		$linelength=strlen($line);
		for($i=($tocheck-1);$i<$linelength;$i++)
		{
			$allValues=[];
			for($char=0;$char<$tocheck;$char++)
			{
				$allValues[]=$line[$i-$char];
			}
			$uniqueValues=array_unique($allValues);
			if(count($uniqueValues)==$tocheck)
				return $i+1;
		}	
	}

