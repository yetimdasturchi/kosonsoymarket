<?
if ($_GET['method']=='image') {
	header("Content-type: image/png");
}else{
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
}
$api_key = "sizningtokeningiz";
$api_server = "http://kosonsoymarket.uz/api/".$api_key."/";
$method = $_GET['method'].'?';
$queries = array();
foreach ($_GET as $key => $value) {
	if ($key != 'method') {
		$queries[$key] = $value;
	}
}
$data = file_get_contents($api_server.$method.http_build_query($queries));
echo $data;
?>