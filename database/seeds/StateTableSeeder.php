<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert(array (
            0 =>
            array (
                'id' => '1',
                'title' => 'Acre',
                'letter' => 'AC',
            ),
            1 =>
            array (
                'id' => '2',
                'title' => 'Alagoas',
                'letter' => 'AL',
            ),
            2 =>
            array (
                'id' => '3',
                'title' => 'Amazonas',
                'letter' => 'AM',
            ),
            3 =>
            array (
                'id' => '4',
                'title' => 'Amapá',
                'letter' => 'AP',
            ),
            4 =>
            array (
                'id' => '5',
                'title' => 'Bahia',
                'letter' => 'BA',
            ),
            5 =>
            array (
                'id' => '6',
                'title' => 'Ceará',
                'letter' => 'CE',
            ),
            6 =>
            array (
                'id' => '7',
                'title' => 'Distrito Federal',
                'letter' => 'DF',
            ),
            7 =>
            array (
                'id' => '8',
                'title' => 'Espírito Santo',
                'letter' => 'ES',
            ),
            8 =>
            array (
                'id' => '9',
                'title' => 'Goiás',
                'letter' => 'GO',
            ),
            9 =>
            array (
                'id' => '10',
                'title' => 'Maranhão',
                'letter' => 'MA',
            ),
            10 =>
            array (
                'id' => '11',
                'title' => 'Minas Gerais',
                'letter' => 'MG',
            ),
            11 =>
            array (
                'id' => '12',
                'title' => 'Mato Grosso do Sul',
                'letter' => 'MS',
            ),
            12 =>
            array (
                'id' => '13',
                'title' => 'Mato Grosso',
                'letter' => 'MT',
            ),
            13 =>
            array (
                'id' => '14',
                'title' => 'Pará',
                'letter' => 'PA',
            ),
            14 =>
            array (
                'id' => '15',
                'title' => 'Paraiba',
                'letter' => 'PB',
            ),
            15 =>
            array (
                'id' => '16',
                'title' => 'Pernambuco',
                'letter' => 'PE',
            ),
            16 =>
            array (
                'id' => '17',
                'title' => 'Piauí',
                'letter' => 'PI',
            ),
            17 =>
            array (
                'id' => '18',
                'title' => 'Paraná',
                'letter' => 'PR',
            ),
            18 =>
            array (
                'id' => '19',
                'title' => 'Rio de Janeiro',
                'letter' => 'RJ',
            ),
            19 =>
            array (
                'id' => '20',
                'title' => 'Rio Grande do Norte',
                'letter' => 'RN',
            ),
            20 =>
            array (
                'id' => '21',
                'title' => 'Rondônia',
                'letter' => 'RO',
            ),
            21 =>
            array (
                'id' => '22',
                'title' => 'Roraima',
                'letter' => 'RR',
            ),
            22 =>
            array (
                'id' => '23',
                'title' => 'Rio Grande do Sul',
                'letter' => 'RS',
            ),
            23 =>
            array (
                'id' => '24',
                'title' => 'Santa Catarina',
                'letter' => 'SC',
            ),
            24 =>
            array (
                'id' => '25',
                'title' => 'Sergipe',
                'letter' => 'SE',
            ),
            25 =>
            array (
                'id' => '26',
                'title' => 'São Paulo',
                'letter' => 'SP',
            ),
            26 =>
            array (
                'id' => '27',
                'title' => 'Tocantins',
                'letter' => 'TO',
            ),
        ));
    }
}
