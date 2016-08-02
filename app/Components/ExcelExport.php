<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/7/16
 * Time: 10:52 AM
 */
namespace App\Components;

use Cache;
use Carbon\Carbon;
use Jleon\LaravelPnotify\Notify;

class ExcelExport
{
    static function exportDetail($data)
    {
        \Excel::create(Carbon::createFromDate(), function ($excel) use ($data) {

            $excel->sheet('今日订单', function ($sheet) use ($data) {
                $sheet->setAutoSize(true);
                for ($i = 1; $i <= count($data); $i++) {
                    $sheet->row(ceil($i / 3), array($data[$i - 1]->dish->dish_name . ' ' . $data[$i - 1]->order_no . '*' . $data[$i - 1]->dish->dish_price . "\r\n" . $data[$i - 1]->user->name . "\r\n" . $data[$i - 1]->user->phone . "\r\n" . $data[$i - 1]->dormitory->floor->building->building_name . "-" . $data[$i - 1]->dormitory->floor->floor_name . "-" . $data[$i - 1]->dormitory->name,
                        $data[$i]->dish->dish_name . ' ' . $data[$i]->order_no . '*' . $data[$i]->dish->dish_price . "\r\n" . $data[$i]->user->name . "\r\n" . $data[$i]->user->phone . "\r\n" . $data[$i]->dormitory->floor->building->building_name . "-" . $data[$i]->dormitory->floor->floor_name . "-" . $data[$i]->dormitory->name,
                        $data[$i + 1]->dish->dish_name . ' ' . $data[$i + 1]->order_no . '*' . $data[$i + 1]->dish->dish_price . "\r\n" . $data[$i + 1]->user->name . "\r\n" . $data[$i + 1]->user->phone . "\r\n" . $data[$i + 1]->dormitory->floor->building->building_name . "-" . $data[$i + 1]->dormitory->floor->floor_name . "-" . $data[$i + 1]->dormitory->name));
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
        \Excel::create('一个excel', function ($excel) use ($datas) {
            foreach ($datas as $data) {
                $excel->sheet('标签', function ($sheet) use ($data) {
                    foreach ($data->dishes as $dish) {
                        $orders = self::getOrders($dish);
                        if (count($orders) != 0) {
                            foreach ($orders as $order) {
                                for ($i = 0; $i < $order->pivot->num; $i++) {
                                    $dish_detail[] = [
                                        'dish_name' => $dish->name,
                                        'dish_price' => $dish->price,
                                        'user_name' => $order->user_name,
                                        'user_phone' => $order->user_phone,
                                        'typeone' => $order->typeones,
                                        'typetwo' => $order->typetwos,
                                        'typethree' => $order->typethrees,
                                        'typefour' => $order->typefours,
                                        'taste' => $order->tastes,
                                        'tableware' => $order->tablewares,
                                        'address' => $order->dormitory->floor->building->name . '-' . $order->dormitory->floor->name .
                                            '-' . $order->dormitory->name,
                                    ];
                                }
                            }
                        }
                    }
//                    if (!isset($dish_list)) {
//                        return false;
//                    }
                    if (!isset($dish_detail)) {
                        return false;
                    }
//                    $dishes = $dish_list;
                    $dishes = $dish_detail;
                    $sheet->loadView('excels.tags', compact('dishes'));
                });
            }
        })->export('pdf');
    }

    static function exportDormitoryDetail($datas)
    {
        \Excel::create('宿舍明细表', function ($excel) use ($datas) {

            $excel->sheet('宿舍明细表', function ($sheet) use ($datas) {

                $sheet->loadView('excels.dormitoryDetail', compact('datas'));

            });

        })->export('xlsx');
    }

    static function exportSaleDetail($datas)
    {
        \Excel::create('销售明细表', function ($excel) use ($datas) {

            $excel->sheet('销售细表', function ($sheet) use ($datas) {

                $sheet->loadView('excels.saleDetail', compact('datas'));

            });

        })->export('xlsx');
    }

    static function getOrders($dish)
    {
        $lastDayTime = Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('6'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('6'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('6'))->second);
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('2'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('2'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('2'))->second);
        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('4'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('4'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('4'))->second);
        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('6'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('6'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('6'))->second);
        $timeNow = Carbon::now();
        if ($timeNow <= $todayMorningTime) {
            $orders = $dish->orders()->where('orders.created_at', '>=', $lastDayTime)
                ->where('orders.created_at', '<=', $todayMorningTime)
                ->where('orders.status', '已付款')->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            $orders = $dish->orders()->where('orders.created_at', '>=', $todayMorningTime)
                ->where('orders.created_at', '<=', $todayNoonTime)
                ->where('orders.status', '已付款')->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            $orders = $dish->orders()->where('orders.created_at', '>=', $todayNoonTime)
                ->where('orders.created_at', '<=', $todayAfterTime)
                ->where('orders.status', '已付款')->get();
        }
        if (!isset($orders)) {
            $orders = [];
        }
        return $orders;
    }

    public static function exportWindowSaleDetail($windows)
    {
        \Excel::create('餐厅窗口明细表', function ($excel) use ($windows) {

            $excel->sheet('餐厅窗口明细表', function ($sheet) use ($windows) {

                $sheet->loadView('excels.windowSaleDetail', compact('windows'));

            });

        })->export('xlsx');
    }

    public static function exportFloorOrderDetail($floors)
    {
        \Excel::create('宿舍楼层明细表', function ($excel) use ($floors) {

            $excel->sheet('宿舍楼层明细表', function ($sheet) use ($floors) {

                $sheet->loadView('excels.floorOrderDetail', compact('floors'));

            });

        })->export('xlsx');
    }
}
