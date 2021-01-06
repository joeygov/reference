<?php

namespace App\Http\Managers;

use App\Models\Account;
use App\Http\Requests\AccountRequest;

class AccountManager{

    public function getAccount($account_id)
    {
        return Account::find($account_id);
    }

    public function insertAccount(AccountRequest $request)
    {
        $retVal = false;

        try {
            $account = new Account();
            $account->name = $request->account_name;
            $account->save();

            $retVal = true;
        } catch (\Exception $e) {
            \Log::error(get_class().':insertAccount(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function updateAccount(AccountRequest $request, Account $account)
    {
        $retVal = false;

        try {
            $account->update([
                'name' => $request->account_name
            ]);

            $retVal = true;
        } catch (\Exception $e) {
            \Log::error(get_class().':updateAccount(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function searchAccount($request = null)
    {
        try {
            $account_id = empty($request->account_id) ? '' : $request->account_id;
            $account_name = empty($request->account_name) ? '' : $request->account_name;

            $query = Account::query();

            if (empty($account_id) && empty($account_name)) {
                return $query->get()->toArray();
            }

            if (!empty($account_id)) {
                $query->where('id', $account_id);
            }

            if (!empty($account_name)) {
                $query->where('name', 'like', '%' . $account_name . '%');
            }

            return $query->get()->toArray();

        } catch (\Exception $e) {
            \Log::error(get_class().':searchAccount(): '.$e->getMessage());

            return false;
        }

    }
}