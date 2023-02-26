<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\OtherFagRepositoryInterface;
use Illuminate\Http\Request;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    private $_otherFagRepositoryInterface;
    public function __construct(OtherFagRepositoryInterface $otherFagRepositoryInterface)
    {
        $this->_otherFagRepositoryInterface = $otherFagRepositoryInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countQuestions = $this->_otherFagRepositoryInterface->countQuestionByStatus();
        $info = array(
            'total_all_questions' => number_format(count($this->_otherFagRepositoryInterface->getAllQuestions())),
        );
        $fromDate = date('Y-m-d', strtotime('-7 days'));
        $toDate = date('Y-m-d 23:59:59');
        $data = $this->getDataForChart($fromDate, $toDate, 'NONE');
        $info = array_merge($info, $data);
        return view('admin.dashboard', compact('info', 'countQuestions'));
    }

    public function getDataChart(Request $request)
    {
        try {
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date') . ' 23:59:59';
            $data = $this->getDataForChart($fromDate, $toDate, 'SEARCH');
            return Response::json(['error' => 0, 'data' => $data]);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return array('labels_' => [], 'data_questions' => [], 'total_all_questions' => 0);
        }
    }

    public function getDataForChart($fromDate, $toDate, $type)
    {
        $labelsArr = [];
        $dataImei = [];
        $period = new DatePeriod(
            new DateTime($fromDate),
            new DateInterval('P1D'),
            new DateTime($toDate)
        );

        foreach ($period as $value) {
            $labelsArr[] = $value->format('Y-m-d');
            $dataImei[] = $this->_otherFagRepositoryInterface->countQuestionsByDate($value->format('Y-m-d'));
        }

        if ($type == 'SEARCH') {
            $data = array(
                'labels_' => implode(',', $labelsArr),
                'data_questions' => implode(',', $dataImei),
                'total_all_questions' => number_format(array_sum($dataImei))
            );
        } else {
            $data = array(
                'labels_' => $labelsArr,
                'data_questions' => $dataImei,
                'total_all_questions' => number_format(array_sum($dataImei))
            );
        }
        return $data;
    }

}
