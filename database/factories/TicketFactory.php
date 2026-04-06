<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customers = Customer::all();
        $statuses = ['new', 'inprocess', 'done'];
        return [
            'customer_id' => $customers->random()->id,
            'topic' => fake()->title(),
            'text' => fake()->text(),
            'status' => $statuses[array_rand($statuses)],
            'response_date' => fake()->dateTime()
        ];
    }

    public function withFile()
    {
        return $this->afterCreating(function (Ticket $ticket) {
            $ticket->addMedia(UploadedFile::fake()->create('document.pdf', 250))->toMediaCollection('attachments');
        });
    }
}
