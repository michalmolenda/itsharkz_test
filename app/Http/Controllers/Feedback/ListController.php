<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

final class ListController extends Controller
{
    private const SORTABLE_COLUMNS = ['name', 'email', 'rate', 'created_at'];
    private const SORTABLE_DIRECTIONS = ['asc', 'desc'];

    /**
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $sortColumn = $request->get('sortColumn', 'created_at');
        $sortDirection = $request->get('sortDirection', 'asc');

        // Invalid sort
        abort_if(
            in_array($sortColumn, self::SORTABLE_COLUMNS) === false ||
            in_array($sortDirection, self::SORTABLE_DIRECTIONS) === false,
            404
        );

        return view('feedback.index', [
            'data' => Feedback::select()
                ->orderBy($sortColumn, $sortDirection)
                ->get()
        ]);
    }
}
