<?php

namespace App\Nova\Actions;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExportImportUsers extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
                if ($fields->action == 'export') {
                    (new FastExcel(User::all()))->export('users.xlsx');
                    return Action::message('Users exported successfully.');
                }
        
                if ($fields->action == 'import') {
                    (new FastExcel)->import($fields->file, function ($line) {
                        User::create([
                            'name' => $line['name'],
                            'email' => $line['email'],
                            'password' => Hash::make($line['password'])
                            // Map other fields accordingly
                        ]);
                    });
                    return Action::message('Users imported successfully.');
                }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return collect([
            Select::make('Action')
                ->options([
                    'export' => 'Export Users',
                    'import' => 'Import Users',
                ])->rules('required'),

            \Laravel\Nova\Fields\File::make('File')->rules('required_if:action,import')
        ]);
    }
}
