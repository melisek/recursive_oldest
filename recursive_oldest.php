<?php

	function recursive_oldest($path = ".", $extension = "php")
	{
		// path végére záró \ ha nem lenne
		if (substr($path, -1) != "\\") $path .= "\\";
		
		// rekurzív és regex iterátorok az $extension kiterjesztésű fájlok keresésére 
		$dirItr = new RecursiveDirectoryIterator($path);
		$itr = new RecursiveIteratorIterator($dirItr);
		$regItr = new RegexIterator($itr, "/^.+\.({$extension})$/i",  RegexIterator::MATCH);
		
		// jelenlegi timestamp a minimumkereséshez 
		$oldest = time();
		$oldestName = "";
		
		foreach ($regItr as $fileinfo)
		{
			// ha régebben módosították, akkor felülírjuk (egyenlőség esetén az utolsó fájl lesz kiválasztva)
			if ($fileinfo->getMTime() <= $oldest)
			{
				$oldest = $fileinfo->getMTime();
				$oldestName = "{$fileinfo}";
			}
		}
		
		// kiválasztott fájl vizsgálata
		$spl = new SplFileInfo($oldestName);
		
		if (!$spl->isFile()) // létezik a fájl?
		{
			throw new NoSuchFileException($extension);
		}
		else if (!$spl->isReadable()) // olvasható?
		{
			throw new NotReadableFileException($oldestName);
		}

		// $path-hoz relatív elérési úttal tér vissza
		return ".\\".substr($oldestName,strlen($path));
		
	} // end recursive_oldest()
	
	
	try
	{
		$path = '.\css';
		$extension = 'css';
		
		echo "Legrégebben módosított .{$extension} fájl a(z) {$path} könyvtárban és alkönytáraiban: ". recursive_oldest($path, $extension);
	}
	// könyvtár nem létezik
	catch (UnexpectedValueException $e)
	{
		echo $e->getMessage();
	}
	// nincs ilyen kiterjesztésű fájl a könyvtárakban
	catch (NoSuchFileException $e)
	{
		echo $e->errorMessage();
	}
	// nem olvasható a kiválasztott fájl
	catch (NotReadableFileException $e)
	{
		echo $e->errorMessage();
	}
	
/* kivételkezelő osztályok */	
class NoSuchFileException extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = 'Nem található <strong>'.$this->getMessage().'</strong> kiterjesztésű fájl a könyvtárban.';
    return $errorMsg;
  }
}

class NotReadableFileException extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = 'Nem olvasható a(z) <strong>'.$this->getMessage().'</strong> fájl.';
    return $errorMsg;
  }
}

?>