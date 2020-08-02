<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Checklist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = Checklist::all();
        return $checklists;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer'],
            'is_template' => ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user, $checklistOwner */
        $user = Auth::user();
        $checklistOwner = User::find($request->user_id);

        /** Guarantees that users can only create checklist for themselves (unless this
         * is an admin user)
        */
        $isChecklistOwner = $user->id == $checklistOwner->id;
        $isAdmin = $user->isAdmin();

        $canCreateChecklist = $isChecklistOwner || $isAdmin;

        if(!$canCreateChecklist){
            $message = "You cannot create checklists for a different user.";
            return response()->json($message, Response::HTTP_UNAUTHORIZED);
        }

        $checklistData = $request->only([
            'name',
            'user_id',
            'is_template'
        ]);

        $checklist = $checklistOwner->createChecklist($checklistData);

        return $checklist;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        $this->authorize('delete', $checklist);

        return true;
    }
}
