<?php

namespace App\Http\Controllers;

use App\Models\CorporateCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CorporateCalculatorController extends Controller
{
    private $emissionFactors = [
        'diesel'               => 2.68,
        'gasoline'             => 2.31,
        'natural_gas'          => 1.96,
        'lpg'                  => 1.51,
        'electricity'          => 0.85,
        'flight_domestic'      => 0.255,
        'flight_international' => 0.195,
        'shipping'             => 0.01,
        'employee_commute'     => 0.12,
    ];

    private $damageFactors = [
        'land'  => ['none' => 0, 'low' => 500,   'medium' => 3500,  'high' => 15000],
        'air'   => ['none' => 0, 'low' => 300,   'medium' => 2500,  'high' => 12000],
        'water' => ['none' => 0, 'low' => 200,   'medium' => 2000,  'high' =>  8000],
    ];

    private $compensationRate = 150000;

    private $restorationPrograms = [
        'land' => [
            'low'    => [['name' => 'Penanaman Pohon Skala Kecil',          'icon' => '🌱', 'color' => '#10b981']],
            'medium' => [
                ['name' => 'Reforestasi Lahan Kritis',                      'icon' => '🌳', 'color' => '#059669'],
                ['name' => 'Pemulihan Keanekaragaman Hayati',               'icon' => '🦋', 'color' => '#10b981'],
            ],
            'high'   => [
                ['name' => 'Reforestasi Besar-besaran (> 10 ha)',           'icon' => '🌲', 'color' => '#064e3b'],
                ['name' => 'Restorasi Ekosistem & Habitat',                 'icon' => '🦚', 'color' => '#059669'],
                ['name' => 'Program Mangrove & Pesisir',                    'icon' => '🌊', 'color' => '#0891b2'],
            ],
        ],
        'air'  => [
            'low'    => [['name' => 'Pemantauan Kualitas Udara',            'icon' => '📡', 'color' => '#3b82f6']],
            'medium' => [
                ['name' => 'Stasiun Monitor Udara Lokal',                   'icon' => '🔬', 'color' => '#2563eb'],
                ['name' => 'Program Filter Emisi Industri',                 'icon' => '🏭', 'color' => '#3b82f6'],
            ],
            'high'   => [
                ['name' => 'Jaringan Monitor Udara Regional',               'icon' => '📊', 'color' => '#1d4ed8'],
                ['name' => 'Teknologi Penyaringan Emisi',                   'icon' => '⚙️',  'color' => '#3b82f6'],
                ['name' => 'Kompensasi Komunitas Terdampak',                'icon' => '🏘️', 'color' => '#0ea5e9'],
            ],
        ],
        'water'=> [
            'low'    => [['name' => 'Optimasi IPAL',                        'icon' => '💧', 'color' => '#8b5cf6']],
            'medium' => [
                ['name' => 'Rehabilitasi Badan Air Lokal',                  'icon' => '🌊', 'color' => '#7c3aed'],
                ['name' => 'Pemantauan Kualitas Air',                       'icon' => '🧪', 'color' => '#8b5cf6'],
            ],
            'high'   => [
                ['name' => 'Rehabilitasi Sungai & Pesisir',                 'icon' => '🏞️', 'color' => '#6d28d9'],
                ['name' => 'Pemulihan Ekosistem Air Tawar',                 'icon' => '🐟', 'color' => '#7c3aed'],
                ['name' => 'Program Air Bersih Komunitas',                  'icon' => '🚿', 'color' => '#8b5cf6'],
            ],
        ],
    ];

    // -------------------------------------------------------------------------
    // INDEX
    // -------------------------------------------------------------------------

    public function index()
    {
        $calculations = CorporateCalculation::where(function ($q) {
            if (auth()->check()) {
                $q->where('user_id', auth()->id());
            } else {
                $q->where('company_email', session('temp_email', '__none__'));
            }
        })->latest()->get();

        return view('calculator.corporate.index', compact('calculations'));
    }

    // -------------------------------------------------------------------------
    // CREATE
    // -------------------------------------------------------------------------

    public function create()
    {
        return view('calculator.corporate.wizard');
    }

    // -------------------------------------------------------------------------
    // CALCULATE
    // -------------------------------------------------------------------------

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'company_name'       => 'required|string|max:255',
            'company_siup'       => 'required|string|max:100',
            'company_email'      => 'required|email|max:255',
            'company_phone'      => 'nullable|string|max:30',
            'industry_type'      => 'required|string|max:100',
            'company_affiliate'  => 'nullable|string|max:255',
            'facility_count'     => 'required|integer|min:1',
            'company_location'   => 'required|string|max:255',
            'calculation_year'   => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'damage.land'        => 'required|in:none,low,medium,high',
            'damage.air'         => 'required|in:none,low,medium,high',
            'damage.water'       => 'required|in:none,low,medium,high',
            'damage_description' => 'nullable|string|max:1000',
            'payment_scheme'     => 'required|in:annual,semi_annual,quarterly',
        ]);

        $damage = $validated['damage'];

        $emissionLand  = $this->damageFactors['land'][$damage['land']];
        $emissionAir   = $this->damageFactors['air'][$damage['air']];
        $emissionWater = $this->damageFactors['water'][$damage['water']];

        $scope1Total   = ($emissionLand + $emissionAir + $emissionWater) * 1000;
        $totalEmission = $scope1Total;

        if ($totalEmission <= 0) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['emission' => 'Pilih minimal satu tingkat dampak lingkungan yang lebih dari "Tidak Ada".'])
                ->with('error', 'Total emisi tidak boleh 0. Mohon pilih setidaknya satu dampak lingkungan.');
        }

        $compensationCost = ($totalEmission / 1000) * $this->compensationRate;

        $cycles = match ($validated['payment_scheme']) {
            'semi_annual' => 2,
            'quarterly'   => 4,
            default       => 1,
        };

        $calculation = CorporateCalculation::create([
            'user_id'                => auth()->id(),
            'company_name'           => $validated['company_name'],
            'company_siup'           => $validated['company_siup'],
            'company_email'          => $validated['company_email'],
            'company_phone'          => $validated['company_phone'] ?? null,
            'industry_type'          => $validated['industry_type'],
            'company_affiliate'      => $validated['company_affiliate'] ?? null,
            'facility_count'         => $validated['facility_count'],
            'company_location'       => $validated['company_location'],
            'calculation_year'       => $validated['calculation_year'],
            'damage_land'            => $damage['land'],
            'damage_air'             => $damage['air'],
            'damage_water'           => $damage['water'],
            'damage_description'     => $validated['damage_description'] ?? null,
            'scope1_data'            => json_encode($damage),
            'scope2_data'            => json_encode([]),
            'scope3_data'            => json_encode([]),
            'scope1_total'           => $scope1Total,
            'scope2_total'           => 0,
            'scope3_total'           => 0,
            'total_emission'         => $totalEmission,
            'compensation_cost'      => $compensationCost,
            'payment_scheme'         => $validated['payment_scheme'],
            'payment_cycles'         => $cycles,
            'compensation_per_cycle' => $compensationCost / $cycles,
            'status'                 => 'pending_audit',
        ]);

        if (! auth()->check()) {
            session(['temp_email' => $validated['company_email']]);
        }

        return redirect()->route('calc.corporate.result', $calculation->id)
            ->with('success', 'Kalkulasi berhasil! Data Anda sedang dalam proses verifikasi tim Auditor KLH.');
    }

    // -------------------------------------------------------------------------
    // RESULT
    // -------------------------------------------------------------------------

    public function result($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        $this->authorizeAccess($calculation);

        $levelLabels = [
            'none'   => ['label' => 'Tidak Ada', 'color' => '#64748b', 'bg' => '#f1f5f9'],
            'low'    => ['label' => 'Ringan',    'color' => '#065f46', 'bg' => '#d1fae5'],
            'medium' => ['label' => 'Sedang',    'color' => '#92400e', 'bg' => '#fef3c7'],
            'high'   => ['label' => 'Berat',     'color' => '#991b1b', 'bg' => '#fee2e2'],
        ];

        $paymentLabels = [
            'annual'      => 'Tahunan',
            'semi_annual' => 'Semesteran',
            'quarterly'   => 'Kuartalan',
        ];

        $damageFactors = $this->damageFactors;

        return view('calculator.corporate.result', compact(
            'calculation', 'levelLabels', 'paymentLabels', 'damageFactors'
        ));
    }

    // -------------------------------------------------------------------------
    // MONITORING
    // -------------------------------------------------------------------------

    public function monitoring($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        $this->authorizeAccess($calculation);

        $programs = $this->buildPrograms($calculation);

        $payments = collect();
        if (Schema::hasTable('corporate_payments')) {
            $payments = DB::table('corporate_payments')
                ->where('calculation_id', $id)
                ->orderBy('cycle_number')
                ->get();
        }

        $activities = collect();
        if (Schema::hasTable('restoration_activities')) {
            $activities = DB::table('restoration_activities')
                ->where('calculation_id', $id)
                ->orderBy('activity_date', 'desc')
                ->limit(10)
                ->get();
        }

        $levelLabels = [
            'none'   => ['label' => 'Tidak Ada', 'color' => '#64748b', 'bg' => '#f1f5f9'],
            'low'    => ['label' => 'Ringan',    'color' => '#065f46', 'bg' => '#d1fae5'],
            'medium' => ['label' => 'Sedang',    'color' => '#92400e', 'bg' => '#fef3c7'],
            'high'   => ['label' => 'Berat',     'color' => '#991b1b', 'bg' => '#fee2e2'],
        ];

        return view('pages.monitoring', compact(
            'calculation', 'programs', 'payments', 'activities', 'levelLabels'
        ));
    }

    // -------------------------------------------------------------------------
    // PROGRESS DATA — JSON endpoint untuk realtime polling
    // -------------------------------------------------------------------------

    public function progressData($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        $this->authorizeAccess($calculation);

        $programs = $this->buildPrograms($calculation);

        $totalPct   = collect($programs)->sum('progress_pct');
        $overallPct = count($programs) > 0 ? round($totalPct / count($programs)) : 0;

        $recentActivities = collect();
        if (Schema::hasTable('restoration_activities')) {
            $recentActivities = DB::table('restoration_activities')
                ->where('calculation_id', $id)
                ->orderBy('activity_date', 'desc')
                ->limit(5)
                ->get()
                ->map(fn($a) => [
                    'name'        => $a->activity_name,
                    'location'    => $a->location,
                    'date'        => $a->activity_date,
                    'co2e_offset' => $a->co2e_offset,
                    'status'      => $a->status,
                ]);
        }

        $nextPayment = null;
        if (Schema::hasTable('corporate_payments')) {
            $nextPayment = DB::table('corporate_payments')
                ->where('calculation_id', $id)
                ->whereIn('status', ['scheduled', 'pending', 'overdue'])
                ->orderBy('due_date')
                ->first();
        }

        return response()->json([
            'overall_pct'       => $overallPct,
            'total_emission'    => $calculation->total_emission,
            'programs'          => $programs,
            'recent_activities' => $recentActivities,
            'next_payment'      => $nextPayment,
            'status'            => $calculation->status,
            'last_updated'      => now()->format('H:i:s'),
        ]);
    }

    // -------------------------------------------------------------------------
    // EXPORT PDF
    // -------------------------------------------------------------------------

    public function exportPdf($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        $this->authorizeAccess($calculation);

        $pdf = PDF::loadView('calculator.corporate.pdf', compact('calculation'));
        return $pdf->download('laporan-kompensasi-' . Str::slug($calculation->company_name) . '.pdf');
    }

    // -------------------------------------------------------------------------
    // HISTORY
    // -------------------------------------------------------------------------

    public function history()
    {
        $calculations = CorporateCalculation::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('calculator.corporate.history', compact('calculations'));
    }

    // -------------------------------------------------------------------------
    // DELETE
    // -------------------------------------------------------------------------

    public function delete($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        $this->authorizeAccess($calculation);
        $calculation->delete();

        return redirect()->route('calc.corporate.history')
            ->with('success', 'Data kalkulasi berhasil dihapus.');
    }

    // -------------------------------------------------------------------------
    // PRIVATE HELPERS
    // -------------------------------------------------------------------------

    private function authorizeAccess(CorporateCalculation $calc): void
    {
        if (auth()->check()) {
            if ($calc->user_id && $calc->user_id !== auth()->id()) {
                abort(403);
            }
        } else {
            if ($calc->company_email !== session('temp_email')) {
                abort(403);
            }
        }
    }

    private function buildPrograms(CorporateCalculation $calc): array
    {
        $programs = [];

        foreach (['land', 'air', 'water'] as $pillar) {
            $level = $calc->{"damage_{$pillar}"} ?? 'none';
            if ($level === 'none' || ! isset($this->restorationPrograms[$pillar][$level])) {
                continue;
            }

            foreach ($this->restorationPrograms[$pillar][$level] as $tpl) {
                $dbProgress = null;
                if (Schema::hasTable('restoration_programs')) {
                    $dbProgress = DB::table('restoration_programs')
                        ->where('calculation_id', $calc->id)
                        ->where('program_name', $tpl['name'])
                        ->value('progress_pct');
                }

                if ($dbProgress === null) {
                    $daysSince  = max(0, now()->diffInDays($calc->created_at));
                    $totalDays  = 365 * 3;
                    $dbProgress = min(95, round(($daysSince / $totalDays) * 100));
                }

                $programs[] = [
                    'pillar'       => $pillar,
                    'name'         => $tpl['name'],
                    'icon'         => $tpl['icon'],
                    'color'        => $tpl['color'],
                    'progress_pct' => (int) $dbProgress,
                    'level'        => $level,
                ];
            }
        }

        return $programs;
    }

    private function calculateScope1($data): float
    {
        $total = 0;
        foreach (['diesel', 'gasoline', 'natural_gas', 'lpg'] as $key) {
            if (! empty($data[$key])) {
                $total += (float) $data[$key] * ($this->emissionFactors[$key] ?? 0);
            }
        }
        return $total;
    }

    private function calculateScope2($data): float
    {
        return (float) ($data['electricity'] ?? 0) * $this->emissionFactors['electricity'];
    }

    private function calculateScope3($data): float
    {
        $total = 0;
        $map = [
            'flight_domestic_km'      => 'flight_domestic',
            'flight_international_km' => 'flight_international',
            'shipping_ton_km'         => 'shipping',
            'employee_commute_km'     => 'employee_commute',
        ];
        foreach ($map as $field => $factor) {
            if (! empty($data[$field])) {
                $total += (float) $data[$field] * $this->emissionFactors[$factor];
            }
        }
        return $total;
    }
}