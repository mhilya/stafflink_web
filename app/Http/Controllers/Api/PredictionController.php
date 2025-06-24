<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PredictionController extends Controller
{
    private $pythonApiUrl = 'http://127.0.0.1:5000';

    public function create()
    {
        return view('predictions.create');
    }

    public function history()
    {
        try {
            $response = Http::timeout(10)->get("{$this->pythonApiUrl}/predictions");
            $predictions = $response->successful() ? ($response->json()['predictions'] ?? []) : [];

            return view('predictions.history', [
                'predictions' => $predictions
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to get prediction history: ' . $e->getMessage());
            return view('predictions.history', ['predictions' => []]);
        }
    }

    public function predict(Request $request)
    {
        Log::info('Prediction request received:', $request->all());

        $validated = $request->validate([
            'KPIs_met_more_than_80' => 'required|integer|in:0,1',
            'avg_training_score' => 'required|numeric|between:0,100',
            'previous_year_rating' => 'required|integer|between:1,5',
            'awards_won' => 'required|integer|in:0,1'
        ]);

        try {
            Log::info('Sending to Python API:', $validated);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])
                ->post("{$this->pythonApiUrl}/predict", [
                    'KPIs_met_more_than_80' => (int)$validated['KPIs_met_more_than_80'],
                    'avg_training_score' => (float)$validated['avg_training_score'],
                    'previous_year_rating' => (int)$validated['previous_year_rating'],
                    'awards_won' => (int)$validated['awards_won']
                ]);

            Log::info('Python API Response Status:', ['status' => $response->status()]);
            Log::info('Python API Response Body:', ['body' => $response->body()]);

            if ($response->successful()) {
                $predictionData = $response->json();

                $formattedFeatures = [
                    'KPIs_met >80%' => $validated['KPIs_met_more_than_80'],
                    'avg_training_score' => $validated['avg_training_score'],
                    'previous_year_rating' => $validated['previous_year_rating'],
                    'awards_won' => $validated['awards_won']
                ];

                $result = [
                    'status' => $predictionData['status'] ?? 'success',
                    'prediction' => $predictionData['prediction'] ?? null,
                    'probability' => $predictionData['probability'] ?? null,
                    'feature_values' => $formattedFeatures
                ];

                Log::info('Sending response:', $result);
                return response()->json($result);
            }

            Log::error('Python API failed:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Prediction failed',
                'python_error' => $response->body(),
                'http_status' => $response->status()
            ], 500);

        } catch (\Exception $e) {
            Log::error('Prediction API error: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to prediction service: ' . $e->getMessage()
            ], 503);
        }
    }

    public function getPromotionStats($month = null, $year = null)
    {
        try {
            $params = [];
            if ($month) $params['month'] = $month;
            if ($year) $params['year'] = $year;

            $response = Http::timeout(10)
                ->get("{$this->pythonApiUrl}/promotion-stats", $params);

            if ($response->successful()) {
                return $response->json(); // Format: ['promoted' => x, 'not_promoted' => y]
            }

            Log::error('Python API returned unsuccessful response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return ['promoted' => 0, 'not_promoted' => 0];

        } catch (\Exception $e) {
            Log::error('Failed to get promotion stats: ' . $e->getMessage());
            return ['promoted' => 0, 'not_promoted' => 0];
        }
    }
}
