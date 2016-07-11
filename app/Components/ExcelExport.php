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
    static function exportDetail($data)
    {
        \Excel::create(Carbon::createFromDate(), function ($excel) use ($data) {

            $excel->sheet('今日订单', function ($sheet) use ($data) {
                $sheet->setAutoSize(true);
                for ($i = 1; $i <= count($data); $i ++) {
                    $sheet->row(ceil($i / 3), array($data[ $i - 1 ]->dish->dish_name . ' ' . $data[ $i - 1 ]->order_no . '*' . $data[ $i - 1 ]->dish->dish_price . "\r\n" . $data[ $i - 1 ]->user->name . "\r\n" . $data[ $i - 1 ]->user->phone . "\r\n" . $data[ $i - 1 ]->dormitory->floor->building->building_name . "-" . $data[ $i - 1 ]->dormitory->floor->floor_name . "-" . $data[ $i - 1 ]->dormitory->name,
                        $data[ $i ]->dish->dish_name . ' ' . $data[ $i ]->order_no . '*' . $data[ $i ]->dish->dish_price . "\r\n" . $data[ $i ]->user->name . "\r\n" . $data[ $i ]->user->phone . "\r\n" . $data[ $i ]->dormitory->floor->building->building_name . "-" . $data[ $i ]->dormitory->floor->floor_name . "-" . $data[ $i ]->dormitory->name,
                        $data[ $i + 1 ]->dish->dish_name . ' ' . $data[ $i + 1 ]->order_no . '*' . $data[ $i + 1 ]->dish->dish_price . "\r\n" . $data[ $i + 1 ]->user->name . "\r\n" . $data[ $i + 1 ]->user->phone . "\r\n" . $data[ $i + 1 ]->dormitory->floor->building->building_name . "-" . $data[ $i + 1 ]->dormitory->floor->floor_name . "-" . $data[ $i + 1 ]->dormitory->name));
                    $sheet->setHeight(ceil($i / 3), 60);
                    $sheet->cells('A' . ceil($i / 3), function ($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                    $sheet->cell('B' . ceil($i / 3), function ($cell) {
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C' . ceil($i / 3), function ($cell) {
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $i = $i + 2;
                }
                $sheet->setWidth(array(
                    'A' => 29,
                    'B' => 29,
                    'C' => 29
                ));

                $sheet->setWidth('A', 30);

                $sheet->setPageMargin(0.25);
            });
        })->export('xlsx');
    }

    static public function exportWindowDetail($datas)
    {
        \Excel::create('窗口明细表', function ($excel) use ($datas) {

            $excel->sheet('窗口明细表', function ($sheet) use ($datas) {

                $sheet->loadView('excels.windowDetail', compact('datas'));

            });

        })->export('xlsx');
    }

    static public function exportTags($datas)
    {
        \Excel::create('标签', function ($excel) use ($datas) {
            $arr = [];
            foreach ($datas as $k => $data) {
                $arr[ $k ] = $data->window_id;
            }

            $results = array_unique($arr);
            $num = 1;
            foreach ($results as $result) {
                $excel->sheet('test', function ($sheet) use ($datas, $result, $num) {

                    $sheet->setWidth(array(
                        'A'=>29,
                        'B'=>29,
                        'C'=>29
                    ));

                    foreach ($datas as $data) {
                        if ($data->window_id == $result) {
                            if ($data->order_no == 1) {
                                $sheet->row($num, array($data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg));
                                $num = $num + 1;
                            } elseif ($data->order_no == 2) {
                                $sheet->row($num, array($data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                    $data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                ));
                                $num = $num + 1;
                            }
                            for ($i = 1; $i <= $data->order_no; $i ++) {
                                if ((($i + 2) - $data->order_no) == 1) {
                                    $sheet->row($num, array($data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                        $data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                    ));
                                    $sheet->setHeight($num,70);
                                    $sheet->cells('A'.$num,function($cells){
                                        $cells->setAlignment('center');
                                        $cells->setValignment('center');
                                    });
                                    $sheet->cell('B'.$num,function($cell){
                                        $cell->setAlignment('center');
                                        $cell->setValignment('center');
                                    });
                                    $sheet->cell('C'.$num,function($cell){
                                        $cell->setAlignment('center');
                                        $cell->setValignment('center');
                                    });
                                    $num = $num + 1;
                                    break;
                                } elseif ((($i + 2) - $data->order_no) == 2) {
                                    $sheet->row($num, array($data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg));
                                    $sheet->setHeight($num,70);
                                    $sheet->cells('A'.$num,function($cells){
                                        $cells->setAlignment('center');
                                        $cells->setValignment('center');
                                    });
                                    $sheet->cell('B'.$num,function($cell){
                                        $cell->setAlignment('center');
                                        $cell->setValignment('center');
                                    });
                                    $sheet->cell('C'.$num,function($cell){
                                        $cell->setAlignment('center');
                                        $cell->setValignment('center');
                                    });
                                    $num = $num + 1;
                                    break;
                                }
                                $sheet->row($num, array($data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                    $data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                    $data->dish_name . ' ' . 1 . '*' . $data->dish_price . "\r\n" . $data->user_name . "\r\n" . $data->user_phone . "\r\n" . $data->building_name . "-" . $data->floor_name . "-" . $data->dormitory_name . "\r\n" . $data->msg,
                                ));

                                $sheet->setHeight($num,70);
                                $sheet->cells('A'.$num,function($cells){
                                    $cells->setAlignment('center');
                                    $cells->setValignment('center');
                                });
                                $sheet->cell('B'.$num,function($cell){
                                    $cell->setAlignment('center');
                                    $cell->setValignment('center');
                                });
                                $sheet->cell('C'.$num,function($cell){
                                    $cell->setAlignment('center');
                                    $cell->setValignment('center');
                                });

                                $num = $num + 1;
                                $i = $i + 2;
                            }
                        }
                    }
                });
            }

        })->export('xlsx');
    }

    static function exportDormitoryDetail($datas)
    {
        \Excel::create('宿舍明细表', function ($excel) use ($datas) {

            $excel->sheet('宿舍明细表', function ($sheet) use ($datas) {

                $sheet->loadView('excels.dormitoryDetail', compact('datas'));

            });

        })->export('xlsx');
    }
}
