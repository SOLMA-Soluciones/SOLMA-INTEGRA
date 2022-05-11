<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productionstop extends Model
{
    use HasFactory;

    protected $table = 'tcproductionstoppages';
    protected $fillable = ['id', 'name', 'status'];

    public static function getStoppageByLineId($id)
    {
        $aStoppages = DB::select("SELECT  A.id,A.name,IF(B.id IS NOT NULL,1,0) AS iEstatus FROM tcproductionstoppages A LEFT JOIN trproductionlinestoppages B  ON A.id = B.productionstoppage_id AND B.productionline_id = $id");
        return $aStoppages;
    }
    public static function getStoppageByOrderId($id){
        $aStoppages = DB::select("SELECT  A.id,A.name,IF(B.id IS NOT NULL,1,0) AS iEstatus 
        FROM tcproductionstoppages A 
        INNER JOIN trproductionlinestoppages B  ON A.id = B.productionstoppage_id 
        INNER JOIN tdproductionorder C ON B.productionline_id=C.productionline_id AND C.id = $id;");
        return $aStoppages;
    }
    public static function updateStoppageLine($data)
    {
        try {
            if ($data->status == 0) {
                try {
                    DB::select("DELETE FROM trproductionlinestoppages where productionline_id = $data->productionline_id AND productionstoppage_id = $data->id");
                } catch (Exception $ex) {
                    throw $ex;
                }
            } else {
                $ids = DB::select("SELECT id FROM trproductionlinestoppages WHERE productionline_id = $data->productionline_id and productionstoppage_id = $data->id");
                if (count($ids) == 0) {
                    DB::insert('insert into trproductionlinestoppages (productionline_id,productionstoppage_id ) values (?, ?)', [$data->productionline_id, $data->id]);
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
