<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee'],
            ['title' => '1984', 'author' => 'George Orwell'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen'],
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
            ['title' => 'Moby-Dick', 'author' => 'Herman Melville'],
            ['title' => 'War and Peace', 'author' => 'Leo Tolstoy'],
            ['title' => 'The Odyssey', 'author' => 'Homer'],
            ['title' => 'Crime and Punishment', 'author' => 'Fyodor Dostoevsky'],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger'],
            ['title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien'],
            ['title' => 'Jane Eyre', 'author' => 'Charlotte Brontë'],
            ['title' => 'Brave New World', 'author' => 'Aldous Huxley'],
            ['title' => 'Wuthering Heights', 'author' => 'Emily Brontë'],
            ['title' => 'The Brothers Karamazov', 'author' => 'Fyodor Dostoevsky'],
            ['title' => 'Animal Farm', 'author' => 'George Orwell'],
            ['title' => 'Gone with the Wind', 'author' => 'Margaret Mitchell'],
            ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien'],
            ['title' => 'Fahrenheit 451', 'author' => 'Ray Bradbury'],
            ['title' => 'The Grapes of Wrath', 'author' => 'John Steinbeck'],
            ['title' => 'Slaughterhouse-Five', 'author' => 'Kurt Vonnegut'],
        ];

        $statuses = ['available'];

        foreach ($books as $book) {
            DB::table('books')->insert([
                'title' => $book['title'],
                'author' => $book['author'],
                'status' => $statuses[array_rand($statuses)], // Randomly assign status
                'quantity' => rand(1, 10), // Assign a random quantity between 1 and 10
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
