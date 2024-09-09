<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use LdapRecord\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginWithLDAP extends Controller
{
    public function userLoginValidate(Request $request) {

        /*
        |--------------------------------------------------------------------------
        | Recebimento e Sanitização dos Inputs.
        |--------------------------------------------------------------------------
        |
        | Está função tem como função receber e realizar a sanitização dos inputs
        |
        | 
        */
        
        $validator = Validator::make($request->all(), [
            'userLDAP_name'     => 'required|int|',
            'passwordLDAP_name' => 'required|',
        ]);
        
        if ($validator->fails()) {
            // A validação falhou
            // Você pode acessar os erros com $validator->errors()
            return $validator->errors();
        } else {
            // A validação foi bem-sucedida
            $validatedData = $validator->validated();

            return $this->ldapConn($validatedData);
        }
    }

    public function ldapConn($validatedData) {
        
        $USER   = $validatedData['userLDAP_name'];
        $PASSWD = $validatedData['passwordLDAP_name'];

        /*
        |--------------------------------------------------------------------------
        | Aqui se encontra os atributos do LDAP 
        |--------------------------------------------------------------------------
        */

        $ldap_host     = "000.000.000.000";
        $ldap_base_dn  = "dc=EXAMPLE,dc=EXAMPLE";
        $ldap_username = "CN=EXAMPLE,DC=EXAMPLE,DC=EXAMPLE";
        $ldap_password = "EXAMPLE@123";
        
        /*
        |--------------------------------------------------------------------------
        | Atributos para conexão do LDAP
        |--------------------------------------------------------------------------
        */

        $connection = new Connection([
            'hosts'    => [$ldap_host],
            'base_dn'  => $ldap_base_dn,
            'username' => $ldap_username,
            'password' => $ldap_password,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Se a conexão for bem sucedida, executa os comandos abaixo.
        |--------------------------------------------------------------------------
        */
      
        if ($connection->auth()->attempt("{$USER}@BASE_DN", $PASSWD)) {

           return redirect()->route('home.get');

        } else {

            return redirect()->route('login.get');
        
        }
    }
}
    
