<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Managers\AccountManager;


class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();

        return view('admin.account.list', compact('accounts'));
    }

    public function create()
    {
        return view('admin.account.create');
    }

    public function store(AccountRequest $request, AccountManager $accountManager)
    {
        $account = $accountManager->insertAccount($request);

        if ($account) {
            return redirect()->route('account.list')->with('success', 'Created Account Successfully');
        }

        return redirect()->route('account.list')->with('error', 'Transaction Error!');
    }

    public function edit(Account $account)
    {
        return view('admin.account.edit', compact('account'));
    }

    public function update(AccountRequest $request, Account $account, AccountManager $accountManager)
    {
        $acct = $accountManager->updateAccount($request, $account);

        if ($acct) {
            return redirect()->route('account.list')->with('success', 'Updated Account Successfully');
        }

        return redirect()->route('account.list')->with('error', 'Transaction Error!');
    }

    public function destroy(Account $account,  AccountManager $accountManager)
    {
        $acct = $accountManager->getAccount($account->id);
        $acct->delete();

        if ($acct) {
            return redirect()->route('account.list')->with('success', 'Deleted Account Successfully');
        }

        return redirect()->route('account.list')->with('error', 'Transaction Error!');
    }

    public function search(Request $request, AccountManager $accountManager)
    {
        return $accountManager->searchAccount($request);
    }
}
