<?php

namespace App\Http\Controllers;

use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    protected $_staffModel;

    public function __construct() {
        $this->_staffModel = new Staff();
    }

    public function listMalfunctions(){
        $user = Auth::user();
        $staff = Staff::where('id_utente', $user->id)->firstOrFail();
        $prods = $staff->getPagedAssignedMalfunctions();

        return view('layouts.users_layouts.staff.malfunctions.list', ['prods' => $prods, 'user' => $user]);
    }

    public function deleteMalfunction(int $malfId): RedirectResponse{
        $malf = $this->_staffModel->getMalfunctionById($malfId);
        $malf->delete();
        return redirect()->route('malfunctions.list');
    }

    public function listSolutions(){
        $user = Auth::user();
        $staff = Staff::where('id_utente', $user->id)->firstOrFail();
        $prods = $staff->getPagedAssignedSolutions();

        return view('layouts.users_layouts.staff.solutions.list', ['prods' => $prods, 'user' => $user]);
    }

    public function deleteSolution(int $solId): RedirectResponse{
        $sol = $this->_staffModel->getSolutionById($solId);
        $sol->delete();
        return redirect()->route('solutions.list');
    }


}
