<?php

namespace App\Http\Controllers;

use App\Models\CarbonTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $transactions = CarbonTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Summary Statistics
        $stats = [
            'total_offset' => CarbonTransaction::where('user_id', $user->id)
                ->where('status', 'paid')
                ->sum('co2_offset'),
            'total_spent' => CarbonTransaction::where('user_id', $user->id)
                ->where('status', 'paid')
                ->sum('amount'),
            'total_transactions' => CarbonTransaction::where('user_id', $user->id)
                ->where('status', 'paid')
                ->count(),
            'this_month_offset' => CarbonTransaction::where('user_id', $user->id)
                ->where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('co2_offset'),
        ];

        return view('transactions.index', compact('transactions', 'stats'));
    }

    public function show($id)
    {
        $transaction = CarbonTransaction::where('user_id', auth()->id())
            ->findOrFail($id);

        // Monthly emissions data for chart
        $monthlyData = CarbonTransaction::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(co2_offset) as total_offset')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Cumulative data for area chart
        $cumulative = 0;
        $cumulativeData = CarbonTransaction::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->orderBy('created_at')
            ->get()
            ->map(function ($item) use (&$cumulative) {
                $cumulative += $item->co2_offset;
                return [
                    'date' => $item->created_at->format('Y-m-d'),
                    'cumulative' => $cumulative
                ];
            });

        // Insights
        $insights = $this->generateInsights();

        // Breakdown by calculator type
        $typeBreakdown = CarbonTransaction::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->select('calculator_type', DB::raw('SUM(co2_offset) as total'))
            ->groupBy('calculator_type')
            ->get();

        return view('transactions.show', compact(
            'transaction',
            'monthlyData',
            'cumulativeData',
            'insights',
            'typeBreakdown'
        ));
    }

    private function generateInsights()
    {
        $user = auth()->user();

        // Highest emission activity this month
        $highestEmission = CarbonTransaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->orderBy('co2_emission', 'desc')
            ->first();

        // Most efficient offset
        $mostEfficient = CarbonTransaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->get()
            ->sortBy('efficiency')
            ->first();

        // Average monthly offset
        $avgMonthlyOffset = CarbonTransaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->avg('co2_offset');

        // Potential reduction (estimate 30% of total emissions)
        $totalEmissions = CarbonTransaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('co2_emission');
        $potentialReduction = $totalEmissions * 0.3;

        // Carbon footprint trend
        $lastMonthOffset = CarbonTransaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('co2_offset');

        $thisMonthOffset = CarbonTransaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('co2_offset');

        $trend = 'stable';
        $trendPercentage = 0;
        
        if ($lastMonthOffset > 0) {
            $trendPercentage = (($thisMonthOffset - $lastMonthOffset) / $lastMonthOffset) * 100;
            $trend = $trendPercentage > 5 ? 'increasing' : ($trendPercentage < -5 ? 'decreasing' : 'stable');
        }

        return [
            'highest_emission' => $highestEmission,
            'most_efficient' => $mostEfficient,
            'avg_monthly_offset' => round($avgMonthlyOffset ?? 0, 2),
            'potential_reduction' => round($potentialReduction, 2),
            'trend' => $trend,
            'trend_percentage' => round(abs($trendPercentage), 1),
        ];
    }
}