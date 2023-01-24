<?php 
echo "<pre>"; 
echo "-------------------------------";
echo '<br>';
echo 'Environment : **'.$json['env'].'**';
echo '<br>';
echo "-------------------------------";
echo '<br>';
echo '<br>';
echo 'url : '.$json['url'];
echo '<br>';
echo 'method : '.$json['method'];
echo '<br>';
echo 'parameter : '.json_encode(json_decode($json['parameter']), JSON_PRETTY_PRINT);
echo '<br>';
echo 'status : '.$json['status'];
echo '<br>';
echo 'contentType : '.$json['contentType'];
echo '<br>';
echo "-------------------------------";
echo '<br>';
if(($json['status'] == 0) OR ($json['status'] == 404))
{
	echo 'result : '.$json['result'];
}else
{
	echo 'result :'.json_encode(json_decode($json['result']), JSON_PRETTY_PRINT);
}
 
echo "</pre>";


?>