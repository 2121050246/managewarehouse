<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Export;

use Carbon\Carbon;

class NumberBarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // Lấy danh sách các năm từ cơ sở dữ liệu
      $years = Product::selectRaw('YEAR(created_at) as year')
        ->groupBy('year')
        ->orderBy('year', 'ASC')
        ->pluck('year');

        return $years;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    public function show()
    {

    }

    //! special case : trường hợp đặc biệt
    public function showByYearMonth($year, $month){
              // Tạo ngày đầu tiên và ngày cuối cùng của tháng
            $firstDayOfMonth = Carbon::createFromDate($year, $month, 1)->startOfDay();
            $lastDayOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

            // Lấy số lượng từng ngày trong tháng
            $dailyQuantity_imports = Product::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                ->groupBy('date')
                ->get();

                    // Lấy số lượng từng ngày trong tháng
            $dailyQuantity_exports = Export::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy('date')
            ->get();

            $arr = [
                'imports' => $dailyQuantity_imports ,
                'exports' =>$dailyQuantity_exports
            ];

            return $arr ;
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
