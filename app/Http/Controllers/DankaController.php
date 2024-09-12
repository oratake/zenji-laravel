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
    public function index(Request $request)
    {
        $pag_list = [
            0 => 10,
            1 => 25,
            2 => 50,
            3 => 100,
        ];
        $disp_list = $request->disp_list;
        if (empty($disp_list)) {
            $disp_list = 10;
        }

        $sort_list = $request->sort_list;
        switch ($sort_list) {
            case 'newest':
                $sort = 'id';
                $order = 'desc';
                break;
            case 'oldest':
                $sort = 'id';
                $order = 'asc';
                break;
            case 'syllabary':
                $sort = 'family_head_last_name_kana';
                $order = 'asc';
                break;
            default:
                $sort = 'created_at';
                $order = 'desc';
                break;
        }

        $bouzu_id = Auth::id();
        $dankas = Danka::where('bouzu_id', $bouzu_id)
            ->orderBy($sort, $order)
            ->orderBy('family_head_first_name_kana', 'asc')
            ->paginate($disp_list);

        return view('dankas.index', ['pag_list' => $pag_list, 'disp_list' => $disp_list, 'dankas' => $dankas]);
    }

    //檀家登録画面の表示
    public function create(): View
    {
        return view('dankas.register');
    }

    //檀家登録
    public function store(Request $request): RedirectResponse
    {

        $danka_info = $request->validate([
            'family_head_last_name' => ['required', 'string', 'max:255'],
            'family_head_first_name' => ['required', 'string', 'max:255'],
            'family_head_last_name_kana' => ['required', 'string', 'max:255'],
            'family_head_first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'confirmed', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Danka::class],
            'postcode' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
        ]);

        if (Danka::hasNoContactInfo($danka_info)) {
            return redirect()->back()->with('status', 'require-email-or-phone-number')->withInput();
        }

        $bouzu_id = Auth::id();

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

    public function edit($id): View | RedirectResponse
    {
        $danka = Danka::find($id);
        $bouzu_id = $danka->bouzu_id;
        if (!Danka::isLoginBouzu($bouzu_id)) {
            return Redirect::route('welcome')->with('status', 'error-unauthorized');
        }
        return view('dankas.edit', ['danka' => $danka]);
    }

    public function update(DankaUpdateRequest $request): RedirectResponse
    {

        $danka_id = $request->id;
        $danka = Danka::find($danka_id);
        $bouzu_id = $danka->bouzu_id;

        if (!Danka::isLoginBouzu($bouzu_id)) {
            return Redirect::route('welcome')->with('status', 'error-unauthorized');
        }

        $danka_info = $request->validated();
        if (Danka::hasNoContactInfo($danka_info)) {
            return redirect()->back()->with('status', 'require-email-or-phone-number')->withInput();
        }

        $danka->fill($danka_info);
        $danka->save();
        return Redirect::route('dankas.index')->with([
            'status' => 'danka-updated',
            'danka' => $danka
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('dankaDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $id = $request->id;
        $danka = Danka::find($id);
        $bouzu_id = $danka->bouzu_id;
        if (!Danka::isLoginBouzu($bouzu_id)) {
            return Redirect::route('welcome')->with('status', 'error-unauthorized');
        }
        $danka->delete();
        return Redirect::to(route('dankas.index'));
    }
}
