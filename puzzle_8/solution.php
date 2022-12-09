<?php
function getLines(){
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_8/input.txt");

	$aLines=[];
	while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line))
		{
			$aLines[]=str_split(trim($line));
		}
	}
	return $aLines;
}
function getTreesVisible($aLines){
$treeCount=0;
	for($line=0;$line<count($aLines);$line++)
	{
		if(($line==0) || ($line==(count($aLines)-1)))
		{
			$treeCount+=count($aLines[$line]);
		}
		else
		{
			$treeCount+=getCountForLine($aLines,$line);
		}
	}
	return $treeCount;
}
function getCountForLine($aLines,$lineNo)
{
	$treeCount=0;
	$aLineToCheck=$aLines[$lineNo];
	for($tree=0;$tree<count($aLineToCheck);$tree++)
	{
		if(($tree==0) || ($tree==(count($aLineToCheck)-1)))
		{
			$treeCount++;
		}
		else
		{
			if(treeVisibleHorizontally($aLines,$lineNo,$tree))
				$treeCount++;
			elseif(treeVisibleVertically($aLines,$lineNo,$tree))
				$treeCount++;
		}

	}
	return $treeCount;
}
function treeVisibleHorizontally($aLines,$lineNo,$tree)
{
	$treeHeight=$aLines[$lineNo][$tree];
	$aHorzontalLine=$aLines[$lineNo];
	$visibleFromLeft=true;
	$visibleFromRight=true;
	for($position=0;$position<$tree;$position++)
	{
		if($aHorzontalLine[$position]>=$treeHeight)
			$visibleFromLeft=false;
	}
	for($position=($tree+1);$position<count($aHorzontalLine);$position++)
	{
		if($aHorzontalLine[$position]>=$treeHeight)
			$visibleFromRight=false;
	}
	return( $visibleFromLeft || $visibleFromRight); 
}
function treeVisibleVertically($aLines,$lineNo,$tree)
{
	$treeHeight=$aLines[$lineNo][$tree];
	$visibleFromTop=true;
	$visibleFromBottom=true;
	for($position=0;$position<$lineNo;$position++)
	{
		if($aLines[$position][$tree]>=$treeHeight)
			$visibleFromTop=false;
	}	
	for($position=($lineNo+1);$position<count($aLines);$position++)
	{
		if($aLines[$position][$tree]>=$treeHeight)
			$visibleFromBottom=false;
	}	
	return( $visibleFromTop || $visibleFromBottom); 
}


//part 2
function getBiggestScenicValue($aLines){
	$biggestscenicValue=0;
	for($line=0;$line<count($aLines);$line++)
	{
		if(($line!=0) && ($line!=(count($aLines)-1)))
		{
			$biggestLineCount=getBiggestCountForLine($aLines,$line);
			if($biggestLineCount>$biggestscenicValue)
				$biggestscenicValue=$biggestLineCount;
		}
	}
	return $biggestscenicValue;
}
function getBiggestCountForLine($aLines,$lineNo)
{
	$biggestCount=0;
	$aLineToCheck=$aLines[$lineNo];
	for($tree=0;$tree<count($aLineToCheck);$tree++)
	{
		if(($tree!=0) && ($tree!=(count($aLineToCheck)-1)))
		{
			$horizontally=(int)scenicCountHorizontally($aLines,$lineNo,$tree);
			$vertically=(int) scenicCountVertically($aLines,$lineNo,$tree);
			$scenicCount=($vertically*$horizontally);
			if($scenicCount>$biggestCount)
				$biggestCount=$scenicCount;
		}

	}
	return $biggestCount;
}
function scenicCountHorizontally($aLines,$lineNo,$tree)
{
	$treeHeight=$aLines[$lineNo][$tree];
	$aHorzontalLine=$aLines[$lineNo];
	$scenicCountLeft=0;
	$scenicCountRight=0;
	for($position=($tree-1);$position>=0;$position--)
	{
		$scenicCountLeft++;
		if($aHorzontalLine[$position]>=$treeHeight)
			break;
	}
	for($position=($tree+1);$position<count($aHorzontalLine);$position++)
	{
		$scenicCountRight++;
		if($aHorzontalLine[$position]>=$treeHeight)
			break;
	}
	return($scenicCountLeft*$scenicCountRight); 
}
function scenicCountVertically($aLines,$lineNo,$tree)
{
	$treeHeight=$aLines[$lineNo][$tree];
	$scenicCountTop=0;
	$scenicCountBottom=0;
	for($position=($lineNo-1);$position>=0;$position--)
	{
		$scenicCountTop++;
		if($aLines[$position][$tree]>=$treeHeight)
			break;
	}	
	for($position=($lineNo+1);$position<count($aLines);$position++)
	{
		$scenicCountBottom++;
		if($aLines[$position][$tree]>=$treeHeight)
			break;
	}
	
	return( $scenicCountTop*$scenicCountBottom); 
}
$aLines=getLines();
$treeCount=getTreesVisible($aLines);
var_dump($treeCount);
$biggestScenicCount=getBiggestScenicValue($aLines);
var_dump($biggestScenicCount);







