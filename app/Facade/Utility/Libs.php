<?php
namespace App\Facade\Utility;

class Libs{

    public function generatePassword($length = 8)
    {
        if ($length < 6 || $length > 8) {
            throw new Exception("Password length must be between 6 and 16 characters.");
        }

        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';

        $allCharacters = $lowercase . $uppercase . $numbers;

        // Ensure the password meets the criteria
        $password = [];
        $password[] = $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password[] = $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password[] = $numbers[random_int(0, strlen($numbers) - 1)];

        // Fill the rest of the password length with random characters
        for ($i = 4; $i < $length; $i++) {
            $password[] = $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        // Shuffle the password to ensure randomness
        shuffle($password);

        return implode('', $password);
    }
}
