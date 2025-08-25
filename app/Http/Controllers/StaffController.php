<?php

namespace App\Http\Controllers;

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
        $prods = $this->_staffModel->getAssignedProducts();
        $malf_prods = $this->_staffModel->getPagedMalfunctions();
        return view('layouts.users_layouts.staff.malfunctions.list', ['prods' => $prods,'malf_prods' => $malf_prods, 'user' => $user]);
    }

    public function deleteMalfunction(int $malfId): RedirectResponse{
        $malf = $this->_staffModel->getMalfunctionById($malfId);
        $malf->delete();
        return redirect()->route('malfunctions.list');
    }
}
