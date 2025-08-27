<?php

namespace App\Http\Controllers;

use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\SoluzioneTecnica;
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
        $prods = $staff->getPagedAssignedProds();

        $malfPaginators = [];
        foreach ($prods as $p) {
            $malfPaginators[$p->id] = $staff->getPagedAssignedMalfunctions($p->id);
        }

        $perPage = 5;
        $solPageForMalf = [];
        foreach ($prods as $p) {
            /** @var \Illuminate\Pagination\LengthAwarePaginator $malfs */
            $malfs = $malfPaginators[$p->id] ?? null;
            if (!$malfs) continue;
            foreach ($malfs as $m) {
                $firstSolId = SoluzioneTecnica::where('id_malfunzionamento', $m->id)
                    ->orderBy('id', 'asc')
                    ->value('id');

                if (!$firstSolId) { 
                    $solPageForMalf[$m->id] = 1; 
                    continue; 
                }

                $index = SoluzioneTecnica::where('id_malfunzionamento', $m->id)
                            ->where('id', '<=', $firstSolId)
                            ->count() - 1; // 0-based

                $solPageForMalf[$m->id] = intdiv($index, $perPage) + 1; // qui sarà 1, ma resta generico
            }
        }

        return view('layouts.users_layouts.staff.malfunctions.list', ['prods' => $prods, 'solPageForMalf' => $solPageForMalf, 'malfPaginators' => $malfPaginators, 'user' => $user]);
    }

    public function deleteMalfunction(int $malfId): RedirectResponse{
        $malf = $this->_staffModel->getMalfunctionById($malfId);
        $malf->delete();
        return redirect()->route('malfunctions.list');
    }

    public function listSolutions(){
        $user = Auth::user();
        $staff = Staff::where('id_utente', $user->id)->firstOrFail();

        $prods = $staff->getPagedProdsWithMalfs();

        // Paginator soluzioni (per ciascun malfunzionamento)
        $solPaginators = [];
        // Mappa soluzione->pagina per link diretti
        $solutionPages = [];

        $perPageSolutions = 5; // lo stesso valore usato nel paginate() delle soluzioni

        foreach ($prods as $p) {
            foreach ($p->malfunzionamento as $m) {
                // paginator per le soluzioni di questo malfunzionamento
                $solPaginators[$m->id] = $staff->getPagedAssignedSolutions($m->id);

                // pre-calcolo: id soluzione -> pagina
                $idsOrdinati = SoluzioneTecnica::where('id_malfunzionamento', $m->id)
                    ->orderBy('id', 'asc')
                    ->pluck('id')
                    ->values(); // [12, 15, 22, 23, ...]

                foreach ($idsOrdinati as $idx => $solId) {
                    $solutionPages[$solId] = intdiv($idx, $perPageSolutions) + 1;
                }
            }
        }

        return view('layouts.users_layouts.staff.solutions.list', ['prods' => $prods, 'solPaginators' =>$solPaginators, 'solutionPages' => $solutionPages, 'user' => $user]);
    }

    public function deleteSolution(int $solId): RedirectResponse{
        $sol = $this->_staffModel->getSolutionById($solId);
        $sol->delete();
        return redirect()->route('solutions.list');
    }


}
