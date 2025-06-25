<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::paginate(10);

        return view('clients.index', [
            'clients' => $clients,
        ]);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')->with('status', 'Client created successfully');
    }

    public function edit(Client $client): View
    {
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('status', 'Client updated successfully');
    }

    public function destroy(Client $client): RedirectResponse
    {
        abort_if(Gate::denies('delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $client->delete();
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('status', 'Client belongs to project and/or task. Cannot delete.');
            }
        }

        return redirect()->route('clients.index')->with('status', 'Client deleted successfully');
    }
}
