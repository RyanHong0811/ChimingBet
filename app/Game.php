<?php 
namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Game extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 'games';
    protected $primaryKey = '_id';

    //要存進資料庫前 自動轉成date格式
    protected $dates = [];
}
