<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use MathPHP\Probability\Distribution\Continuous;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScoresExport;
use App\Imports\ScoresImport;


class ScoreController extends Controller
{
    //READ
    public function index()
    {
        $scores = Score::all();
        return view('scores.index', ['scores' => $scores]);
    }

    public function update($id)
    {
    $scores = Score::find($id);
    return view('scores.update', ['scores' => $scores]);
    }

    public function bergolong()
    {
        $scores = Score::all();
        return view('scores.bergolong', ['scores' => $scores]);
    }

    public function create()
    {
        return view('scores.create');
    }

    public function show($id)
    {
        $score = Score::find($id);
        return view('scores.show', ['score' => $score]);
    }

    //CREATE
    public function store(Request $request)
    {
        $data = $request->validate([
            'score' => ['required', 'numeric'],
            
        ]);
    
        Score::create($data);
    
        return redirect(route('scores.index'))->with('success','');

    }

    

    //UPDATE
    public function updateScores(Request $request, $id)
    {
        $scores = Score::find($id);
        $scores->score = $request->score;
        $scores->save();


        return redirect()->route('scores.index')->with('success', 'Scores updated successfully');
    }

   
    //DELETE
    public function destroy($id)
    {
        $score = Score::find($id);
        $score->delete();

        return redirect(route('scores.index'))->with('success', 'Score deleted successfully');
    }


    //frek
    public function dataBergolong()
    {
        $scores = Score::all();

        // Mengambil nilai minimum dan maksimum dari skor
        $minScore = $scores->min('score');
        $maxScore = $scores->max('score');

        // Menentukan jumlah kelas interval (bisa disesuaikan)
        $jumlahKelas = 10;

        // Menghitung lebar interval
        $intervalWidth = ceil(($maxScore - $minScore) / $jumlahKelas);

        // Mengelompokkan data skor ke dalam kelas interval
        $scoreGroups = [];
        $totalFrequency = 0; // To calculate the total frequency

        for ($i = 0; $i < $jumlahKelas; $i++) {
            $lowerBound = $minScore + ($i * $intervalWidth);
            $upperBound = $lowerBound + $intervalWidth - 1;
            $count = $scores->whereBetween('score', [$lowerBound, $upperBound])->count();

            // Menyimpan data kelas interval, nilai tengah, dan frekuensi
            $scoreGroups[] = [
                'interval' => "$lowerBound - $upperBound",
                'mid_value' => ($lowerBound + $upperBound) / 2,
                'frequency' => $count,
            ];

            $totalFrequency += $count;
        }

        // Calculate and add the percentage to each data
        // Calculate and add the formatted percentage to each data
        foreach ($scoreGroups as &$dataSiswa) {
        $percentage = ($dataSiswa['frequency'] / $totalFrequency) * 100;
        $dataSiswa['percentage'] = number_format($percentage, 2, '.', ''); // Format to two decimal places
        }


        return view('scores.bergolong', compact('scoreGroups'));
    }

    public function calculateStatistics()
    {
        $scores = Score::all();

        // Calculate minimum and maximum scores
        $minScore = $scores->min('score');
        $maxScore = $scores->max('score');

        // Calculate average score
        $averageScore = number_format($scores->avg('score'), 2, '.', ''); // Format to two decimal places

        // Calculate the total number of scores
        $totalScores = $scores->count();

        // Calculate standard deviation
        $sumOfSquaredDifferences = $scores->sum(function ($score) use ($averageScore) {
            return pow($score->score - $averageScore, 2);
        });

        $standardDeviation = sqrt($sumOfSquaredDifferences / ($totalScores - 1));

        return view('scores.statistics', compact('minScore', 'maxScore', 'averageScore', 'totalScores', 'standardDeviation', 'scores'));
    }



    public function distribusiFrekuensi()
    {
        $scoreFrequencies = Score::groupBy('score')
            ->selectRaw('score, count(*) as count')
            ->orderBy('score', 'asc')
            ->get()
            ->map(function ($item) {
                return $item;
            });


        return view('scores.frekuensi', compact('scoreFrequencies'));
    }
 
    public function getChiSqure()
    {
        $result = DB::table('tb_zed')->get();

        return view('scores.chitable', compact('result'));
    }

    public function calculateChiSqure(Request $request)
    {

        $chi = DB::table('tb_zed')->where('z', substr($request->chi, 0, -1))->first();
        $lastChi    = substr($request->chi, -1);
        $result = '';

        if ($lastChi === '0') {
            $result = $chi->nol;
        } elseif ($lastChi === '1') {
            $result = $chi->satu;
        } elseif ($lastChi === '2') {
            $result = $chi->dua;
        } elseif ($lastChi === '3') {
            $result = $chi->tiga;
        } elseif ($lastChi === '4') {
            $result = $chi->empat;
        } elseif ($lastChi === '5') {
            $result = $chi->lima;
        } elseif ($lastChi === '6') {
            $result = $chi->enam;
        } elseif ($lastChi === '7') {
            $result = $chi->tujuh;
        } elseif ($lastChi === '8') {
            $result = $chi->delapan;
        } elseif ($lastChi === '9') {
            $result = $chi->sembilan;
        } else {
            $result = $chi->nol;
        }


        return back()->with('success', $result);
    }

