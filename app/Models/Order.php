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
    protected $fillable = ["id", "productionorderstatus_id", "product_id", "start_time", "scrap", "total", "productionline_id", "schedule_id","total_produced"];



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
        $orders = DB::select("SELECT A.id,E.name AS status_name,A.product_id,A.total,A.productionline_id,A.schedule_id,B.name AS name_line,C.turn,D.part_number,D.cost,D.cycle,D.unit,DATE_FORMAT(SEC_TO_TIME((A.total/D.cycle)*60*60),'%H:%i:%S') AS timeplanified
        FROM tdproductionorder A 
        INNER JOIN tcproductionline B ON A.productionline_id = B.id
        INNER JOIN  tdschedules C ON A.schedule_id = C.id
        INNER JOIN  tcproducts D ON A.product_id = D.id
        INNER JOIN tcproductionorderstatus E ON A.productionorderstatus_id = E.id");
        return $orders;
    }
    public static function getOrdersInProcess()
    {
        $orders = DB::select("SELECT A.id,E.name AS status_name,A.product_id,A.total,A.productionline_id,A.schedule_id,B.name AS name_line,C.turn,D.part_number,D.cost,D.cycle,D.unit,DATE_FORMAT(SEC_TO_TIME((A.total/D.cycle)*60*60),'%H:%i:%S') AS timeplanified
        FROM tdproductionorder A 
        INNER JOIN tcproductionline B ON A.productionline_id = B.id
        INNER JOIN  tdschedules C ON A.schedule_id = C.id
        INNER JOIN  tcproducts D ON A.product_id = D.id
        INNER JOIN tcproductionorderstatus E ON A.productionorderstatus_id = E.id where productionorderstatus_id=2");
        return $orders;
    }

    public static function getOrderById($id)
    {
        $orders = DB::select("SELECT A.id,A.product_id,A.total,A.productionorderstatus_id,A.start_time,A.end_time,A.productionline_id,A.schedule_id,B.name AS name_line,C.turn,D.part_number,D.cost,D.cycle,D.unit,DATE_FORMAT(SEC_TO_TIME((A.total/D.cycle)*60*60),'%H:%i:%S') AS timeplanified,
        A.scrap,A.total_produced FROM tdproductionorder A 
        INNER JOIN tcproductionline B ON A.productionline_id = B.id
        INNER JOIN  tdschedules C ON A.schedule_id = C.id
        INNER JOIN  tcproducts D ON A.product_id = D.id WHERE A.id = $id;");
        return $orders;
    }

    public static function getStoppagesExecuted($idOrder){
        $orders = DB::select("SELECT A.id,A.productionorder_id,A.productionstoppage_id,A.start_time,A.end_time,A.status,A.created_at,A.updated_at,B.name AS name_stoppage 
        FROM tdproductionlinestoppages A
        INNER JOIN tcproductionstoppages  B ON A.productionstoppage_id = B.id
        WHERE productionorder_id = $idOrder ORDER BY end_time desc");
        return $orders;
    }

    public static function startStoppage($data){
        try {
           $result = DB::insert('insert into tdproductionlinestoppages (productionorder_id,productionstoppage_id,start_time,status ) values (?,?,?,?)', [$data->productionorder_id, $data->productionstoppage_id,$data->start_time,$data->status]);
           return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public static function stopStoppage($data){
        try {
           $result = DB::update('update tdproductionlinestoppages set end_time=?,status=?  where productionorder_id=? and productionstoppage_id=? and status=1', [$data->end_time,$data->status,$data->productionorder_id, $data->productionstoppage_id]);
           return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public static function endStoppage($data){
        
    }
    public static function startOrder($data){
        
    }
    public static function endOrder($data){
        
    }
}
