<?php
$file = new SplFileObject("/home/mandy/advent_of_code/puzzle_7/input.txt");

class Folder
{
	public $parent,
		$name,
		$aDirs=[],
		$aFiles=[];
	

	public function __construct($parent,$name) 
	{
		$this->parent = $parent;
		$this->name=$name;
	}
	public function addDir($dir){
		$this->aDirs[]=$dir;
	}
	public function addFile($name,$storageValue)
	{
		$this->aFiles[$name]=$storageValue;
	}
	public function getDirs()
	{
		return $this->aDirs;
	}
	public function getFiles()
	{
		return $this->aFiles;
	}
	public function hasDir($nameToCheck)
	{
		foreach($this->getDirs() as $dir)
		{
			if(($dir->name==$nameToCheck))
			{
				return true;
			}
		}
		return false;
	}
	public function getDir($nameToCheck)
	{
		foreach($this->getDirs() as $dir)
		{
			if(($dir->name==$nameToCheck))
			{
				return $dir;
			}
		}
		return false;
	}
	public function hasFile($filename)
	{
		foreach($this->getFiles() as $name=>$value)
		{
			if(($filename==$name))
			{
				return true;	
			}
		}
		return false;
	}
	public function getAllChildren(){
		$aDirs=[];
		$aDirs[]=$this;
		$aChildren=[];
		foreach($this->getDirs() as $dir)
		{
			$aChildren=$dir->getAllChildren();
			if(count($aChildren))
				$aDirs=array_merge($aDirs,$aChildren);
		}
		return $aDirs;
	}

	public function getStorageCount(){
		$storageValue=0;
		$storage=[];
		$aDirStorage=[];
		foreach($this->getFiles() as $file=>$size)
		{
			$storageValue+=$size;
		}
		foreach($this->getDirs() as $dir)
		{
			$storageValue+=$dir->getStorageCount();
		}
		return $storageValue;
	}
}
global $rootFolder;
$rootFolder=new Folder(null, 'rootFolder');
$currentDir=$rootFolder;
while (!$file->eof()) {
		// Echo one line from the file.
		$line= $file->fgets();
		if(trim($line))
		{
			$commands=explode(' ',$line);
			if($commands[0]=='$')
			{
				if($commands[1]=='cd')
				{
					$currentDir=processCDCommand(trim($commands['2']),$currentDir);
				}
				
			}
			elseif($commands[0]=='dir')
			{
				addDirIfNone(trim($commands[1]), $currentDir);
			}	
			else{
				addFileIfNone($commands,$currentDir);
			}
				
		}

}
function processCDCommand($foldername,&$currentDir)
{
	global $rootFolder;
	if($foldername=='/')
		return $rootFolder;	
	if($foldername!='..'){
		return addDirIfNone($foldername,$currentDir, true);
	}
	else
	{
		return $currentDir->parent;
	}
	return $currentDir;

}
function addDirIfNone($foldername,&$currentDir, $moveTo=false)
{

	if(!$currentDir->hasDir($foldername))
	{
		$newFolder=new Folder($currentDir, $foldername);
		$currentDir->addDir($newFolder);
		if($moveTo)
		{
			return $newFolder;
		}

	}
	elseif($moveTo)
	{
		return $currentDir->getDir($foldername);
	}
	return $currentDir;
}
function addFileIfNone($commands,&$currentDir)
{
	$filename=trim($commands[1]);
	$storagevalue=$commands[0];
	if(!$currentDir->hasFile($filename))
	{
		$currentDir->addFile($filename,$storagevalue);
	}
}
function getTotalFoldersUnder100000($aAllFolders){
	$iTotal=0;
	foreach($aAllFolders as $folder)
	{
		$storageValue=$folder->getStorageCount();
		if($storageValue<100000)
		{
			$iTotal+=$storageValue;
		}
	}
	return $iTotal;
}
function getSmallestPossibleDir($rootFolder)
{
	$iLimit=40000000;
	$iUsedSpace=$rootFolder->getStorageCount();
	$iMinimumToRemove=$iUsedSpace-$iLimit;
	foreach($rootFolder->getAllChildren() as $folder)
	{
		$storageValue=$folder->getStorageCount();
		if( 
			($storageValue>$iMinimumToRemove)  &&
			(
				(!isset($currentLowest)) ||
				($storageValue<$currentLowest)
			)
		)
		{
			$currentLowest=$storageValue;
		}
	}
	if(isset($currentLowest))
		return $currentLowest;
	return false;
}
$aAllFolders=($rootFolder->getAllChildren());
$iTotal=getTotalFoldersUnder100000($aAllFolders);
var_dump($iTotal);
$iLowestValue=getSmallestPossibleDir($rootFolder);
var_dump($iLowestValue);



