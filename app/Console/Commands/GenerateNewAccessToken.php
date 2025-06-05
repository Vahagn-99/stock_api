<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateNewAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:access_token {--user_id= : ID пользователя}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда генерации нового токена для пользователя';

    /**
     * Execute the console command.
     */
    public function handle() : void
    {
        $user_id = $this->option('user_id') ?? null;

        if (empty($user_id)) {
            $user = User::first();
        } else {
            $user = User::find($user_id);
        }

        $this->info('Api-Key ' . $user->newToken('api'));
    }
}
