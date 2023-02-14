<?php 
require "./vendor/autoload.php";


// try {
//     $redis = new Predis\Client();
//     echo $redis->get('name');
//     // echo $redis->del('name-1');
    
// } catch (\Throwable $th) {
//     echo $th->getMassage();
//     die;
// }

//=====================================
//=====================================

function cache($key,$minute,$value){
    $redis = new Predis\Client();
    if (!is_null($redis->get($key))) {     // $redis->exists($key)
        return unserialize($redis->get($key));
    }

    $redis->setex($key,60*$minute,serialize($value));
    return $value;
}


$data = [
    'article 1'=>[
       'title'=>'article 1',
       'desc' => 'descriptions 1'
    ],
    'article 2'=>[
       'title'=>'article 2',
       'desc' => 'descriptions 2'
    ]
];

$value = cache('articles',60,$data);
var_dump($value);
die();



?>
