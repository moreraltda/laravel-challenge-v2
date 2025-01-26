<?php

use App\Models\File;
use App\Models\User;

/** User Test */
test('a user has many files', function () {
    $user = User::factory()->create();
    $file = File::factory()->create(['owner_id' => $user->id]);

    expect($user->files[0]->id)->toBe($file->id);
});


test('a user has many shared files', function () {
    $user = User::factory()->create();
    $file = File::factory()->create();

    $user->sharedFiles()->syncWithoutDetaching($file);

    expect($user->sharedFiles[0]->id)->toBe($file->id);
});

/** File Test */
test('a file belongs to a user', function () {
    $user = User::factory()->create();
    $file = File::factory()->create(['owner_id' => $user->id]);

    expect($file->owner->id)->toBe($user->id);
});

test('a file has many users', function () {
    $user = User::factory()->create();
    $file = File::factory()->create();

    $file->users()->syncWithoutDetaching($user);

    expect($file->users[0]->id)->toBe($user->id);
});
