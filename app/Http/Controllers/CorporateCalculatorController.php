<?php

namespace App\Http\Controllers;

use App\Models\CorporateCalculation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CorporateCalculatorController extends Controller
{
    // Emission factors (kg CO2 per unit)
    private $emissionFactors = [
        // Scope 1
        'diesel' => 2.68,      // kg CO2/liter
        'gasoline' => 2.31,    // kg CO2/liter
        'natural_gas' => 1.96, // kg CO2/m³
        'lpg' => 1.51,         // kg CO2/kg
        
        // Scope 2
        'electricity' => 0.85, // kg CO2/kWh (Indonesia grid average)
        
        // Scope 3
        'flight_domestic' => 0.255,      // kg CO2/km
        'flight_international' => 0.195, // kg CO2/km
        'shipping' => 0.01,              // kg CO2/ton-km
        'employee_commute' => 0.12,      // kg CO2/km
    ];

    private $compensationRate = 150000; // Rp per ton CO2

    public function index()
    {
        $calculations = CorporateCalculation::where('user_id', auth()->id())
            ->orWhere('company_email', request()->session()->get('temp_email'))
            ->latest()
            ->get();
            
        return view('calculator.corporate.index', compact('calculations'));
    }

    public function create()
    {
        return view('calculator.corporate.wizard');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email',
            'company_phone' => 'nullable|string',
            'industry_type' => 'required|string',
            'employee_count' => 'nullable|integer',
            'calculation_year' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            
            // Scope 1
            'scope1' => 'nullable|array',
            
            // Scope 2
            'scope2' => 'nullable|array',
            
            // Scope 3
            'scope3' => 'nullable|array',
        ]);

        // Calculate emissions
        $scope1Total = $this->calculateScope1($request->scope1 ?? []);
        $scope2Total = $this->calculateScope2($request->scope2 ?? []);
        $scope3Total = $this->calculateScope3($request->scope3 ?? []);
        
        $totalEmission = $scope1Total + $scope2Total + $scope3Total;
        $compensationCost = ($totalEmission / 1000) * $this->compensationRate;

        $calculation = CorporateCalculation::create([
            'user_id' => auth()->id(),
            'company_name' => $validated['company_name'],
            'company_email' => $validated['company_email'],
            'company_phone' => $validated['company_phone'] ?? null,
            'industry_type' => $validated['industry_type'],
            'employee_count' => $validated['employee_count'] ?? null,
            'calculation_year' => $validated['calculation_year'],
            'scope1_data' => $request->scope1,
            'scope2_data' => $request->scope2,
            'scope3_data' => $request->scope3,
            'scope1_total' => $scope1Total,
            'scope2_total' => $scope2Total,
            'scope3_total' => $scope3Total,
            'total_emission' => $totalEmission,
            'compensation_cost' => $compensationCost,
            'status' => 'completed'
        ]);

        // Store email in session for guest users
        if (!auth()->check()) {
            session(['temp_email' => $validated['company_email']]);
        }

        return redirect()->route('calc.corporate.result', $calculation->id)
            ->with('success', 'Perhitungan berhasil disimpan!');
    }

    private function calculateScope1($data)
    {
        $total = 0;
        
        if (isset($data['diesel'])) {
            $total += $data['diesel'] * $this->emissionFactors['diesel'];
        }
        if (isset($data['gasoline'])) {
            $total += $data['gasoline'] * $this->emissionFactors['gasoline'];
        }
        if (isset($data['natural_gas'])) {
            $total += $data['natural_gas'] * $this->emissionFactors['natural_gas'];
        }
        if (isset($data['lpg'])) {
            $total += $data['lpg'] * $this->emissionFactors['lpg'];
        }
        
        return $total;
    }

    private function calculateScope2($data)
    {
        $total = 0;
        
        if (isset($data['electricity'])) {
            $total += $data['electricity'] * $this->emissionFactors['electricity'];
        }
        
        return $total;
    }

    private function calculateScope3($data)
    {
        $total = 0;
        
        if (isset($data['flight_domestic_km'])) {
            $total += $data['flight_domestic_km'] * $this->emissionFactors['flight_domestic'];
        }
        if (isset($data['flight_international_km'])) {
            $total += $data['flight_international_km'] * $this->emissionFactors['flight_international'];
        }
        if (isset($data['shipping_ton_km'])) {
            $total += $data['shipping_ton_km'] * $this->emissionFactors['shipping'];
        }
        if (isset($data['employee_commute_km'])) {
            $total += $data['employee_commute_km'] * $this->emissionFactors['employee_commute'];
        }
        
        return $total;
    }

    public function result($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        
        // Check authorization
        if (auth()->check()) {
            if ($calculation->user_id !== auth()->id()) {
                abort(403);
            }
        } else {
            if ($calculation->company_email !== session('temp_email')) {
                abort(403);
            }
        }
        
        return view('calculator.corporate.result', compact('calculation'));
    }

    public function exportPdf($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        
        // Check authorization
        if (auth()->check()) {
            if ($calculation->user_id !== auth()->id()) {
                abort(403);
            }
        } else {
            if ($calculation->company_email !== session('temp_email')) {
                abort(403);
            }
        }

        $pdf = PDF::loadView('calculator.corporate.pdf', compact('calculation'));
        return $pdf->download('carbon-calculation-' . $calculation->company_name . '.pdf');
    }

    public function history()
    {
        $calculations = CorporateCalculation::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->latest()
            ->paginate(15);  // ← Ganti dengan paginate(15)
            
        return view('calculator.corporate.history', compact('calculations'));
    }

    public function delete($id)
    {
        $calculation = CorporateCalculation::findOrFail($id);
        
        // Check authorization
        if (auth()->check()) {
            if ($calculation->user_id !== auth()->id()) {
                abort(403);
            }
        } else {
            if ($calculation->company_email !== session('temp_email')) {
                abort(403);
            }
        }
        
        $calculation->delete();
        
        return redirect()->route('calc.corporate.history')
            ->with('success', 'Perhitungan berhasil dihapus!');
        }
}