<div>
    <div class="form-group">
        <label for="price">Vraagprijs</label>
        <input type="number" wire:model="price" class="form-control" id="price">
        <button wire:click="updatePrice" class="btn btn-success mt-2">Vraagprijs bijwerken</button>
    </div>

    <div class="form-group mt-3">
        <label for="status">Status</label>
        <select wire:model="status" class="form-control" id="status">
            <option value="beschikbaar">Beschikbaar</option>
            <option value="verkocht">Verkocht</option>
        </select>
        <button wire:click="updateStatus" class="btn btn-primary mt-2">Status bijwerken</button>
    </div>
</div>
