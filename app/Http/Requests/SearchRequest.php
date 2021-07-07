<?php

declare(strict_types=1);

namespace App\Http\Requests;

class SearchRequest extends Request
{
    public function rules() : array
    {
        $maxLength = $this->input('search_in_titles', false)
            ? 100
            : 5000;

        return [
            'search'           => "required|string|max:$maxLength",
            'replace'          => "string|max:$maxLength",
            'search_in_titles' => 'required_without:search_in_descriptions',
        ];
    }

    public function messages() : array
    {
        return [
            'search.required'                   => 'Enter something to search field.',
            'search.max'                        => 'Search text must not exceed :max characters.',
            'replace.max'                       => 'Replace text must not exceed :max characters.',
            'search_in_titles.required_without' => 'Check titles or/and descriptions to search in.',
        ];
    }
}
