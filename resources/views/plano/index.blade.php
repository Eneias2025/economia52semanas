<x-app-layout>
    <div class="flex justify-center">
        <div class="w-full max-w-7xl px-6 py-8">
            <div class="mb-6 p-4 bg-white shadow rounded-lg text-center">
                <h1 class="text-3xl font-bold mb-6 text-center">Seus Planos de Economia - 52 Semanas</h1>

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-center">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="mb-6 p-4 bg-white shadow rounded-lg text-center">
                @if ($planos->isEmpty())
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded text-center">
                        Você ainda não criou um plano de economia.
                        <a href="{{ route('plano.create') }}" class="underline text-blue-600">Criar agora</a>
                    </div>
            </div>
        @else
            @foreach ($planos as $plano)
                @php
                    $totalDepositado = $plano->depositos->where('feito', true)->sum('valor');
                    $progresso = round(($totalDepositado / $plano->meta) * 100, 1);
                @endphp

                <div class="mb-12">
                    <h2 class="text-xl font-bold text-center mb-4">Plano {{ $loop->iteration }} - 💰 {{ $plano->nome }}
                    </h2>

                    {{-- Resumo --}}
                    <div class="mb-6 p-4 bg-white shadow rounded-lg text-center">
                        <p><strong>Meta:</strong> R$ {{ number_format($plano->meta, 2, ',', '.') }}</p>
                        <p><strong>Total Depositado:</strong> R$ {{ number_format($totalDepositado, 2, ',', '.') }}</p>
                        <p><strong>Progresso:</strong> {{ $progresso }}%</p>
                    </div>
                    {{-- Botão para excluir plano --}}
                    <div class="text-center mb-4">
                        <form action="{{ route('plano.destroy', $plano->id) }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este plano? Esta ação não pode ser desfeita.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                                🗑️ Excluir Plano
                            </button>
                        </form>
                    </div>
                    {{-- Timeline --}}
                    <div class="relative w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                        <div class="absolute top-0 left-0 h-4 bg-green-500 transition-all duration-700"
                            style="width: {{ $progresso }}%"></div>
                        <div class="absolute -top-6 left-0 text-xs text-green-600 font-semibold"
                            style="left: calc({{ $progresso }}% - 10px);">
                            {{ $progresso }}%
                        </div>
                    </div>
                    {{-- Tabela --}}
                    <div class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="table-auto w-full text-sm text-center">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3">Semana</th>
                                    <th class="px-6 py-3">Valor</th>
                                    <th class="px-6 py-3">Data Prevista</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($plano->depositos->sortBy('semana') as $deposito)
                                    <tr class="{{ $deposito->feito ? 'bg-green-50' : '' }}">
                                        <td class="px-6 py-2">Semana {{ $deposito->semana }}</td>
                                        <td class="px-6 py-2">R$ {{ number_format($deposito->valor, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-2">{{ $deposito->data->format('d/m/Y') }}</td>
                                        <td class="px-6 py-2">
                                            @if ($deposito->feito)
                                                <span class="text-green-600 font-semibold">✅ Depositado</span>
                                            @else
                                                <span class="text-red-600">❌ Em aberto</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-2">
                                            @if (!$deposito->feito)
                                                <form action="{{ route('deposito.marcar', $deposito->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button
                                                        class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700">
                                                        Marcar como feito
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('deposito.desfazer', $deposito->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button
                                                        class="bg-red-600 text-white text-xs px-3 py-1 rounded hover:bg-red-700">
                                                        Desfazer depósito
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full max-w-7xl px-6 py-8">
                    <div class="mb-6 p-4 bg-black shadow rounded-lg text-center">

                    </div>
                </div>
            @endforeach
            {{-- Botão para criar novo plano (se ainda tiver menos de 3) --}}
            @if ($planos->count() < 3)
                <div class="text-center mt-8">
                    <a href="{{ route('plano.create') }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Criar Novo Plano
                    </a>
                </div>
            @endif
            @endif
        </div>
    </div>
</x-app-layout>
