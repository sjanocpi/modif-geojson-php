<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>modify-geojson</title>
</head>
<body>

<?php
// $link = mysqli_connect("localhost", "root", "root", "cantons_lat_long");

// if (!$link) {
//     echo "Error: Unable to connect to MySQL." . PHP_EOL;
//     echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//     echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//     exit;
// }

// {"type":"Feature","geometry":{"type":"Point","coordinates":[-4.069228409253472,46.804646392890156]},"properties":{"nom":"Martinique","code":"972","bureau":"","dept":"","canton":""}},

// $f = file('departements-centre-metro_cea-trom.json');
$f = file('cantons_2015-2021-centres-metro-trom-lng-lat.json');
// $f = file_get_contents('cantons_2015-2021-centres-metro-trom-lng-lat.json');
// if(!function_exists('json_decode')) die('Your host does not support json');
// $feed = json_decode($f, true);
echo '<pre>';


echo count($f);
$data = [];

$newfile = '';
foreach ($f as $key => $value) {

  // [2] => "coordinates":[-4.069228409253472
  // [3] => 46.804646392890156]}
  print_r($value);
  $ligne0 = explode(',', $value);
  // $ligne0 = explode(':[', $value);
  // $ligne1 = explode(']},"properties"', $value);
  $ligne1 = explode('"coordinates":[', $ligne0[2]);
  $ligne2 = explode(']}', $ligne0[3]);
  // print_r(count($ligne0));
  print_r($ligne0);
  // echo "\n";
  // print_r($ligne1);
  // print_r($ligne2);
  foreach ($ligne0 as $k => $v) {
    if($k == 2) {
      $v = '"coordinates":['.$ligne2[0];
    } else if($k == 3) {
      $v = ''.$ligne1[1].']}';
    }

    if($key +1 < count($f)) {

      if($k+1 == count($ligne0)) {

        $newfile .= $v;
      } else {

        $newfile .= $v.",";
      }


    }else {
      $newfile .= $v;
    }
  }


}

$fp = fopen('fichiers/cantons_2015-2021-centres-metro-trom-lat-lng-test.json', 'w');
fwrite($fp, $newfile);
// echo $newfile;
// print_r($data);


?>

  </body>
</html>