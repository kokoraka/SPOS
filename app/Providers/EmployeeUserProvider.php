<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeeUserProvider implements UserProvider {

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $id
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($id) { //direct access to page
        $qry = User::where('kode_pegawai','=',$id);
        if ($qry->count() >0) {
            $user = $qry->select('*')->first();
            $attributes = array(
                'kode_pegawai' => $user->kode_pegawai,
                'nama_pegawai' => $user->nama_pegawai,
                'gambar_pegawai' => $user->gambar_pegawai,
                'kode_otoritas' => $user->kode_otoritas,
            );
            return $user;
        }
        return null;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed $id
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($id, $token) {
        $qry = User::where('kode_pegawai','=',$id)
            ->where('remember_token','=',$token);

        if($qry->count() >0) {
            $user = $qry->select('*')->first();
            $attributes = array(
                'kode_pegawai' => $user->kode_pegawai,
                'nama_pegawai' => $user->nama_pegawai,
                'gambar_pegawai' => $user->gambar_pegawai,
                'kode_otoritas' => $user->kode_otoritas,
            );
            return $user;
        }
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token) {
        // TODO: Implement updateRememberToken() method.

        //not yet use remember token
        //$user->setRememberToken($token);
        //$user->save();
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) { //1st get user id
        // TODO: Implement retrieveByCredentials() method.
        $qry = User::where('kode_pegawai','=', $credentials['kode_pegawai']);
        if($qry->count() > 0) {
            return $qry->select('*')->first();
        }
        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials) { //2nd check user password
        if ($user->kode_pegawai == $credentials['kode_pegawai'] && Hash::check($credentials['password'], $user->getAuthPassword())) {
            $user->save();
            return true;
        }
        return false;
    }
}
