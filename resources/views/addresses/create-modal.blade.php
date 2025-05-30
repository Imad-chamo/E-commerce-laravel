<div x-show="showCreateModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Ajouter une Adresse</h2>
        <form @submit.prevent="storeAddress" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Rue</label>
                <input type="text" x-model="newAddress.street" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-gray-700">Ville</label>
                <input type="text" x-model="newAddress.city" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-gray-700">Pays</label>
                <input type="text" x-model="newAddress.country" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-gray-700">Code Postal</label>
                <input type="text" x-model="newAddress.postal_code" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="inline-flex items-center mt-3">
                    <input type="checkbox" x-model="newAddress.is_active" class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">Définir comme adresse principale</span>
                </label>
            </div>

            <div class="mt-4 flex justify-between">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Ajouter
                </button>
                <button type="button" @click="showCreateModal = false" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Annuler
                </button>
            </div>
        </form>


    </div>
</div>
