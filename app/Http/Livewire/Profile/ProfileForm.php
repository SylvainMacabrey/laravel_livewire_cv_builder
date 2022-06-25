<?php

namespace App\Http\Livewire\Profile;

use App\Models\Profile;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class ProfileForm extends Component implements HasForms
{
    use InteractsWithForms;

    public string|null $biography = null;
    public int $profileId;

    public function mount(Profile $profile): void
    {
        $this->biography = $profile->biography;
        $this->profileId = $profile->id;
    }

    protected function getFormSchema(): array
    {
        return [
            MarkdownEditor::make('biography')->required(),
        ];
    }

    public function submit()
    {
        $this->validate();
        Profile::query()->whereId($this->profileId)->update([
            'biography' => $this->biography
        ]);
    }

    protected function rules(): array
    {
        return [
            'biography' => ['string', 'required']
        ];
    }

    public function render()
    {
        return view('livewire.profile.profile-form');
    }
}
