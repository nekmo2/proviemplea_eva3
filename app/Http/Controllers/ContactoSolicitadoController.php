<?php

namespace App\Http\Controllers;

use App\Models\ContactoSolicitado;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ContactoSolicitadoController extends Controller
{
    #[OA\Get(
        path: "/contactos",
        tags: ["Contactos"],
        summary: "Listar contactos solicitados",
        responses: [
            new OA\Response(
                response: 200,
                description: "Listado de contactos"
            )
        ]
    )]
    public function index()
    {
        $contactos = ContactoSolicitado::with(['empresa', 'persona'])->get();

        return response()->json($contactos);
    }

    #[OA\Get(
        path: "/contactos/{id}",
        tags: ["Contactos"],
        summary: "Obtener contacto por ID",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Contacto encontrado"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrado"
            )
        ]
    )]
    public function show($id)
    {
        $contacto = ContactoSolicitado::with(['empresa', 'persona'])->findOrFail($id);

        return response()->json($contacto);
    }

    #[OA\Post(
        path: "/contactos",
        tags: ["Contactos"],
        summary: "Crear contacto solicitado",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["empresa_id", "persona_id"],
                properties: [
                    new OA\Property(property: "empresa_id", type: "integer", example: 1),
                    new OA\Property(property: "persona_id", type: "integer", example: 1),
                    new OA\Property(property: "estado", type: "string", example: "pendiente"),
                    new OA\Property(property: "notas_admin", type: "string", example: "Primer contacto")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Contacto creado"
            )
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'persona_id' => 'required|exists:personas,id',
            'estado' => 'nullable|in:pendiente,contactado,entrevista,seleccionado,no-seleccionado,proceso-cerrado',
            'notas_admin' => 'nullable|string',
        ]);

        $contacto = ContactoSolicitado::create($validated);

        return response()->json(
            $contacto->load(['empresa', 'persona']),
            201
        );
    }

    #[OA\Put(
        path: "/contactos/{id}",
        tags: ["Contactos"],
        summary: "Actualizar contacto",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Contacto actualizado"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrado"
            )
        ]
    )]
    public function update(Request $request, $id)
    {
        $contacto = ContactoSolicitado::findOrFail($id);

        $validated = $request->validate([
            'estado' => 'nullable|in:pendiente,contactado,entrevista,seleccionado,no-seleccionado,proceso-cerrado',
            'notas_admin' => 'nullable|string',
        ]);

        $contacto->update($validated);

        return response()->json(
            $contacto->load(['empresa', 'persona'])
        );
    }

    #[OA\Delete(
        path: "/contactos/{id}",
        tags: ["Contactos"],
        summary: "Eliminar contacto",
        responses: [
            new OA\Response(
                response: 200,
                description: "Contacto eliminado"
            )
        ]
    )]
    public function destroy($id)
    {
        $contacto = ContactoSolicitado::findOrFail($id);

        $contacto->delete();

        return response()->json([
            "message" => "Contacto eliminado correctamente"
        ]);
    }
}