    //liliefors
        function normsdist($x)
    {
        $distribution = new Continuous\Normal(0, 1); 
        return $distribution->cdf($x); 
    }

    public function liliefors()
    {
        $scores = Score::all(); # sesuaikan dengan nama model
        $scoresAverage = $scores->avg('score'); # sesuaikan dengan nama colom nilai
        $scoresSTD = DB::table('scores') # sesuaikan dengan table dan colom nilai
            ->selectRaw('SQRT(SUM(POWER(score - ' . $scoresAverage . ', 2)) / (COUNT(score) - 1)) AS result')->first();

        $sortedScores = $scores->pluck('score')->sort()->toArray();

        $totalData = count($sortedScores);

        $empiricalCumulativeProbability = [];

        $cumulativeCount = 0;
        foreach ($sortedScores as $value) {
            $cumulativeCount++;
            $empiricalCumulativeProbability[$value] = $cumulativeCount / $totalData;
        }

        $zScores = [];
        foreach ($scores as $score) {
            $scoreValue = $score->score;
            $zScore = ($scoreValue - $scoresAverage) / $scoresSTD->result;
            $normsdist = $this->normsdist($zScore);
            $zScores[$score->id] = [
                'scoreValue' => $scoreValue,
                'zScore' => number_format($zScore, 5),
                'normsdist' => number_format($normsdist, 5),
                'empiricalCumulativeProbability' => number_format($empiricalCumulativeProbability[$scoreValue], 5),
                'fx' => abs($normsdist - $empiricalCumulativeProbability[$scoreValue]),
            ];
        }

        return view('scores.liliefors', compact('scores', 'zScores'));
    }

    public function export()
    {
        return Excel::download(new ScoresExport, 'scores.xlsx');
    }

    public function import()
    {
        Excel::import(new ScoresImport, request()->file('file'));

        return redirect('/scores')->with('success', 'Success Import Scores');
    }

    public function ujiT()
    {
        $result = DB::table('ujit')->get();
        $sumX1 = $result->sum('x1');
        $sumX2 = $result->sum('x2');
        $averageX1 = $result->avg('x1');
        $averageX2 = $result->avg('x2');
        $SD1 = DB::table('ujit')
            ->selectRaw('SQRT(SUM(POWER(x1 - ' . $averageX1 . ', 2)) / (COUNT(x1) - 1)) AS result')->first();
        $SD2 = DB::table('ujit')
            ->selectRaw('SQRT(SUM(POWER(x2 - ' . $averageX2 . ', 2)) / (COUNT(x2) - 1)) AS result')->first();

        $roundedSDX1 = round($SD1->result, 2);
        $roundedSDX2 = round($SD2->result, 2);

        $variance1 = DB::table('ujit')
            ->selectRaw('SUM(POWER(x1 - ' . $averageX1 . ', 2)) / (COUNT(x1) - 1) AS result')
            ->first();
        $variance2 = DB::table('ujit')
            ->selectRaw('SUM(POWER(x2 - ' . $averageX2 . ', 2)) / (COUNT(x2) - 1) AS result')
            ->first();

        $roundedVariance1 = round($variance1->result, 2);
        $roundedVariance2 = round($variance2->result, 2);

        return view('scores.ujit', compact('result', 'sumX1', 'sumX2', 'averageX1', 'averageX2', 'roundedSDX1', 'roundedSDX2', 'roundedVariance1', 'roundedVariance2'));
    }

    public function biserial()
    {
        $result = DB::table('ujit')->get();
        $N = $result->count();

        // Assuming 'x' is the column you want to calculate biserial correlation for
        $sumX1 = $result->sum('x1');
        $sumX2 = $result->sum('x2');

        $meanX1 = $sumX1 / $N;
        $meanX2 = $sumX2 / $N;

        // Calculate SSY (Sum of Squares for Y) for x1 and x2 separately
        $SSYX1 = $result->sum(function ($item) use ($meanX1) {
            return pow($item->x1 - $meanX1, 2);
        });
        $SSYX2 = $result->sum(function ($item) use ($meanX2) {
            return pow($item->x2 - $meanX2, 2);
        });

        // Calculate ΣY2 for x1 and x2 separately
        $sumY2X1 = $result->sum(function ($item) {
            return pow($item->x1, 2);
        });
        $sumY2X2 = $result->sum(function ($item) {
            return pow($item->x2, 2);
        });
        
        

        // Create a new variable 'total' that combines x1 and x2 values
        $total = $result->pluck('x1')->merge($result->pluck('x2'))->toArray();
        $Ntotal = count($total);
        $sumN = array_sum($total);
        $sumY2N = array_sum(array_map(function ($item) {
            return pow($item, 2);
        }, $total));
        $meanN = $sumN / $Ntotal;
        $SSYN = array_sum(array_map(function ($item) use ($meanN) {
            return pow($item - $meanN, 2);
        }, $total));




        return view('scores.biserial', compact('result', 'N', 'sumX1', 'sumX2', 'meanX1', 'meanX2', 'SSYX1', 'SSYX2', 'sumY2X1', 'sumY2X2', 'Ntotal', 'sumN', 'sumY2N', 'meanN', 'SSYN'));
    }


}