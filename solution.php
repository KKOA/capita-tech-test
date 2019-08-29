<?php
/**
 * Created by : PhpStorm.
 * User : keith
 * Date : 27/08/2019
 */
declare(strict_types=1);

/**
 * Description the word trying to find
 * @const string WORD_TO_FIND
 */
const WORD_TO_FIND = 'York';

//Store array of files
$files = [];

// Set to 1 to enable debugMode message
$debugMode = 0;

echo"<pre>";

/**
 * Check file match given extension
 * @param string $path
 * @return bool
 */
function isTxtFile(string $path) :bool
{
	$parts= explode('\\',$path);
	$filename = $parts[count($parts)-1];
//	return (bool)preg_match("/.*txt$/",$filename);
	return (bool)preg_match("/.*\.txt$/",$filename);
}

/**
 * Description recursively look for all files in root folder and it's children
 * @param int $debugMode
 * @param String $dir
 * @param array $results
 * @return array
 */
function getDirContents(int $debugMode, String $dir, Array &$results = []) :array
{
	$files = scandir($dir);
	if($debugMode) {
		print_r($files);
		echo "<hr>";
	}

	foreach($files as $key => $value) {
		$path = realpath($dir.DIRECTORY_SEPARATOR.$value);

		if(!is_dir($path)){
			// check if file has .txt extension
			if(isTxtFile($path))
			{
				$results[$path] = 0;
			}

		} else if($value != "." && $value != "..") {
			getDirContents($debugMode,$path, $results);
			//$results[] = $path;
		}
	}

	return $results;
}
if($debugMode) {
	echo "List all txt files<hr>";
}
$files = getDirContents($debugMode,getcwd() . "\\folder");

if($debugMode)
{
	print_r($files);
	echo "<hr>";
	echo "Get word count<hr>";
}

foreach($files as $filename => $value)
{
	//open file in read mode
	$handle = fopen($filename,"r");

	while (($line = fgets($handle)) !== false)
	{
		if($debugMode)
		{
			echo $line."<br>";
		}

		// Ignore current interaction if line character length is than word that we are looking for
		if(strlen($line) < strlen(WORD_TO_FIND))
		{
			continue;
		}

		//Check if word exist in the line
		if(strpos($line,WORD_TO_FIND) !== false)
		{
			// Count the number of word occurrences within the string
			$occurrence = substr_count($line,WORD_TO_FIND);
			// Update count
			$files[$filename] = $files[$filename] + $occurrence;
		}
	}

	//close file
	fclose($handle);
}
if($debugMode) {
	print_r($files);
	echo"<hr>";
}

echo "Files contain the word '".WORD_TO_FIND."' with count of occurrences <hr>";
//filter with count greater than 0
print_r(array_filter($files, function($value){
	return $value > 0;
}
));

echo '</pre>';