<?php

namespace Database\Seeders;

use App\Models\Stream;
use App\Models\User;
use Illuminate\Database\Seeder;

class StreamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Stream::create([
            'user_id' => $user->id,
            'title' => 'Welcome to ANDABWA LIVE',
            'description' => 'Test live stream for real-time chat',
            'livekit_room' => 'test-stream-room-' . now()->format('YmdHis'),
            'is_live' => true,
            'status' => 'live',
        ]);
    }
}
