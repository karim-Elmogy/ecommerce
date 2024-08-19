<?php

namespace App\Http\Controllers\Dashboard\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TeamWorkRequest;
use App\Models\Dashboard\TeamWork;
use Illuminate\Support\Facades\DB;

class TeamWorkController extends Controller
{

    public function index()
    {
        $teams = TeamWork::latest()->paginate(10);
        return view('admin.pages.teams.index', compact('teams'));
    }


    public function create()
    {
        return view('admin.pages.teams.create');
    }


    public function store(TeamWorkRequest $request)
    {
        if (!request()->ajax()) {
            DB::beginTransaction();
            try {
                $worker = TeamWork::create(array_except($request->validated(), ['image']));
                if ($request->hasFile('image')) {
                    $imageName = upload($request->file('image'), 'dash-img/team');
                    $worker->image = $imageName;
                    $worker->save();
                }


                DB::commit();
                return redirect(route('admin.team.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                return $e->getMessage();
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function show(TeamWork $teamWork)
    {
        return view('admin.pages.teams.show', compact('teamWork'));

    }


    public function edit($id)
    {
        $teamWork=TeamWork::findOrFail($id);
        return view('admin.pages.teams.edit', compact('teamWork'));
    }

    public function update(TeamWorkRequest $request, TeamWork $worker)
    {
        if (!request()->ajax()) {
            DB::beginTransaction();
            try {
                $worker->update(array_except($request->validated(), ['image']));

                if ($request->hasFile('image')) {
                    $imageName = upload($request->file('image'), 'dash-img/team');
                    $worker->image = $imageName;
                    $worker->save();
                }

                DB::commit();
                return redirect(route('admin.team.index'))->with('toast_success', 'تم التحديث بنجاح ✌️');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة أثناء التحديث']);
            }
        }
    }



//    public function update(Request $request, TeamWork $teamWork)
//    {
//        //
//    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $teamWork=TeamWork::findOrFail($id);
            $teamWork->delete();
            DB::commit();
            return redirect()->route('admin.team.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة أثناء الطلب']);
        }
    }
}
