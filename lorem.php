<?php


function writeToFile($fileName, $var){
    $myfile = fopen($fileName .".txt", "w") or die("Unable to open file!");
    fwrite($myfile, $var);
    fclose($myfile);
}




function generateCharacters($length) {
    $characters = '';
    $charPool = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charPoolLength = strlen($charPool);

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, $charPoolLength - 1);
        $characters .= $charPool[$index];
    }


    writeToFile('characters', $characters);


}


function generateWords($amount = 30, $start = 0) {
    $words =  simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=words&start=$start")->lipsum;
     writeToFile('words', $words);
}


function generateParagraphs($amount = 1, $what = 'paras', $start = 0) {
   $paragraphs =  simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    writeToFile('paragraphs', $paragraphs);
}


function call($obj) {
    if (isset($obj['characters'])) {
     return generateCharacters($obj['characters']);
    }   
      if (isset($obj['words'])) {
     return generateWords($obj['words']);
    } 
        if (isset($obj['paragraphs'])) {
     return generateParagraphs($obj['paragraphs']);
    } 
}


// sample 
$bag = array('characters' => 2);
call($bag);
