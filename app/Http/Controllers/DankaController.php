<?php

namespace App\Http\Controllers;

use App\Models\Danka;
use App\Models\User;
use App\Http\Requests\DankaUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DankaController extends Controller
{
    //檀家一覧
    public function index()
    {
        $bouzu_id = Auth::id();
        $dankas = Danka::where('bouzu_id', $bouzu_id)->get()->sortByDesc('created_at');

        return view('dankas.index', ['dankas' => $dankas]);
    }

    //檀家登録画面の表示
    public function create(): View
    {
        return view('dankas.register');
    }

    //檀家登録
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'family_head_last_name' => ['required', 'string', 'max:255'],
            'family_head_first_name' => ['required', 'string', 'max:255'],
            'family_head_last_name_kana' => ['required', 'string', 'max:255'],
            'family_head_first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'confirmed', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Danka::class],
            'postcode' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
        ]);

        $bouzu_id = Auth::id();

        //TODO: ここで、emailとphone_numberが両方nullになっていないか確認する。
        //両方nullの場合は、どちらかは入れてもらうようメッセージを出す

        $danka = Danka::create([
            'family_head_last_name' => $request->family_head_last_name,
            'family_head_first_name' => $request->family_head_first_name,
            'family_head_last_name_kana' => $request->family_head_last_name_kana,
            'family_head_first_name_kana' => $request->family_head_first_name_kana,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'note' => $request->note,
            'bouzu_id' => $bouzu_id,
        ]);

        return redirect(route('dankas.index', absolute: false));
    }

    public function edit($id): View
    {
        $danka = Danka::find($id);
        return view('dankas.edit', ['danka' => $danka]);
    }

    public function update(DankaUpdateRequest $request): RedirectResponse
    {

        $danka_id = $request->id;
        $danka = Danka::find($danka_id);
        $danka->fill($request->validated());
        //TODO: ここで、emailとphone_numberどっちかはあるように確認
        $danka->save();

        return Redirect::route('dankas.edit', ['id' => $danka_id])->with('status', 'danka-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('dankaDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $id = $request->id;
        $danka = Danka::find($id);
        $danka->delete();

        return Redirect::to(route('dankas.index'));
    }
}
