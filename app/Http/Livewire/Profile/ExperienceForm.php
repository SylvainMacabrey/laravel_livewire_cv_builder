<?php

namespace App\Http\Livewire\Profile;

use Closure;
use App\Models\Profile;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\HasManyRepeater;
use Filament\Forms\Concerns\InteractsWithForms;

class ExperienceForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->form->fill([
            'experiences' => $this->profile->experiences?->toArray(),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            HasManyRepeater::make('experiences')->relationship('experiences')->schema([
                BelongsToSelect::make('job_title_id')
                    ->relationship('jobTitle', 'name')
                    ->searchable('name')
                    ->preload()
                    ->required(),
                BelongsToSelect::make('company_id')
                    ->relationship('company', 'name')
                    ->searchable('name')
                    ->preload()
                    ->required(),
                Textarea::make('description'),
                Checkbox::make('current')
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('finished_at', null);
                    })
                    ->reactive()
                    ->nullable(),
                DatePicker::make('started_at')
                    ->required(),
                DatePicker::make('finished_at')
                    ->hidden(fn ($get) => $get('current'))
                    ->nullable()
                    ->withoutTime(),
            ])->orderable(),
        ];
    }

    protected function getFormModel(): Profile
    {
        return $this->profile;
    }

    public function submit(): void
    {
        $this->profile->update($this->form->getState());
    }

    public function render()
    {
        return view('livewire.profile.experience-form');
    }
}
