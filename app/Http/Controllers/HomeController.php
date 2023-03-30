<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all = Invoice::count();
        $unpaid = round((Invoice::where('status_value', 0)->count() / $all) * 100,2);
        $paid = round((Invoice::where('status_value', 1)->count() / $all) * 100,2);
        $partially_paid = round((Invoice::where('status_value', 2)->count() / $all) * 100,2);
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الاجمالي', 'الغير مدفوعة', 'المدفوعة', 'المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "اجمالي الفواتير",
                    'backgroundColor' => ['#0267e9'],
                    'data' => [100]
                ],
                [
                    "label" => "الفواتير الغير مدفوعة",
                    'backgroundColor' => ['#f84c69'],
                    'data' => [$unpaid]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#089c6c'],
                    'data' => [$paid]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#f66f31'],
                    'data' => [$partially_paid]
                ]
            ])
            ->options([]);

        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$unpaid, $paid, $partially_paid]
                ]
            ])
            ->options([]);

        return view('home', compact('chartjs','chartjs_2'));

    }
}
