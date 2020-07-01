<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'state_id'  => '26',
            'cite_id'  => '3530',
            'name'  => 'Cauã e Yasmin Entregas Expressas Ltda',
            'email'  => 'contabil@cauaeyasminentregasexpressasltda.com.br',
            'address'  => 'Rua Doze',
            'phone'  => '(11) 2899-3661',
            'phone2'  => '(11) 99594-7174',
            'zipcode'  => '08595-615',
            'bairro'  => 'Jardim Nápoli I',
            'cnpj'  => '88.822.379/0001-66',
            'ie'  => '222.236.940.359',
            'site'  => 'http://www.cauaeyasminentregasexpressasltda.com.br',
        ]);
    }
}
