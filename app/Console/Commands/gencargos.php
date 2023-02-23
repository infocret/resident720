<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class gencargos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    // firma  como llamar al comando desde consola
    protected $signature = 'kali:gcargos {nombre}';  

    /**
     * The console command description.
     *
     * @var string
     */
    
    // Descripcion que se mostrara al listar comandos de artisan con : php artisan list
    protected $description = 'Ejecuta SP ( sp_aplicacargos ) que barre datos y cargos a aplicar a condominos de condominios';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Aqui el codigo que se ejecutara al ser llamado el comando
       $this->info("Bienvenido a Kali {$this->argument('nombre')}");
    }
}
