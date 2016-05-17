<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/7/16
 * Time: 10:52 AM
 */
namespace App\Components;

use Carbon\Carbon;

class ExcelExport
{
    static function export($data)
    {
        \Excel::create(Carbon::createFromDate(),function($excel) use($data){

            $excel->sheet('今日订单',function($sheet) use($data){
                $sheet->setAutoSize(true);
                for($i=1;$i<=count($data);$i++){
                    $sheet->row(ceil($i/3),array($data[$i-1]->dish->dish_name.' '.$data[$i-1]->order_no.'*'.$data[$i-1]->dish->dish_price."\r\n".$data[$i-1]->user->name."\r\n".$data[$i-1]->user->phone."\r\n".$data[$i-1]->dormitory->floor->building->building_name."-".$data[$i-1]->dormitory->floor->floor_name."-".$data[$i-1]->dormitory->name,
                        $data[$i]->dish->dish_name.' '.$data[$i]->order_no.'*'.$data[$i]->dish->dish_price."\r\n".$data[$i]->user->name."\r\n".$data[$i]->user->phone."\r\n".$data[$i]->dormitory->floor->building->building_name."-".$data[$i]->dormitory->floor->floor_name."-".$data[$i]->dormitory->name,
                        $data[$i+1]->dish->dish_name.' '.$data[$i+1]->order_no.'*'.$data[$i+1]->dish->dish_price."\r\n".$data[$i+1]->user->name."\r\n".$data[$i+1]->user->phone."\r\n".$data[$i+1]->dormitory->floor->building->building_name."-".$data[$i+1]->dormitory->floor->floor_name."-".$data[$i+1]->dormitory->name));
                    $sheet->setHeight(ceil($i/3),60);
                    $sheet->cells('A'.ceil($i/3),function($cells){
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                    $sheet->cell('B'.ceil($i/3),function($cell){
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C'.ceil($i/3),function($cell){
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $i = $i+2;
                }
                $sheet->setWidth(array(
                    'A'=>29,
                    'B'=>29,
                    'C'=>29
                ));

//                $sheet->setSize('A2', 500, 50);
                $sheet->setWidth('A', 30);

                $sheet->setPageMargin(0.25);
            });
        })->export('xlsx');
    }
}
