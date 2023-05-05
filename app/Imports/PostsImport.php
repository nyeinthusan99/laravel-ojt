<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PostsImport implements ToCollection,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Post::create([
                'title' => $row['title'],
                'description' => $row['description'],
                'status' => 1,
                'created_user_id' => Auth::user()->id,
                'updated_user_id' => Auth::user()->id,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required','max:255',Rule::unique("posts","title")->whereNull('deleted_at')],
            '*.description' => ['required'],
        ];
    }
}
