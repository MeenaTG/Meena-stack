<?php 

include_once('simple_html_dom.php');

$servername = 'localhost';
$db_username = 'root';
$db_password = '';
$database = "meena_stack";
$conn = new mysqli($servername,$db_username,$db_password,$database);

$lowercase = true;
$forceTagsClosed = true;
$target_charset = DEFAULT_TARGET_CHARSET;
$stripRN = true;
$defaultBRText = DEFAULT_BR_TEXT;
$defaultSpanText = DEFAULT_SPAN_TEXT;

$dom = new simple_html_dom(
    null,
    $lowercase,
    $forceTagsClosed,
    $target_charset,
    $stripRN,
    $defaultBRText,
    $defaultSpanText
  );


function getHTML($url) {
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

try {

	$tagUrl = 'https://stackoverflow.com/tags';

	$contents = getHTML($tagUrl);	

	/*$fileHTML = $folderPath.'homePage/home';

	if(file_exists($fileHTML.'.html')){

		unlink($fileHTML.'.html');	
	}*/

	file_put_contents('stacktags.html', $contents);


	$dataURLArr = array();

	$html = $dom->load($contents, $lowercase, $stripRN);

	$tagsdone = 0;
	foreach ($html->find('div.s-card') as $key => $value) {
		if($tagsdone > 1){
			break;
		} else {
			if($value->find('.post-tag',0)){
				$tagname = $tagnametemp = $value->find('.post-tag',0)->plaintext;
				$ques_text = $value->find('.mt-auto',0)->find('.grid--cell',0)->plaintext;
				$question = explode(' ', $ques_text)[0];
				if($tagname != ''){
					$tagname = strtolower($tagname);
					$no_of_question = $question;
					$updated_at = date('Y-m-d H:i:s');
					$res = $conn->query("SELECT * FROM stacktags WHERE tagname='$tagname' LIMIT 1");
					if($res->num_rows > 0){
						$queryy = "UPDATE `stacktags` SET `tagname`='$tagname',`no_of_question`=$no_of_question,`updated_at`='$updated_at' WHERE `tagname` = '$tagname'";
					} else {
						$created_at = date('Y-m-d H:i:s');
						$queryy = "INSERT INTO `stacktags` ( `tagname`, `no_of_question`, `created_at`, `updated_at`) VALUES ( '$tagname', $no_of_question, '$created_at', '$updated_at') ";
					}	
					if($conn->query($queryy) === TRUE){
						$tagsdone += 1;	

						$taggedUrl = 'https://stackoverflow.com/questions/tagged/'.urlencode($tagnametemp).'?tab=Unanswered';
						$tagcontents = '';
						$tagcontents = getHTML($taggedUrl);	
						$filename = str_replace(' ', '', $tagnametemp); // Replaces all spaces with hyphens.
						$filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
						file_put_contents('stack-'.$filename.'.html', $tagcontents);


						// echo $tagcontents;;
						if(!is_null($tagcontents)){
							$var = $dom.$tagname;
							$$var = new simple_html_dom(
							    null,
							    $lowercase,
							    $forceTagsClosed,
							    $target_charset,
							    $stripRN,
							    $defaultBRText,
							    $defaultSpanText
							  );

							$taggedhtml = $$var->load($tagcontents, $lowercase, $stripRN);

							if($taggedhtml->find('.fs-body3')){
								$str = $taggedhtml->find('.fs-body3',0)->plaintext;
								$str = trim($str);
								$text = explode(' ',$str)[0];
								$unanswered_question = str_replace(',', '', $text);
								$queryy = "UPDATE `stacktags` SET `unanswered_question`=$unanswered_question WHERE `tagname` = '$tagname'";
								$conn->query($queryy);
								// exit();
							}
						}

						$taggedUrl1 = 'https://stackoverflow.com/questions/tagged/'.urlencode($tagnametemp).'?tab=Frequent';
						$tagcontents1 = '';
						$tagcontents1 = getHTML($taggedUrl1);	
						if(!is_null($tagcontents1)){
							$filename = str_replace(' ', '', $tagnametemp); // Replaces all spaces with hyphens.
							$filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename);
							file_put_contents('stackfre-'.$filename.'.html', $tagcontents1);
							$var1 = $dom.$tagname.'una';
							$$var1 = new simple_html_dom(
							    null,
							    $lowercase,
							    $forceTagsClosed,
							    $target_charset,
							    $stripRN,
							    $defaultBRText,
							    $defaultSpanText
							  );

							// echo $tagcontents1;;
							$taggedhtml1 = $$var1->load($tagcontents1, $lowercase, $stripRN);
							
							

							if($taggedhtml1->find('.fs-body3')){
								$str = $taggedhtml1->find('.fs-body3',0)->plaintext;
								$str = trim($str);
								$text = explode(' ',$str)[0];
								$frequent_question = str_replace(',', '', $text);
								$queryy = "UPDATE `stacktags` SET `frequent_question`=$frequent_question WHERE `tagname` = '$tagname'";
								$conn->query($queryy);
								// exit();
							}
						}
					}
						
				}
			}
		}
	}

	echo 'Scrap done';exit();

}
//catch exception
catch(Throwable $e) {

  echo 'Message: ' .$e->getMessage();
  exit;
}
 header('Location: ' . $_SERVER['HTTP_REFERER']);


?>