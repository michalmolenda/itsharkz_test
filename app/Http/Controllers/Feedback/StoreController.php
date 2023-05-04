<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackStoreRequest;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

final class StoreController extends Controller
{
    /**
     * @param FeedbackStoreRequest $feedbackStoreRequest
     * @return RedirectResponse
     */
    public function __invoke(FeedbackStoreRequest $feedbackStoreRequest): RedirectResponse
    {
        $validated = $feedbackStoreRequest->validated();
        $comment = $feedbackStoreRequest->get('comment');
        $file = $feedbackStoreRequest->files->get('file');

        $model = new Feedback();
        $model->fill($validated);

        $model->comment = $comment ?? '';

        if($file !== null) {
            $fileName = $file->getClientOriginalName();

            Storage::put('storage/' . $fileName, $file);

            $model->file_name = $fileName;
        }

        $model->save();

        return redirect()->route('feedback.index');
    }
}
