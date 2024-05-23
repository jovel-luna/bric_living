<?php

namespace App\Http\Controllers;

use App\Imports\PropertiesImport;
use App\Imports\DevelopmentImport;
use App\Imports\OperationImport;
use App\Imports\LocationImport;
use App\Imports\BudgetsImport;
use App\Imports\ExpenditureImport;
use App\Imports\LettingsImport;
use App\Imports\ContractStatusImport;
use App\Imports\FinanceImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Property;
use App\Models\Location;
use App\Models\Entity;
use App\Models\EntityProperties;
use App\Models\Acquisition;
use App\Models\OperationUtility;
use App\Models\OperationBudget;
use App\Models\OperationExpenditure;
use App\Models\OperationInsurance;
use App\Models\LettingStatus;
use App\Models\Development;
use App\Models\Letting;
use App\Models\Link;
use App\Models\Gallery;
use App\Models\Tenant;
use App\Models\Finance;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use DataTables;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Auth;

class ImportController extends Controller
{
    public function viewImport(Request $request)
    {
        $referrer = $request->headers->get('referer');
        $path = parse_url($referrer, PHP_URL_PATH);
        Log::info($referrer);
        Log::info($path);
        $data = [
            'referrer' => $path
        ];
        Log::info($data);
        return view("layouts.import.index", compact('data'));
    }

    public function uploadData(Request $request)
    {
        Log::info($request);
        $entityArray = Entity::select('id', 'entity')->get()->toArray();
        switch ($request->type) {
            case 'Properties':
                $propertyArray = Excel::toArray(new PropertiesImport, $request->file);
                $properties = Property::import($propertyArray, $entityArray);
                return redirect()->route('home')->with('success', 'Data Imported Successfully');
                break;
            case 'Development':
                $developmentArray = Excel::toArray(new DevelopmentImport, $request->file);
                $development = Development::import($developmentArray, $entityArray);
                return redirect()->route('development.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Operations':
                $operationsArray = Excel::toArray(new OperationImport, $request->file);
                $operation = OperationUtility::import($operationsArray, $entityArray);
                return redirect()->route('operation.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Budget':
                $budgetsArray = Excel::toArray(new BudgetsImport, $request->file);
                $budgets = OperationBudget::import($budgetsArray, $entityArray);
                return redirect()->route('operation.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Expenditure':
                $expenditureArray = Excel::toArray(new ExpenditureImport, $request->file);
                $expenditure = OperationExpenditure::import($expenditureArray, $entityArray);
                return redirect()->route('operation.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Lettings':
                $lettingsArray = Excel::toArray(new LettingsImport, $request->file);
                $expenditure = Letting::import($lettingsArray, $entityArray);
                return redirect()->route('letting.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Contract Status':
                $contractStatusArray = Excel::toArray(new ContractStatusImport, $request->file);
                $expenditure = Tenant::import($contractStatusArray, $entityArray);
                return redirect()->route('letting.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Finance':
                $financeArray = Excel::toArray(new FinanceImport, $request->file);
                $finance = Finance::import($financeArray, $entityArray);
                return redirect()->route('finance.index')->with('success', 'Data Imported Successfully');
                break;
            case 'Locations':
                $locationArray = Excel::toArray(new LocationImport, $request->file);
                $location = Location::import($locationArray);
                return redirect()->route('location.index')->with('success', 'Data Imported Successfully');
                break;
        }
    }

    public function getSheetFormat($type)
    {
        Log::info($type);
        switch ($type) {
            case 'property':
                $file= public_path(). "/storage/files/Property Sample Format.xlsx";
                $filename = 'Property Sample Format.xlsx';
                break;
            case 'development':
                $file= public_path(). "/storage/files/Development Sample Format.xlsx";
                $filename = 'Development Sample Format.xlsx';
                break;
            case 'operations':
                $file= public_path(). "/storage/files/Operations Sample Format.xlsx";
                $filename = 'Operations Sample Format.xlsx';
                break;
            case 'lettings':
                $file= public_path(). "/storage/files/Lettings Sample Format.xlsx";
                $filename = 'Lettings Sample Format.xlsx';
                break;
            case 'finance':
                $file= public_path(). "/storage/files/Finance Sample Format.xlsx";
                $filename = 'Finance Sample Format.xlsx';
                break;
            case 'Locations':
                $file= public_path(). "/storage/files/Locations Sample Format.xlsx";
                $filename = 'Locations Sample Format.xlsx';
                break;
        }

        $headers = array('Content-Type: application/xlsx');

        return Response::download($file, $filename, $headers);
    }
}
