<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class PersonaController extends Controller
{
    #[OA\Get(
        path: "/personas",
        tags: ["Personas"],
        summary: "Listar personas",
        description: "Obtiene todas las personas registradas",
        responses: [
            new OA\Response(
                response: 200,
                description: "Listado de personas"
            )
        ]
    )]
    public function index()
    {
        return response()->json(Persona::all());
    }

    #[OA\Get(
        path: "/personas/{id}",
        tags: ["Personas"],
        summary: "Obtener persona por ID",
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
                description: "Persona encontrada"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrada"
            )
        ]
    )]
    public function show(Persona $persona)
    {
        return response()->json($persona);
    }

    #[OA\Post(
        path: "/personas",
        tags: ["Personas"],
        summary: "Crear persona",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["email", "codigo_talento"],
                properties: [
                    new OA\Property(property: "email", type: "string", example: "test@email.com"),
                    new OA\Property(property: "telefono", type: "string", example: "912345678"),
                    new OA\Property(property: "codigo_talento", type: "string", example: "TAL-001"),
                    new OA\Property(property: "resumen", type: "string", example: "Desarrollador backend")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Persona creada"
            ),
            new OA\Response(
                response: 422,
                description: "Error de validación"
            )
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:personas',
            'telefono' => 'nullable|string',
            'codigo_talento' => 'required|unique:personas',
            'resumen' => 'nullable|string',
        ]);

        $persona = Persona::create($validated);

        return response()->json($persona, 201);
    }

    #[OA\Put(
        path: "/personas/{id}",
        tags: ["Personas"],
        summary: "Actualizar persona",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "email", type: "string", example: "nuevo@email.com"),
                    new OA\Property(property: "telefono", type: "string", example: "912345678"),
                    new OA\Property(property: "resumen", type: "string", example: "Actualizado")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Persona actualizada"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrada"
            )
        ]
    )]
    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'email' => 'sometimes|email|unique:personas,email,' . $persona->id,
            'telefono' => 'nullable|string',
            'resumen' => 'nullable|string',
        ]);

        $persona->update($validated);

        return response()->json($persona);
    }

    #[OA\Delete(
        path: "/personas/{id}",
        tags: ["Personas"],
        summary: "Eliminar persona",
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
                description: "Persona eliminada correctamente"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrada"
            )
        ]
    )]
    public function destroy(Persona $persona)
    {
        $persona->delete();

        return response()->json([
            "message" => "Persona eliminada correctamente"
        ]);
    }

    public function create()
    {
        //
    }

    public function edit(Persona $persona)
    {
        //
    }
}
