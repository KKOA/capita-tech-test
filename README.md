## PHP Task test

## Test Requirements
Design and code a process to search through a folder and sub folder 
to find a file containing the word "York". 

The program should list each of files in which the word exists and 
against each the count of the count of occurrences of the word.


## Assumptions
Below are list of my assumptions for the tech challenge

- The output of the file should be an associative array. Each key file name and the absolute path to the file .E.g. "C:\capita-tech-test\folder\file1.txt". The value represents the count of occurrences of the word.
- Search for the word will be case sensitive meaning words that the same word in the wrong case will not affect the count of occurrences of the word. 

## Minimum Requirements
- PHP version 7.2 or later


## How to run the application
After copying the Tech test folder, open your terminal/command prompt.
Navigate to where you have installed the files.
```
cd 'capita-tech-test'
php solution.php
```

## Future enhancements

- Allow the user specific the word to search for
- Allow the user specific the root directory to search in