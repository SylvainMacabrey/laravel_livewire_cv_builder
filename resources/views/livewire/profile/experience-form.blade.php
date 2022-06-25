<div>
    <div>
        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Enregistrer</button>
        </form>
    </div>
</div>
