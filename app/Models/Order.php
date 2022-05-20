<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = 'tdproductionorder';
    protected $fillable = ["id", "productionorderstatus_id", "product_id", "start_time", "scrap", "total", "productionline_id", "schedule_id"];



    public static function getLinesWithProductsAndTurns()
    {
        $lines = DB::select('SELECT A.id,A.name FROM tcproductionline A
        INNER JOIN tcproducts B ON A.id = B.productionline_id
        INNER JOIN tdschedules C ON A.id = C.productionline_id GROUP BY A.id ORDER BY A.name');

        return $lines;
    }

    public static function getTurnsByLineId($id)
    {


        $turns = DB::select("SELECT C.id,C.turn FROM tcproductionline A
        INNER JOIN tcproducts B ON A.id = B.productionline_id
        INNER JOIN tdschedules C ON A.id = C.productionline_id WHERE A.id = $id GROUP BY C.turn ORDER BY A.name");

        return $turns;
    }

    public static function getProductsByLineId($id)
    {


        $turns = DB::select("SELECT B.id,B.part_number,B.description,B.cost,B.cycle,B.unit FROM tcproductionline A
        INNER JOIN tcproducts B ON A.id = B.productionline_id
        INNER JOIN tdschedules C ON A.id = C.productionline_id WHERE A.id = $id GROUP BY B.id  ORDER BY A.name");

        return $turns;
    }
    public static function getOrders()
    {
        $orders = DB::select("SELECT A.id,A.product_id,A.total,A.productionline_id,A.schedule_id,B.name AS name_line,C.turn,D.part_number,D.cost,D.cycle,D.unit,DATE_FORMAT(SEC_TO_TIME((A.total/D.cycle)*60*60),'%H:%i:%S') AS timeplanified
        FROM tdproductionorder A 
        INNER JOIN tcproductionline B ON A.productionline_id = B.id
        INNER JOIN  tdschedules C ON A.schedule_id = C.id
        INNER JOIN  tcproducts D ON A.product_id = D.id;");
        return $orders;
    }

    public static function getOrderById($id)
    {
        $orders = DB::select("SELECT A.id,A.product_id,A.total,A.productionline_id,A.schedule_id,B.name AS name_line,C.turn,D.part_number,D.cost,D.cycle,D.unit,DATE_FORMAT(SEC_TO_TIME((A.total/D.cycle)*60*60),'%H:%i:%S') AS timeplanified
        FROM tdproductionorder A 
        INNER JOIN tcproductionline B ON A.productionline_id = B.id
        INNER JOIN  tdschedules C ON A.schedule_id = C.id
        INNER JOIN  tcproducts D ON A.product_id = D.id WHERE A.id = $id;");
        return $orders;
    }

    public static function getStoppagesExecuted($data){
        
    }

    public static function startStoppage($data){
        
    }
    public static function endStoppage($data){
        
    }
    public static function startOrder($data){
        
    }
    public static function endOrder($data){
        
    }
}
