<?php
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_3/input_test.txt");

// Loop until we reach the end of the file.
$alphabet=array_flip(range('a','z'));


$totalPriority=0;
while (!$file->eof()) {
    // Echo one line from the file.
	$line= $file->fgets();
	$lengthofstr=strlen(trim($line));
	if(trim($line))
	{
		$twoCompartments=str_split(trim($line),($lengthofstr/2));
		$secondCompartment=$twoCompartments[1];
		$firstCompartment=str_split($twoCompartments[0],1);
		foreach($firstCompartment as $key=>$letter)
		{
			if(strpos($secondCompartment,$letter)!==false)
			{
				if(!ctype_lower($letter))
				{
					$totalPriority+=26;
				}	
				$totalPriority+=1;
				$totalPriority+=(int) $alphabet[strtolower($letter)];
				break;

			}
				
		}
	}
}
var_dump($totalPriority);
$threeBags=[];
$i=1;
$totalPriority=0;
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_3/input.txt");

while (!$file->eof()) {
    // Echo one line from the file.
	$line= $file->fgets();
	$lengthofstr=strlen(trim($line));
	if(trim($line))
	{
		var_dump(trim($line));
		$threeBags[$i]=trim($line);
		if($i==3)
		{
			$firstBag=array_unique(str_split($threeBags[1],1));
			var_dump($firstBag);
			
			foreach($firstBag as $key=>$letter)
			{
				if(
					(strpos($threeBags[2],$letter)!==false) &&
					(strpos($threeBags[3],$letter)!==false)
				)
				{
					if(!ctype_lower($letter))
					{
						$totalPriority+=26;
					}	
					$totalPriority+=1;
					$totalPriority+=(int) $alphabet[strtolower($letter)];
					break;

				}

			}
			$threeBags=[];
			$i=1;

		}
		else
		{
			$i++;
		}

	}
}
var_dump($totalPriority);




