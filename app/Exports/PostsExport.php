<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostsExport implements FromCollection,WithHeadings,WithMapping
{

    private $posts;
    public function  __construct($posts)
    {
       $this->posts = $posts;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->posts;
    }

    public function map($posts): array
    {
        return[
            $posts->title,
            $posts->description,
            $posts->created_user
        ];
    }

    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Posted User'
        ];
    }
}
