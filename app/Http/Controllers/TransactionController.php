<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // ✅ TAMBAHKAN INI

class TransactionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        Log::info('=== TRANSACTION INDEX ===');
        Log::info('User ID: ' . $userId);
        
        // Get all transactions with pagination
        $transactions = Payment::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        Log::info('Transactions count: ' . $transactions->count());
        
        // Calculate statistics - Tampilkan semua status
        $totalSpent = Payment::where('user_id', $userId)
            ->sum('total_amount');
        
        $co2Offset = Payment::where('user_id', $userId)
            ->sum('carbon_amount');
        
        $totalTransactions = Payment::where('user_id', $userId)->count();
        
        $thisMonthOffset = Payment::where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('carbon_amount');
        
        Log::info('Total Spent: ' . $totalSpent);
        Log::info('CO2 Offset: ' . $co2Offset);
        Log::info('Total Transactions: ' . $totalTransactions);
        Log::info('This Month Offset: ' . $thisMonthOffset);
        
        $data = [
            'total_spent' => $totalSpent ?? 0,
            'co2_offset' => $co2Offset ?? 0,
            'total_transactions' => $totalTransactions ?? 0,
            'this_month_offset' => $thisMonthOffset ?? 0,
        ];
        
        return view('transactions.index', compact('transactions', 'data'));
    }

    public function show($id)
    {
        $userId = Auth::id();
        
        Log::info('=== TRANSACTION SHOW ===');
        Log::info('Payment ID: ' . $id);
        Log::info('User ID: ' . $userId);
        
        // Get payment with carbon calculation
        $payment = Payment::with('carbonCalculation')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
        
        Log::info('Payment found: ' . $payment->order_id);
        Log::info('Has carbon calculation: ' . ($payment->carbonCalculation ? 'YES' : 'NO'));
        
        if ($payment->carbonCalculation) {
            Log::info('Carbon calculation details: ' . json_encode($payment->carbonCalculation->details));
        }
        
        // Monthly data for chart (last 6 months)
        $monthlyData = Payment::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(carbon_amount) as total_offset')
            )
            ->where('user_id', $userId)
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        Log::info('Monthly data count: ' . $monthlyData->count());
        
        // Cumulative data (last 30 days)
        $dailyData = Payment::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(carbon_amount) as daily_offset')
            )
            ->where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        Log::info('Daily data count: ' . $dailyData->count());
        
        $cumulativeData = collect([]);
        $cumulative = 0;
        
        foreach ($dailyData as $item) {
            $cumulative += $item->daily_offset;
            $cumulativeData->push([
                'date' => $item->date,
                'cumulative' => $cumulative
            ]);
        }
        
        // Type breakdown
        $typeBreakdown = Payment::select(
                'calculator_type',
                DB::raw('SUM(carbon_amount) as total')
            )
            ->where('user_id', $userId)
            ->groupBy('calculator_type')
            ->get();
        
        Log::info('Type breakdown count: ' . $typeBreakdown->count());
        
        // Insights
        $highestEmission = Payment::where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('carbon_amount', 'desc')
            ->first();
        
        $mostEfficient = Payment::where('user_id', $userId)
            ->where('carbon_amount', '>', 0)
            ->get()
            ->sortBy(function ($payment) {
                return $payment->total_amount / $payment->carbon_amount;
            })
            ->first();
        
        $potentialReduction = Payment::where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('carbon_amount') * 0.3;
        
        $avgMonthlyOffset = Payment::where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->avg('carbon_amount') ?? 0;
        
        $currentMonth = Payment::where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('carbon_amount');
        
        $lastMonth = Payment::where('user_id', $userId)
            ->whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('carbon_amount');
        
        $trend = 'stable';
        $trendPercentage = 0;
        
        if ($lastMonth > 0) {
            $trendPercentage = (($currentMonth - $lastMonth) / $lastMonth) * 100;
            
            if ($trendPercentage > 5) {
                $trend = 'increasing';
            } elseif ($trendPercentage < -5) {
                $trend = 'decreasing';
            }
        }
        
        $insights = [
            'highest_emission' => $highestEmission,
            'most_efficient' => $mostEfficient,
            'potential_reduction' => $potentialReduction ?? 0,
            'avg_monthly_offset' => $avgMonthlyOffset ?? 0,
            'trend' => $trend,
            'trend_percentage' => round($trendPercentage, 2),
        ];
        
        Log::info('Insights prepared');
        
        return view('transactions.show', compact(
            'payment',
            'monthlyData',
            'cumulativeData',
            'typeBreakdown',
            'insights'
        ));
    }

    public function certificate($id)
    {
        $userId = Auth::id();
        
        $payment = Payment::where('id', $id)
            ->where('user_id', $userId)
            ->where('status', 'paid')
            ->firstOrFail();
        
        // TODO: Generate PDF certificate
        return view('transactions.certificate', compact('payment'));
    }
}