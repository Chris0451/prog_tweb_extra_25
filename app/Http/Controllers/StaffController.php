<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMalfunctionRequest;
use App\Http\Requests\NewSolutionRequest;
use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\SoluzioneTecnica;
use App\Models\Resources\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StaffController extends Controller
{
    protected $_staffModel;

    public function __construct() {
        $this->_staffModel = new Staff();
    }

    //-------------------------------//

    public function insertMalfunction(): View{
        $user = Auth::user();
        $staff = $this->_staffModel->where('id_utente', $user->id)->firstOrFail();
        $prods = $staff->getAssignedProds();

        return view('layouts.users_layouts.staff.malfunctions.insert', ['prods' => $prods, 'user' => $user]);
    }

    public function storeMalfunction(NewMalfunctionRequest $request): RedirectResponse{
        $malf = new Malfunzionamento;
        $malf->fill($request->validated());
        $malf->save();
        return redirect()->route('dashboard.staff')->with('success', 'Malfunzionamento inserito correttamente');
    }

    public function listMalfunctions(): View{
        $user = Auth::user();
        $staff = $this->_staffModel->where('id_utente', $user->id)->firstOrFail();
        $prods = $staff->getPagedAssignedProds();

        $malfPaginators = [];
        foreach ($prods as $p) {
            $malfPaginators[$p->id] = $staff->getPagedAssignedMalfunctions($p->id);
        }

        return view('layouts.users_layouts.staff.malfunctions.list', ['prods' => $prods, 'malfPaginators' => $malfPaginators, 'user' => $user]);
    }

    public function editMalfunction(int $malfId): View{
        $user = Auth::user();
        $malfunzionamento = $this->_staffModel->getMalfunctionById($malfId);
        return view('layouts.users_layouts.staff.malfunctions.update', ['malfunzionamento' => $malfunzionamento, 'user' => $user]);
    }

    public function updateMalfunction(NewMalfunctionRequest $request){
        $malf = $this->_staffModel->getMalfunctionById($request->input('id'));
        $malf->update($request->validated());
        return redirect()->route('malfunctions.list');
    }

    public function deleteMalfunction(int $malfId): RedirectResponse{
        $malf = $this->_staffModel->getMalfunctionById($malfId);
        $malf->delete();
        return redirect()->route('malfunctions.list');
    }

    //-------------------------------//

    public function insertSolution(): View{
        $user = Auth::user();
        $staff = $this->_staffModel->where('id_utente', $user->id)->firstOrFail();

        $malfs = $staff->getAssignedMalfs();

        return view('layouts.users_layouts.staff.solutions.insert', [
            'malfs' => $malfs,
            'user'  => $user
        ]);
    }

    public function storeSolution(NewSolutionRequest $request): RedirectResponse{
        $malf = new SoluzioneTecnica;
        $malf->fill($request->validated());
        $malf->save();
        return redirect()->route('dashboard.staff')->with('success', 'Prodotto inserito correttamente');
    }

    public function listSolutions(){
        $user = Auth::user();
        $staff = $this->_staffModel->where('id_utente', $user->id)->firstOrFail();

        $prods = $staff->getPagedProdsWithMalfs();

        $solPaginators = [];

        foreach ($prods as $p) {
            foreach ($p->malfunzionamento as $m) {
                $solPaginators[$m->id] = $staff->getPagedAssignedSolutions($m->id);
            }
        }

        return view('layouts.users_layouts.staff.solutions.list', ['prods' => $prods, 'solPaginators' =>$solPaginators, 'user' => $user]);
    }

    public function editSolution(int $solId): View{
        $user = Auth::user();
        $soluzione = $this->_staffModel->getSolutionById($solId);
        return view('layouts.users_layouts.staff.solutions.update',['soluzione' => $soluzione, 'user' => $user]);
    }

    public function updateSolution(NewSolutionRequest $request): RedirectResponse{
        $sol = $this->_staffModel->getSolutionById($request->input('id'));
        $sol->update($request->validated());
        return redirect()->route('solutions.list');
    }

    
    public function deleteSolution(int $solId): RedirectResponse{
        $sol = $this->_staffModel->getSolutionById($solId);
        $sol->delete();
        return redirect()->route('solutions.list');
    }


}
