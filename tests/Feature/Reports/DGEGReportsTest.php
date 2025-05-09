<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('it should import DGEG report', function () {
    $user = User::factory()->create();

    Storage::fake('local');

    $realPath = storage_path('assets/dgeg_data_example.xlsx');

    expect(file_exists($realPath))->toBeTrue();

    $file = new UploadedFile(
        path: $realPath,
        originalName: 'dgeg_data_example.xlsx',
        mimeType: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        test: true
    );

    $this->actingAs($user)
        ->postJson('api/reports/dgeg/import', [
            'file' => $file
        ])->assertStatus(200);
});
