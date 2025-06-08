<x-app-layout>
    <div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Criar Novo Plano de Econômia</h2>

        <form action="{{ route('plano.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nome do plano --}}
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Plano</label>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    required
                    placeholder="Ex: Viagem, Reserva, Casa nova..."
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('nome')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Meta financeira --}}
            <div>
                <label for="meta" class="block text-sm font-medium text-gray-700">Meta total (R$)</label>
                <input
                    type="number"
                    step="0.01"
                    name="meta"
                    id="meta"
                    required
                    placeholder="Ex: 1000 para Mil Reais..."
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('meta')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botão --}}
            <div class="text-center">
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Criar Plano
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
