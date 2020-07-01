<?php

use App\Models\SubClient;
use Illuminate\Database\Seeder;

class SubClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubClient::create([
            'client_id'  => '1',
            'state_id'  => '26',
            'cite_id'  => '3549',
            'name'  => 'Esther e Renato Eletrônica Ltda',
            'email'  => 'contato@esthererenatoeletronicaltda.com.br',
            'address'  => 'Viela Kátia',
            'phone'  => '(11) 2525-1360',
            'phone2'  => '(11) 98660-1754',
            'zipcode'  => '08595-615',
            'bairro'  => 'Jardim Gabriela I',
            'cnpj'  => '95.951.429/0001-70',
            'ie'  => '978.904.458.027',
            'site'  => 'http://www.esthererenatoeletronicaltda.com.br',
        ]);
    }
}
